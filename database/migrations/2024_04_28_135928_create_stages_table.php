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
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->enum('stage_type', ['immersion', 'pfe']);
            $table->string('theme');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('cloture_date');
            $table->enum('level', ['Licence', 'Master', 'Doctorat', 'Ingenieur', 'TS']);
            $table->enum('stagiare_count', ['Monome', 'Binome', 'Trinome', 'Quadrinome']);
            $table->unsignedInteger('year')->default(date('Y'));
            $table->string('reception_days');
            $table->boolean('memoire')->default(false);
            $table->boolean('cloture')->default(false);
            $table->string('observation')->nullable();
            $table->unsignedBigInteger('encadrant_id');
            $table->foreign('encadrant_id')->references('id')->on('encadrants')->onDelete('cascade');
            $table->unsignedBigInteger('etablissement_id');
            $table->foreign('etablissement_id')->references('id')->on('etablissements')->onDelete('cascade');
            $table->unsignedBigInteger('structuresAffectation_id');
            $table->foreign('structuresAffectation_id')->references('id')->on('structures_affectations')->onDelete('cascade');
            $table->unsignedBigInteger('specialite_id');
            $table->foreign('specialite_id')->references('id')->on('specialites')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};
