<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model
{
    use HasFactory;

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
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
