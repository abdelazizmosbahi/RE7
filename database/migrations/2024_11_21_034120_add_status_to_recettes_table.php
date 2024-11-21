<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
//     public function up()
// {
//     Schema::table('recettes', function (Blueprint $table) {
//         $table->string('status')->default('en cours'); // Définir un statut par défaut
//     });
// }

public function up()
{
    if (!Schema::hasColumn('recettes', 'status')) {
        Schema::table('recettes', function (Blueprint $table) {
            $table->string('status')->default('en cours')->notNullable();
        });
    }
}

public function down()
{
    Schema::table('recettes', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}

};
