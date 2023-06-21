<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Technology;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::with("technologies")->paginate(8);
        $technologies = Technology::all();

        return response()->json([
            "success" => true,
            "projects" => $projects,
            "technologies" => $technologies
        ]);
    }

    public function carousel(){
        $projects = Project::with("technologies")->take(3)->get();

        return response()->json([
            "success" => true,
            "results" => $projects
        ]);
    }
}
