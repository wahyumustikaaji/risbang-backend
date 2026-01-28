<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatementRecommendation extends Model
{
    protected $fillable = [
        'statement_id',
        'query',
        'type',
        'count',
        'recommendations',
    ];

    protected $casts = [
        'recommendations' => 'array',
    ];

    public function statement()
    {
        return $this->belongsTo(Statement::class);
    }

    /**
     * Remove a single recommendation by index
     */
    public function removeRecommendationByIndex($index)
    {
        $recommendations = $this->recommendations;
        
        // Remove item at specific index
        if (isset($recommendations[$index])) {
            unset($recommendations[$index]);
            $this->recommendations = array_values($recommendations); // Re-index array
            $this->count = count($this->recommendations);
            $this->save();
            return true;
        }
        
        return false;
    }
}
