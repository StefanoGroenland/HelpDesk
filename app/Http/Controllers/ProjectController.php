<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Project as Project;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Hash as Hash;
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
use Route, View;
class ProjectController extends Controller
{
    public function showProjectMuteren(){
        $projects = Project::all();
        return View::make('projectmuteren', compact('projects'));
    }
}
