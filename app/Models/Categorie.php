<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'image'];

    public static function rules()
    {
        return [
            'titre' => 'required|string|unique:categories,titre',
            'image' => 'required|string|max:50',
        ];
    }
    
    public function sousCategories()
    {
        return $this->hasMany(SousCategorie::class);
    }
}

