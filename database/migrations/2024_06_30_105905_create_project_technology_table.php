<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Creo la tabella pivot "project_technology" per la relazione molti-a-molti tra "projects" e "technologies"
        Schema::create('project_technology', function (Blueprint $table) {
            // Definisco la colonna "project_id" come una chiave esterna non firmata
            $table->unsignedBigInteger("project_id");

            // Aggiungo una foreign key su "project_id" che fa riferimento all'ID della tabella "projects" e cancella in cascata
            $table->foreign("project_id")->references("id")->on("projects")->cascadeOnDelete();

            // Definisco la colonna "technology_id" come una chiave esterna non firmata
            $table->unsignedBigInteger("technology_id");
            
            // Aggiungo una foreign key su "technology_id" che fa riferimento all'ID della tabella "technologies" e cancella in cascata
            $table->foreign("technology_id")->references("id")->on("technologies")->cascadeOnDelete();

            // Imposto la chiave primaria composta dalle colonne "project_id" e "technology_id"
            $table->primary(["project_id", "technology_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Elimino la tabella "project_technology" se esiste
        Schema::dropIfExists('project_technology');
    }
};
