<?php
/**
 * Created by PhpStorm.
 * User: Stefano
 * Date: 20-11-2015
 * Time: 10:04
 */

namespace App\Http\Controllers;
use App\Admin;
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\User;
use Route;
class AdminController extends Controller
{
    public function showDashboard()
    {
        $admin = new Admin();
        return $admin->showAdminDashboard();
    }
    public function showMwMuteren(){
        $admin = new Admin();
        return $admin->showMedewerkerMuteren();
    }
    public function showMedewerkers(){
        $admin = new Admin();
        return $admin->getMedewerkers();
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
    public function deleteRow(){
        $admin = new Admin();
        $sid = Route::current()->getParameter('id');
        return $admin->deleteRow($sid);
    }

}