<?php

namespace App\Http\Controllers;

use App\Models\OLSubjects;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $record = $user->olsubjects;

        $OLSubjects = $record ? $record->getAllSubjects() : collect();
        
        return view('pages.subjects',[
            'OLSubjects' => $OLSubjects
        ]);
    }
}
