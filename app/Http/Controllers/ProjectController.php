<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Project as Project;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Hash as Hash;
use Illuminate\Support\Facades\Validator;
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
use Route, View;
class ProjectController extends Controller
{
    public function showProjectMuteren(){
        $projects = Project::all();
        return View::make('projectmuteren', compact('projects'));
    }
    public function addProject(Request $request){

        Validator::make($request->all(),[
            'titel' => 'required|max:255|unique:projecten',
            'status'    => 'required',
            'prioriteit' => 'required',
            'type'  => 'required',
            'projectnaam' => 'required',
            'projecturl' => 'required',
            'gebruikersnaam' => 'required',
            'wachtwoord' => 'required',
            'voornaam' => 'required',
            'achternaam' => 'required',
            'email' => 'required',
            'bedrijf' => 'required',
            'telefoonnummer' => 'required',
            'omschrijvingproject' => 'required',
        ]);
        Project::create([

            'titel'  => $request['titel'],
            'status'     => $request['status'],
            'prioriteit'  => $request['prioriteit'],
            'type'   => $request['type'],
            'projectnaam'  => $request['projectnaam'],
            'projecturl'  => $request['projecturl'],
            'gebruikersnaam'  => $request['gebruikersnaam'],
            'wachtwoord' => bcrypt($request['wachtwoord']),
            'voornaam'  => $request['voornaam'],
            'achternaam' => $request['achternaam'],
            'email'=> $request['email'],
            'bedrijf' => $request['bedrijf'],
            'telefoonnummer' => $request['telefoonnummer'],
            'omschrijvingproject' => $request['omschrijvingproject'],
        ]);
        $request->session()->flash('alert-success', 'Project '. $request['titel']. ' toegevoegd.');
        return redirect('projectmuteren');
    }

    public function verwijderProject(){
//      flash of alert bij voegen?
        $sid = Route::current()->getParameter('id');
        return Project::verwijderProject($sid);
    }
}
