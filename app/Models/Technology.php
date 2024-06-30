<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    // Definisco la relazione con il modello Project
    public function projects()
    {
        // Una tecnologia appartiene a molti progetti
        return $this->belongsToMany(Project::class);
    }
}
