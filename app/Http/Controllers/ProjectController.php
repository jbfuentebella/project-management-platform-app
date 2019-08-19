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
        return Project::paginate(15);
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

        if ($project->save()) {
            return $this->successMsg($project, 'New Project saved successfully!');
        }

        return errrorMsg($project->errors, 'Creating Project failed due to error(s) found.', 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $project = Project::findByEmail($slug);

        if (empty($project)) {
            return errrorMsg([], 'Project Not Found.', 404);
        }

        return $this->successMsg($project, 'Project Found!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $slug)
    {
        $project = Project::findByEmail($slug);

        if (empty($project)) {
            return errrorMsg([], 'Project Not Found.', 404);
        }

        if ($project->delete()){
            return $this->successMsg([], 'Project Deleted!');    
        }

        return errrorMsg($project->errors, 'Deleting Project failed due to error(s) found.', 422);   
    }
}
