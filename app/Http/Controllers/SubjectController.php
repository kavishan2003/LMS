<?php

namespace App\Http\Controllers;

use App\Models\OLSubjects;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class SubjectController extends Controller
{
    public function index()
    {
        $OLSubjects = OLSubjects::all();
        
        return view('pages.subjects',[
            'OLSubjects' => $OLSubjects
        ]);
    }
}
