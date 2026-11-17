<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ALSubjects extends Model
{
    protected $table = 'ALsubjects';

    protected $fillable = [
        'subject_code',
        'name',
        'medium',
        'category',
    ];
}
