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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')
                ->constrained('admins')
                ->onDelete('cascade');
            $table->string('nom');
            $table->string('first_name');
            $table->string('image'); // Stocke le chemin du fichier image. Vous pouvez ajouter ->nullable() si nécessaire.
            $table->enum('status', ['inactif', 'en attente', 'actif'])->default('en attente');
            $table->timestamps();
            // Index sur la colonne status pour optimiser les requêtes
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
