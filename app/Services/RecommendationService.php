<?php

namespace App\Services;

use App\Models\Statement;
use App\Models\StatementRecommendation;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecommendationService
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('RECOMMENDATION_API_URL', 'http://127.0.0.1:8001/recommend-research');
    }

    /**
     * Generate recommendations for a statement
     */
    public function generateRecommendations(Statement $statement, int $nResults = 10)
    {
        try {
            // Prepare query (combined title and description)
            $query = $statement->title;
            if ($statement->description) {
                $query .= ' ' . $statement->description;
            }

            Log::info('Calling recommendation API', [
                'statement_id' => $statement->id,
                'api_url' => $this->apiUrl,
                'title' => $statement->title,
            ]);

            // Call external API with increased timeout (120 seconds)
            $response = Http::timeout(120)->post($this->apiUrl, [
                'title' => $statement->title,
                'description' => $statement->description ?? '',
                'n_results' => $nResults,
            ]);

            Log::info('API response received', [
                'status' => $response->status(),
                'body_preview' => substr($response->body(), 0, 200),
            ]);

            if (!$response->successful()) {
                throw new \Exception('API request failed with status: ' . $response->status());
            }

            $data = $response->json();

            // Validate response structure
            if (!isset($data['recommendations']) || !is_array($data['recommendations'])) {
                throw new \Exception('Invalid API response format');
            }

            // Delete existing recommendation if any
            $statement->recommendation()?->delete();

            // Store new recommendations
            $recommendation = StatementRecommendation::create([
                'statement_id' => $statement->id,
                'query' => $query,
                'type' => 'statement_to_research',
                'count' => count($data['recommendations']),
                'recommendations' => $data['recommendations'],
            ]);

            Log::info('Recommendations saved successfully', [
                'statement_id' => $statement->id,
                'count' => count($data['recommendations']),
            ]);

            return [
                'success' => true,
                'recommendation' => $recommendation,
                'message' => 'Rekomendasi berhasil digenerate',
            ];

        } catch (\Exception $e) {
            Log::error('Failed to generate recommendations', [
                'statement_id' => $statement->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'message' => 'Gagal mendapatkan rekomendasi: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Delete a single recommendation by index
     */
    public function deleteRecommendation(StatementRecommendation $recommendation, int $index)
    {
        try {
            $result = $recommendation->removeRecommendationByIndex($index);

            if ($result) {
                return [
                    'success' => true,
                    'message' => 'Rekomendasi berhasil dihapus',
                ];
            }

            return [
                'success' => false,
                'message' => 'Rekomendasi tidak ditemukan pada index tersebut',
            ];

        } catch (\Exception $e) {
            Log::error('Failed to delete recommendation', [
                'recommendation_id' => $recommendation->id,
                'index' => $index,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'message' => 'Gagal menghapus rekomendasi: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Reset recommendations (delete and regenerate)
     */
    public function resetRecommendations(Statement $statement, int $nResults = 10)
    {
        try {
            // Delete existing
            $statement->recommendation()?->delete();

            // Generate new
            return $this->generateRecommendations($statement, $nResults);

        } catch (\Exception $e) {
            Log::error('Failed to reset recommendations', [
                'statement_id' => $statement->id,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'message' => 'Gagal mereset rekomendasi: ' . $e->getMessage(),
            ];
        }
    }
}
