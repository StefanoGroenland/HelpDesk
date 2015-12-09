<?php
/**
 * Created by PhpStorm.
 * User: Stefano
 * Date: 20-11-2015
 * Time: 10:04
 */

namespace App\Http\Controllers;
use App\User as User;
use App\Project as Project;
use App\Http\Controllers\Hash as Hash;
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Route, View;
use Illuminate\Support\Facades\Auth;
use App\Bug as Bug;
class UserController extends Controller
{

    public function showDashboard()
    {
        $klant_id = Auth::user()->id;
        $bugs = Bug::all();
        $bugs_send = Bug::where('klant_id' , '=', $klant_id)->get();
        $projects = Project::all();
        $projects_send = Project::where('gebruiker_id', '=', $klant_id)->get();
        if(\Auth::guest()){
            return redirect('/');
        }
        else if(\Auth::user()->bedrijf == 'moodles'){
            return View::make('/admindashboard', compact('bugs','projects'));
        }else{
            return View::make('/dashboard', compact('bugs_send','projects_send'));
        }
    }
    public function showMwMuteren(){
        $medewerkers = User::all();
        return View::make('medewerkermuteren', compact('medewerkers'));
    }
    public function showProfiel(){
        return View::make('profiel');
    }
    public function showProjectMuteren(){
        return View::make('projectmuteren');
    }
    public function updateMedewerker(Request $request){
            $email = $request->input('zoekmail');
            $data = array(
                'username'   => $request['username'],
                'email'      => $request['email'],
                'password'   => bcrypt($request['password']),
                'voornaam'   => $request['voornaam'],
                'tussenvoegsel'   => $request['tussenvoegsel'],
                'achternaam' => $request['achternaam'],
                'geslacht' => $request['geslacht'],
                'telefoonnummer' => $request['telefoonnummer'],
            );
            User::where('email', 'LIKE', '%'.$email.'%')->update($data);
        $request->session()->flash('alert-success', 'Gebruiker '. $request['username']. ' veranderd.');
            return redirect('/medewerkermuteren');
    }
    public function getUpdateData(){
        $email = $_POST['email'];
        $inputdata = User::getMedewerker($email);

        return $inputdata;
    }
    public function addMedewerker(Request $request){

        Validator::make($request->all(),[
            'username' => 'required|max:255|unique:gebruikers',
            'email'    => 'required|max:255|unique:gebruikers',
            'password' => 'required|min:6',
            'bedrijf'  => 'required',
            'voornaam' => 'required',
            'tussenvoegsel' => 'required',
            'achternaam' => 'required',
            'telefoonnummer' => 'required',
            'geslacht' => 'required',
        ]);
        User::create([
            'username'   => $request['username'],
            'email'      => $request['email'],
            'password'   => bcrypt($request['password']),
            'bedrijf'    => 'moodles',
            'voornaam'   => $request['voornaam'],
            'tussenvoegsel'   => $request['tussenvoegsel'],
            'achternaam' => $request['achternaam'],
            'telefoonnummer' => $request['telefoonnummer'],
            'geslacht' => $request['geslacht'],
        ]);
        $request->session()->flash('alert-success', 'Gebruiker '. $request['username']. ' toegevoegd.');
        return redirect('medewerkermuteren');

    }
    public function verwijderGebruiker(){
        $sid = Route::current()->getParameter('id');
        session()->flash('alert-danger', 'Gebruiker met id : '. $sid . ' verwijderd.');
        return User::verwijderGebruiker($sid);
    }
    public function resetUserPassword(Request $request){
        $username = $request->input('username');
        $data = array(
            'username'   => $request['username'],
            'password'   => bcrypt($request['password']),
        );
        User::where('username', '=', $username)->update($data);
        $request->session()->flash('alert-success', 'Gebruiker '. $request['username']. ' veranderd.');
        return redirect('/admindashboard');
    }
}