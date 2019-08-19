<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Developer;
use App\ResponseFormatter;

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
