<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    // Definisco la relazione molti-a-molti tra Technology e Project
    public function projects() {
        return $this->belongsToMany(Project::class);
    }
}
