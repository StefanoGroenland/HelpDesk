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
        return View::make('projectwijzigen', compact('project'));
    }
    public function showProjectenOverzicht(){
        $projects   =   Project::with('user')->get();
        return View::make('projecten' , compact('projects'));
    }
    public function showNewProject(){
        $projects   =   Project::all();
        $klanten    =   Project::getUsers();
        return View::make('newproject', compact('projects', 'klanten'));
    }
    public function addProject(Request $request){

            if(isset($_POST['radman'])){
                $geslacht = 'man';
            }else{
                $geslacht = 'vrouw';
            }

            if (isset($_POST['radmaak'])) {
                $data = array(
                    'projectnaam'                   => $request['projectnaam'],
                    'liveurl'                       => $request['liveurl'],
                    'developmenturl'                => $request['developmenturl'],
                    'gebruikersnaam'                => $request['gebruikersnaam'],
                    'wachtwoord'                    => $request['wachtwoord'],
                    'omschrijvingproject'           => $request['omschrijvingproject'],

                    'username'                      => $request['username'],
                    'password'                      => $request['password'],
                    'password_confirmation'         => $request['password_confirmation'],
                    'email'                         => $request['email'],
                    'bedrijf'                       => $request['bedrijf'],
                    'voornaam'                      => $request['voornaam'],
                    'tussenvoegsel'                 => $request['tussenvoegsel'],
                    'achternaam'                    => $request['achternaam'],
                    'geslacht'                      => $geslacht,
                    'telefoonnummer'                => $request['telefoonnummer'],
                );

                $rules = array(
                    'telefoonnummer'                => 'numeric',
                    'email'                         => 'required|unique:gebruikers',
                    'password'                      => 'required|confirmed|min:4',
                    'password_confirmation'         => 'required',
                    'voornaam'                      => 'required|min:4',
                    'achternaam'                    => 'required|min:4',
                    'bedrijf'                       => 'required|not_in:moodles,Moodles',
                    'username'                      => 'required|min:4|unique:gebruikers',
                    'projectnaam'                   => 'required|min:4',
                    'gebruikersnaam'                => 'required|min:4',
                    'wachtwoord'                    => 'required|min:4',
                    'geslacht'                      => 'required',


                    'projectnaam'                   => 'required|unique:projecten',
                    'liveurl'                       => 'required',
                    'gebruikersnaam'                => 'required',
                    'wachtwoord'                    => 'required',
                    'omschrijvingproject'           => 'required',
                );


                array_forget($request, 'password_confirmation');

                $valid = Validator::make($data,$rules);
                if ($valid->fails()) {
                    return redirect('/newproject')->withErrors($valid)->withInput($data);
                } else {

                    $user = User::create([
                        'username'                  => $request['username'],
                        'password'                  => $request['password'],
                        'email'                     => $request['email'],
                        'bedrijf'                   => $request['bedrijf'],
                        'voornaam'                  => $request['voornaam'],
                        'tussenvoegsel'             => $request['tussenvoegsel'],
                        'achternaam'                => $request['achternaam'],
                        'geslacht'                  => $geslacht,
                        'telefoonnummer'            => $request['telefoonnummer'],
                        'profielfoto'               => 'assets/images/avatar.png',
                    ]);
                    $proj = Project::create([
                        'projectnaam'               => $request['projectnaam'],
                        'liveurl'                   => $request['liveurl'],
                        'developmenturl'            => $request['developmenturl'],
                        'gebruikersnaam'            => $request['gebruikersnaam'],
                        'wachtwoord'                => Crypt::encrypt($request['wachtwoord']),
                        'omschrijvingproject'       => $request['omschrijvingproject'],
                        'gebruiker_id'              => $user->id,
                    ]);
                }
                $request['password'] = Hash::make($request['password']);
                $request->session()->flash('alert-success', 'Project toegevoegd.');
                return redirect('/bugs/'.$proj->id);
            }
            elseif
                (isset($_POST['radkoppel'])) {
                $data = array(
                    'projectnaam'           => $request['projectnaam'],
                    'liveurl'               => $request['liveurl'],
                    'developmenturl'        => $request['developmenturl'],
                    'gebruikersnaam'        => $request['gebruikersnaam'],
                    'wachtwoord'            => Crypt::encrypt($request['wachtwoord']),
                    'omschrijvingproject'   => $request['omschrijvingproject'],
                    'gebruiker_id'          => $request['gebruiker_id'],
                );
                $rules = array(
                    'projectnaam'                   => 'required|unique:projecten',
                    'liveurl'                       => 'required',
                    'gebruikersnaam'                => 'required',
                    'wachtwoord'                    => 'required',
                    'omschrijvingproject'           => 'required',
                );
                $validator = Validator::make($data,$rules);
                if ($validator->fails()) {
                    return redirect('/newproject')->withErrors($validator)->withInput($data);
                } else {
                        $proj = Project::create([
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
        $request->session()->flash('alert-success', 'Project toegevoegd.');
        return redirect('/bugs/'.$proj->id);
    }
    public function updateProject(Request $request){
        $id = Route::current()->getParameter('id');
        $data = array(
            'id'                                    => $id,
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
