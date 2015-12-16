<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Project as Project;
use App\User as User;
use App\Http\Controllers\Hash as Hash;
use Illuminate\Support\Facades\Validator;
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
use Route, View;
class ProjectController extends Controller
{
    public function showProjectMuteren(){
        $projects = Project::all();
        $klanten = Project::getUsers();
        return View::make('projectmuteren', compact('projects', 'klanten'));
    }
    public function showNewProject(){
        $projects = Project::all();
        $klanten = Project::getUsers();
        return View::make('newproject', compact('projects', 'klanten'));
    }
    public function addProject(Request $request){

        if(isset($_POST['radmaak'])){
            Validator::make($request->all(),[
//                projecten table
                'titel' => 'required|max:255|unique:projecten',
                'status'    => 'required',
                'prioriteit' => 'required',
                'soort'  => 'required',
                'projectnaam' => 'required',
                'projecturl' => 'required',
                'gebruikersnaam' => 'required',
                'wachtwoord' => 'required',
                'omschrijvingproject' => 'required',
                'gebruiker_id' => 'required',

//                gebruikers table
                'username'  => $request['username'],
                'password'  => bcrypt($request['password']),
                'email'  => $request['email'],
                'bedrijf'  => $request['bedrijf'],
                'voornaam'  => $request['voornaam'],
                'tussenvoegsel'  => $request['tussenvoegsel'],
                'achternaam'  => $request['achternaam'],
                'geslacht'  => $request['geslacht'],
                'telefoonnummer'  => $request['telefoonnummer'],
            ]);
            $user = User::create([
                    'username'  => $request['username'],
                    'password'  => bcrypt($request['password']),
                    'email'  => $request['email'],
                    'bedrijf'  => $request['bedrijf'],
                    'voornaam'  => $request['voornaam'],
                    'tussenvoegsel'  => $request['tussenvoegsel'],
                    'achternaam'  => $request['achternaam'],
                    'geslacht'  => $request['geslacht'],
                    'telefoonnummer'  => $request['telefoonnummer'],
                ]);
            Project::create([
                'titel'  => $request['titel'],
                'status'     => $request['status'],
                'prioriteit'  => $request['prioriteit'],
                'soort'   => $request['soort'],
                'projectnaam'  => $request['projectnaam'],
                'projecturl'  => $request['projecturl'],
                'gebruikersnaam'  => $request['gebruikersnaam'],
                'wachtwoord' => bcrypt($request['wachtwoord']),
                'omschrijvingproject' => $request['omschrijvingproject'],
                'gebruiker_id' => $user->id,
            ]);
            }
            elseif(isset($_POST['radkoppel'])){
                Validator::make($request->all(),[
//                projecten table
                    'titel' => 'required|max:255|unique:projecten',
                    'status'    => 'required',
                    'prioriteit' => 'required',
                    'soort'  => 'required',
                    'projectnaam' => 'required',
                    'projecturl' => 'required',
                    'gebruikersnaam' => 'required',
                    'wachtwoord' => 'required',
                    'omschrijvingproject' => 'required',
                    'gebruiker_id' => 'required',
                    ]);
                Project::create([
                    'titel'  => $request['titel'],
                    'status'     => $request['status'],
                    'prioriteit'  => $request['prioriteit'],
                    'soort'   => $request['soort'],
                    'projectnaam'  => $request['projectnaam'],
                    'projecturl'  => $request['projecturl'],
                    'gebruikersnaam'  => $request['gebruikersnaam'],
                    'wachtwoord' => bcrypt($request['wachtwoord']),
                    'omschrijvingproject' => $request['omschrijvingproject'],
                    'gebruiker_id' => $request['gebruiker_id'],
                ]);
            }
        $request->session()->flash('alert-success', 'Project '. $request['titel']. ' toegevoegd.');
        return redirect('/newproject');
    }
    public function updateProject(Request $request){
        $input = $request->input('zoeknaam');

        $data = array(
            'titel'  => $request['titel'],
            'status'     => $request['status'],
            'prioriteit'  => $request['prioriteit'],
            'soort'   => $request['soort'],
            'projectnaam'  => $request['projectnaam'],
            'projecturl'  => $request['projecturl'],
            'gebruikersnaam'  => $request['gebruikersnaam'],
            'wachtwoord' => bcrypt($request['wachtwoord']),
            'omschrijvingproject' => $request['omschrijvingproject'],
        );
        Project::where('projectnaam', 'LIKE', '%'.$input.'%')->update($data);
        $request->session()->flash('alert-success', 'Project '. $request['projectnaam']. ' veranderd.');
        return redirect('/projectmuteren');
    }
    public function getUpdateData(){
        $input = $_POST['input'];
        $inputdata = Project::getProjectOnSearch($input);
        return $inputdata;
    }

    public function verwijderProject(){
//      flash of alert bij voegen?
        $sid = Route::current()->getParameter('id');
        session()->flash('alert-danger', 'Project met id : '. $sid . ' verwijderd.');
        return Project::verwijderProject($sid);
    }
}
