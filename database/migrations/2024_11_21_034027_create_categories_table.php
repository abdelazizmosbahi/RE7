<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
// {
//     public function up(): void
//     {
//         Schema::create('categories', function (Blueprint $table) {
//             $table->id();
//             $table->string('titre'); // Title of the category
//             $table->string('image', 500); // Image path (increased length if needed)
//             $table->timestamps(); // Timestamps for created_at and updated_at
//         });
//     }

//     public function down(): void
//     {
//         Schema::dropIfExists('categories');
//     }
// };

{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            // $table->text('titre');
            $table->text('titre')->unique(); // Add unique constraint here
            $table->string('image', 500);
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

