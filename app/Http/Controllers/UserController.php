<?php
/**
 * Created by PhpStorm.
 * User: Stefano
 * Date: 20-11-2015
 * Time: 10:04
 */

namespace App\Http\Controllers;
use App\User;
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Route, View;
class UserController extends Controller
{

    public function showDashboard()
    {
        if(\Auth::guest()){
            return redirect('/');
        }
        else if(\Auth::user()->bedrijf == 'moodles'){
            return View::make('admindashboard');
        }else{
            return redirect('/dashboard');
        }
    }
    public function showBugChat(){
        return View::make('bugchat');
    }
    public function showBugmuteren(){
        return View::make('bugmuteren');
    }
    public function showMwMuteren(){
        return View::make('medewerkermuteren');
    }
    public function getMedewerkers(){
        $medewerkers = User::all();

        return View::make('voorbeeld', compact('medewerkers'));
    }
    public function addMedewerker(Request $request){

        Validator::make($request->all(),[
            'username' => 'required|max:255|unique:gebruikers',
            'email' => 'required|max:255|unique:gebruikers',
            'password' => 'required|confirmed|min:6',
            'bedrijf' => 'required',
            'voornaam' => 'required|min:4',
        ]);
        User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'bedrijf' => 'moodles',
            'voornaam' => $request['voornaam'],
            'achternaam' => $request['achternaam'],
        ]);
        $request->session()->flash('alert-success', 'Gebruiker '. $request['username']. ' toegevoegd.');
        return redirect('medewerkermuteren');
    }
    public function verwijderMedewerker(){
        $sid = Route::current()->getParameter('id');
        return User::verwijderMedewerker($sid);
    }

}