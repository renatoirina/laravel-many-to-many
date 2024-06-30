<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Definisco i campi che possono essere riempiti in modo massivo
    protected $fillable = ["title", "description", "slug", "type_id"];

    // Definisco la relazione con il modello Type
    public function type()
    {
        // Un progetto appartiene a un tipo
        return $this->belongsTo(Type::class);
    }

    // Definisco la relazione con il modello Technology
    public function technologies()
    {
        // Un progetto ha molte tecnologie
        return $this->belongsToMany(Technology::class);
    }
}
