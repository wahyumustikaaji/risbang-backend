<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statement_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('statement_id')->constrained()->onDelete('cascade');
            $table->text('query'); // Combined title and description
            $table->string('type')->default('statement_to_research');
            $table->integer('count')->default(10);
            $table->json('recommendations'); // Array of recommendations
            $table->timestamps();
            
            // Ensure one recommendation set per statement
            $table->unique('statement_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statement_recommendations');
    }
};
