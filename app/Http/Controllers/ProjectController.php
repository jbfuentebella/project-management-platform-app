<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(15);
        
        if (empty($projects)) {
            return ResponseFormatter::errorMsg('No Results Found.');
        }

        return ResponseFormatter::successMsg($projects, 'Projects!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $validated = $request->validated();
        
        $project = new Project($validated);
        $project->slug = Project::generateUniqueSlug(8);

        if ($project->save()) {
            return ResponseFormatter::successMsg($project, 'New Project saved successfully!');
        }

        return ResponseFormatter::errorMsg('Creating Project failed due to error(s) found.', $project->errors, 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $project = Project::findBySlug($slug);

        if (empty($project)) {
            return ResponseFormatter::errorMsg('Project Not Found.');
        }

        return ResponseFormatter::successMsg($project, 'Project Found!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $slug)
    {
        $project = Project::findBySlug($slug);

        if (empty($project)) {
            return ResponseFormatter::errorMsg('Project Not Found.');
        }

        if ($project->delete()){
            return ResponseFormatter::successMsg([], 'Project Deleted!');    
        } else {
            return ResponseFormatter::errorMsg($project->errors, 'Deleting Project failed due to error(s) found.', 422);    
        }
    }
}
