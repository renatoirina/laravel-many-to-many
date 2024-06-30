<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Definisco i campi che possono essere assegnati in massa
    protected $fillable = ["title", "description", "slug", "type_id"];
    
    // Definisco la relazione tra Project e Type (un progetto appartiene a un tipo)
    public function type() {
        return $this->belongsTo(Type::class);
    }

    // Definisco la relazione molti-a-molti tra Project e Technology
    public function technologies() {
        return $this->belongsToMany(Technology::class);
    }
}
