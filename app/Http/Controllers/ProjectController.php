<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function getData(){
        $projects = Project::where('is_active', 0)
                        ->orderBy('created_at', 'desc')
                        ->take(2)
                        ->get();

        return $projects;
    }

    public function getAllProjects(){
        $projects = Project::orderBy('id', 'desc')->get();

        return $projects;
    }

    public function rendimientoData(){
        Project::chunk(200, function ($projects) {
            foreach ($projects as $project) {
                //Aquí escribimos lo que haremos con los datos (operar, modificar, etc)
            }
        });

        $chunkProject = Project::latest()->get()->chunk(5);
        return $chunkProject;
    }

    public function searchException($parameter){
        // findOrFail 🔍
        $project = Project::findOrFail($parameter);

        // firstOrFail 1️⃣
        $project = Project::where('is_active', '=', 1)->firstOrFail();

        return $project;
    }
}
