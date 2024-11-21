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
        return $this->belongsTo(Categorie::class);
    }
}
