<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = ['stars', 'comment', 'recette_id', 'status' /*, 'user_id' */];

    public function recette()
    {
        return $this->belongsTo(Recette::class);
    }

    // Commented out user relationship for now
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
