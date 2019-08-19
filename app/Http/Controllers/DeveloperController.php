<?php

namespace App\Http\Controllers;

use App\Developer;
use App\ResponseFormatter;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $developers = Developer::paginate(15);
        
        if (empty($developers)) {
            return ResponseFormatter::errorMsg('No Results Found.');
        }

        return ResponseFormatter::successMsg($developers, 'Developers!');
    }
    
}
