<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Project as Project;
use App\User as User;
use Illuminate\Support\Facades\Hash as Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
use Route, View;
class ProjectController extends Controller
{
    public function showProjectMuteren($id){
        $project    =   Project::find($id);
        return View::make('projectmuteren', compact('project'));
    }
    public function showProjectenOverzicht(){
        $projects   =   Project::all();
        return View::make('projecten' , compact('projects'));
    }
    public function showNewProject(){
        $projects   =   Project::all();
        $klanten    =   Project::getUsers();
        return View::make('newproject', compact('projects', 'klanten'));
    }
    public function addProject(Request $request){

        if(isset($_POST['radmaak']) && is_numeric($request['telefoonnummer']) == false){
            $request->session()->flash('alert-danger', 'Telefoonnummer moet numeriek zijn.');
            return redirect('/newproject');
        }elseif($request['bedrijf'] == 'moodles') {
            $request->session()->flash('alert-danger', 'Klantaccount mag geen \'moodles\' bevatten als bedrijfsnaam.');
            return redirect('/newproject');
        }else {
            if (isset($_POST['radmaak'])) {

                $valid = Validator::make($request->all(), [

                    'telefoonnummer'                => 'numeric',
                    'email'                         => 'required|unique:gebruikers',
                    'password'                      => 'required|confirmed|min:4',
                    'password_confirmation'         => 'required',
                    'voornaam'                      => 'required|min:4',
                    'achternaam'                    => 'required|min:4',
                    'bedrijf'                       => 'required|min:4',
                    'username'                      => 'required|min:4|unique:gebruikers',
                    'projectnaam'                   => 'required|min:4',
                    'gebruikersnaam'                => 'required|min:4',
                    'wachtwoord'                    => 'required|min:4',


                    'projectnaam'                   => 'required|unique:projecten',
                    'liveurl'                       => 'required',
                    'developmenturl'                => 'required',
                    'gebruikersnaam'                => 'required',
                    'wachtwoord'                    => 'required',
                    'omschrijvingproject'           => 'required',
                ]);
                $request['password'] = Hash::make($request['password']);
                array_forget($request, 'password_confirmation');

                if ($valid->fails()) {
                    return redirect('/newproject')->withErrors($valid);
                } else {

                    $user = User::create([
                        'username'                  => $request['username'],
                        'password'                  => $request['password'],
                        'email'                     => $request['email'],
                        'bedrijf'                   => $request['bedrijf'],
                        'voornaam'                  => $request['voornaam'],
                        'tussenvoegsel'             => $request['tussenvoegsel'],
                        'achternaam'                => $request['achternaam'],
                        'geslacht'                  => $request['geslacht'],
                        'telefoonnummer'            => $request['telefoonnummer'],
                        'profielfoto'               => 'assets/images/avatar.png',
                    ]);
                    Project::create([
                        'projectnaam'               => $request['projectnaam'],
                        'liveurl'                   => $request['liveurl'],
                        'developmenturl'            => $request['developmenturl'],
                        'gebruikersnaam'            => $request['gebruikersnaam'],
                        'wachtwoord'                => Crypt::encrypt($request['wachtwoord']),
                        'omschrijvingproject'       => $request['omschrijvingproject'],
                        'gebruiker_id'              => $user->id,
                    ]);
                }
            }
            elseif
                (isset($_POST['radkoppel'])) {

                $validator = Validator::make($request->all(), [
                    'projectnaam'                   => 'required|unique:projecten',
                    'liveurl'                       => 'required|url',
                    'developmenturl'                => 'required',
                    'gebruikersnaam'                => 'required',
                    'wachtwoord'                    => 'required',
                    'omschrijvingproject'           => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect('/newproject')->withErrors($validator);
                } else {
                        Project::create([
                            'projectnaam'           => $request['projectnaam'],
                            'liveurl'               => $request['liveurl'],
                            'developmenturl'        => $request['developmenturl'],
                            'gebruikersnaam'        => $request['gebruikersnaam'],
                            'wachtwoord'            => Crypt::encrypt($request['wachtwoord']),
                            'omschrijvingproject'   => $request['omschrijvingproject'],
                            'gebruiker_id'          => $request['gebruiker_id'],
                        ]);
                    }
                }
            }
        $request->session()->flash('alert-success', 'Project toegevoegd.');
        return redirect('/newproject');
    }
    public function updateProject(Request $request){
        $id = $request['id'];
        $data = array(
            'id'                                    => $request['id'],
            'status'                                => $request['status'],
            'prioriteit'                            => $request['prioriteit'],
            'soort'                                 => $request['soort'],
            'projectnaam'                           => $request['projectnaam'],
            'liveurl'                               => $request['liveurl'],
            'developmenturl'                        => $request['developmenturl'],
            'gebruikersnaam'                        => $request['gebruikersnaam'],
            'wachtwoord'                            => Crypt::encrypt($request['wachtwoord']),
            'omschrijvingproject'                   => $request['omschrijvingproject'],
        );
        Project::where('id', '=', $id)->update($data);
        $request->session()->flash('alert-success', 'Project '. $request['projectnaam']. ' veranderd.');
        return redirect('/projecten');
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
