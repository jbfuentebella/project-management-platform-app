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
        
        if (empty($developers->count())) {
            return ResponseFormatter::errorMsg('No Results Found.');
        }

        return ResponseFormatter::successMsg($developers, 'Developers!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $developer = Developer::findBySlug($slug);

        if (empty($developer)) {
            return ResponseFormatter::errorMsg('Developer Not Found.');
        }

        return ResponseFormatter::successMsg($developer, 'Developer Found!');
    }
    
}
