<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class OLSubjects extends Model
{
protected $table = 'OLsubjects';

    protected $fillable = [
        'subject_code',
        'name',
        'medium',
        'category',
    ];
}
