<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = [
        'stage_type',
        'theme',
        'start_date',
        'end_date',
        'cloture_date',
        'reception_days',
        'level',
        'stagiaire_count',
        'year',
        'memoire',
        'cloture',
        'stage_annule',
        'observation',
        'specialite_id',
        'encadrant_id',
        'etablissement_id',
        'structuresAffectation_id',
    ];

    public function specialite()
    {
        return $this->belongsTo(Specialite::class);
    }

    public function encadrant()
    {
        return $this->belongsTo(Encadrant::class);
    }

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }

    public function structureAffectation()
    {
        return $this->belongsTo(StructuresAffectation::class, 'structuresAffectation_id');
    }

    public function stagiaires()
    {

        return $this->hasMany(Stagiaire::class);
    }
}
