<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousCategorie extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = ['titre', 'image', 'categorie_id'];

    // Define the relationship with the Categorie model
    public function categorie()
    {
        // return $this->belongsTo(Categorie::class);
        return $this->belongsTo(Categorie::class, 'categorie_id'); // Replace 'categorie_id' with your actual foreign key

    }

    // SousCategorie Model
public function recettes()
{
    return $this->hasMany(Recette::class);
}

}
