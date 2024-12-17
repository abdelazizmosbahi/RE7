<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('stars'); // Rating from 1 to 5
            $table->text('comment')->nullable(); // Optional comment
            $table->string('status')->default('in progress'); // Add status column with default value 'in progress'
            $table->unsignedBigInteger('recette_id'); // Foreign key to Recette
            // $table->unsignedBigInteger('user_id')->nullable(); // Commented out for now
            $table->timestamps();

            // Foreign key relationships
            $table->foreign('recette_id')->references('id')->on('recettes')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); // Commented out for now
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rates', function (Blueprint $table) {
            $table->dropColumn('status'); // Remove status column
        });
    }
};
