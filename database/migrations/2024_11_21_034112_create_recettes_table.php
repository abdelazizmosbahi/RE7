<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//    public function up(): void
// {
//     Schema::create('recettes', function (Blueprint $table) {
//         $table->id();
//         $table->string('titre');
//         $table->string('image')->nullable();
        
//         // Categorie relationship
//         $table->unsignedBigInteger('categorie_id')->nullable();
//         $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('set null');
        
//         // Sous-categorie relationship
//         $table->unsignedBigInteger('sous_categorie_id')->nullable();
//         $table->foreign('sous_categorie_id')->references('id')->on('sous_categories')->onDelete('set null');
        
//         $table->text('ingredients');
//         $table->text('methode_preparation');
//         $table->text('informations_complementaire')->nullable();

//         // Add the 'status' column with default value
//         $table->string('status')->default('en cours'); // Valeur par défaut : 'en cours'
        
//         $table->timestamps();
//     });
// }

//     public function down(): void
//     {
//         Schema::table('recettes', function (Blueprint $table) {
//             $table->dropForeign(['categorie_id']);
//             $table->dropColumn('categorie_id');
            
//             $table->dropForeign(['sous_categorie_id']);
//             $table->dropColumn('sous_categorie_id');
//         });
//     }
// };
{
    /**
     * Run the migrations.
     */
//    public function up(): void
// {
//     Schema::create('recettes', function (Blueprint $table) {
//         $table->id();
//         $table->string('titre');
//         $table->string('image')->nullable();
        
//         // Categorie relationship
//         $table->unsignedBigInteger('categorie_id')->nullable();
//         $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('set null');
        
//         // Sous-categorie relationship
//         $table->unsignedBigInteger('sous_categorie_id')->nullable();
//         $table->foreign('sous_categorie_id')->references('id')->on('sous_categories')->onDelete('set null');
        
//         $table->text('ingredients');
//         $table->text('methode_preparation');
//         $table->text('informations_complementaire')->nullable();

//         // Add the 'status' column with default value
//         $table->string('status')->default('en cours'); // Valeur par défaut : 'en cours'
        
//         $table->timestamps();
//     });
// }

public function up(): void
{
    Schema::create('recettes', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->string('image')->nullable(); // The image field can be nullable
        
        // Categorie relationship
        $table->unsignedBigInteger('categorie_id')->nullable();
        $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('set null');
        
        // Sous-categorie relationship
        $table->unsignedBigInteger('sous_categorie_id')->nullable();
        $table->foreign('sous_categorie_id')->references('id')->on('sous_categories')->onDelete('set null');
        
        $table->text('ingredients');
        $table->text('methode_preparation');
        $table->text('informations_complementaire')->nullable();

        // Add the 'status' column with default value
        $table->string('status')->default('en cours'); // Valeur par défaut : 'en cours'
        
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recettes', function (Blueprint $table) {
            $table->dropForeign(['categorie_id']);
            $table->dropColumn('categorie_id');
            
            $table->dropForeign(['sous_categorie_id']);
            $table->dropColumn('sous_categorie_id');
        });
    }
};

