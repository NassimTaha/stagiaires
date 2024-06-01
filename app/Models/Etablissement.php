<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Etablissement extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'wilaya',
        'type',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
