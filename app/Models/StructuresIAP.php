<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StructuresIAP extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function structuresAffectations()
    {
        return $this->hasMany(StructuresAffectation::class);
    }

    public function domaines()
    {
        return $this->hasMany(Domaine::class, 'structuresIAP_id');
    }
}
