<?php

namespace App\Http\Controllers;

use App\Developer;
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
        return Developer::paginate(15);
    }
    
}
