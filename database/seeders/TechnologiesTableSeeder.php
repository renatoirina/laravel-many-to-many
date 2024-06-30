<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ["HTML", "CSS", "JS", "VUE", "VITE", "LARAVEL", "PHP", "MYSQL"];

        foreach ($technologies as $technology) {
            // Creiamo una nuova istanza del modello Technology
            $newTechnology = new Technology();

            // Assegnamo il nome della tecnologia all'istanza
            $newTechnology->name = $technology;

            // Salviamo l'istanza nel database
            $newTechnology->save();
        }
    }
}
