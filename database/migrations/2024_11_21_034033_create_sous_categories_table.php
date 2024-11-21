<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSousCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('sous_categories', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->string('image');
        $table->unsignedBigInteger('categorie_id'); // Foreign key

        $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sous_categories');
    }
}
