<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StructuresAffectation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'quota_pfe',
        'quota_im',
        'parent_id',
        'structuresIAP_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function structuresIAP()
    {
        return $this->belongsTo(StructuresIAP::class, 'structuresIAP_id');
    }

    public function encadrants()
    {
        return $this->hasMany(Encadrant::class);
    }

    public function parent()
    {
        return $this->belongsTo(StructuresAffectation::class, 'parent_id');
    }

    public function stages()
    {
        return $this->hasMany(Stage::class, 'structuresAffectation_id');
    }
}
