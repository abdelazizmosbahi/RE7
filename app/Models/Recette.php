<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre', 
        'image', 
        'categorie_id', 
        'sous_categorie_id', 
        'ingredients', 
        'methode_preparation', 
        'informations_complementaire',
        'status'
    ];
    public $timestamps = true; // Ceci est par défaut

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function sousCategorie()
    {
        return $this->belongsTo(SousCategorie::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}
