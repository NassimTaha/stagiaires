<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Signataire extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'function',
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
