<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    // notre class Etudiant à des champs protecteds qui s'appellent fillable
    protected $fillable = ['adresse', 'phone', 'date_de_naissance', 'villeId', 'userId'];

    public function ville()
    { 
        return $this->belongsTo(Ville::class); 
    }
}
// \App\Models\Ville::factory()->has(Etudiant::factory()->count(4))->count(10)->create();