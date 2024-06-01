<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stagiaire extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'last_name',
        'first_name',
        'date_of_birth',
        'place_of_birth',
        'phone_number',
        'email',
        'blood_group',
        'attestation_date',
        'quitus',
        'stage_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
