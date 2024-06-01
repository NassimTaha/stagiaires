<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domaine extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'structuresIAP_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function structuresIAP()
    {
        return $this->belongsTo(StructuresIAP::class, 'structuresIAP_id');
    }
}
