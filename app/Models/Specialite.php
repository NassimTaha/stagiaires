<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialite extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'domaine_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function domaine()
    {
        return $this->belongsTo(Domaine::class);
    }
}
