<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Définir les relations si nécessaire
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
