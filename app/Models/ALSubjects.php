<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ALSubjects extends Model
{
    protected $table = 'alsubjects';

    protected $fillable = [
        'id',
        'subject_code',
        'name',
        'medium',
        'stream', // e.g., 'Physical Science', 'Biological Science', 'Commerce', 'Arts', 'Engineering Technology', 'Bio Systems Technology', 'Compulsory'
    ];
}