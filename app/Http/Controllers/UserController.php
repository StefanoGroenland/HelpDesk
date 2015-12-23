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
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Route, View;
use Symfony\Component\Console\Input\Input as Input;
use Illuminate\Support\Facades\Hash as Hash;
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
    public function showMwMuteren($id){
        $medewerker = User::find($id);
        return View::make('medewerkermuteren', compact('medewerker'));
    }
    public function showKlantMuteren($id){
        $klant = User::find($id);
        return View::make('klantmuteren', compact('klant'));
    }
    public function showNewMedewerker(){
        $medewerkers = User::all();
        return View::make('newmedewerker', compact('medewerkers'));
    }
    public function showNewKlant(){
        return View::make('newklant');
    }
    public function showProfiel(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return View::make('profiel',compact('user'));
    }
    public function updateProfiel(Request $request){
        $id = $request['id'];
        $data = array(
            'id'         => $request['id'],
            'username'   => $request['username'],
            'email'      => $request['email'],
            'password'   => Hash::make($request['password']),
            'voornaam'   => $request['voornaam'],
            'tussenvoegsel'   => $request['tussenvoegsel'],
            'achternaam' => $request['achternaam'],
            'geslacht' => $request['geslacht'],
            'telefoonnummer' => $request['telefoonnummer'],
            'bedrijf' => $request['bedrijf'],
            'profielfoto' => $request['profielfoto'],
        );
        User::where('id','=', $id)->update($data);
        $request->session()->flash('alert-success', 'Gebruiker '. $request['username']. ' veranderd.');
        return redirect('/profiel');
    }

    public function upload(Request $request){
        $id = $request['id'];
        $file = array('profielfoto' => $request->file('profielfoto'));

        $rules = array('profielfoto' => 'required|mimes:jpeg,bmp,png,jpg',);

        $validator = Validator::make($file,$rules);
        if($validator->fails()){
            if($file){
                $request->session()->flash('alert-warning', 'Geen foto !');
            }
            else{
                $request->session()->flash('alert-warning', 'Verkeerd type bestand');
            }
            return redirect('/profiel');
        }
        else{
            if($request->file('profielfoto')->isValid()){

                $destinationPath = 'assets/uploads';
                $extension = $request->file('profielfoto')->getClientOriginalExtension();
                $fileName = rand(1111,9999).'.'.$extension;

                $request->file('profielfoto')->move($destinationPath,$fileName);
                $ava = $destinationPath .'/'. $fileName;
                User::uploadPicture($id,$ava);

                $request->session()->flash('alert-success', 'goed');
                return redirect('/profiel');
            }
            else{
                $request->session()->flash('alert-danger', 'fout');
                return redirect('/profiel');
            }
        }
    }

    public function showKlantenOverzicht(){
        $klanten = User::where('bedrijf','!=', 'moodles')->get();
        return View::make('klanten' , compact('klanten'));
    }
    public function showMedewerkersOverzicht(){
        $medewerkers = User::getMedewerkers();
        return View::make('medewerkers' , compact('medewerkers'));
    }
    public function updateMedewerker(Request $request){
            $id = $request['id'];
            $data = array(
                'id'         => $request['id'],
                'username'   => $request['username'],
                'email'      => $request['email'],
                'password'   => bcrypt($request['password']),
                'voornaam'   => $request['voornaam'],
                'tussenvoegsel'   => $request['tussenvoegsel'],
                'achternaam' => $request['achternaam'],
                'geslacht' => $request['geslacht'],
                'telefoonnummer' => $request['telefoonnummer'],
            );
            User::where('id', '=', $id)->update($data);
        $request->session()->flash('alert-success', 'Gebruiker '. $request['username']. ' veranderd.');
            return redirect('/medewerkers');
    }
    public function updateKlant(Request $request){
        $id = $request['id'];
        $data = array(
            'id'         => $request['id'],
            'username'   => $request['username'],
            'email'      => $request['email'],
            'password'   => bcrypt($request['password']),
            'voornaam'   => $request['voornaam'],
            'tussenvoegsel'   => $request['tussenvoegsel'],
            'achternaam' => $request['achternaam'],
            'geslacht' => $request['geslacht'],
            'telefoonnummer' => $request['telefoonnummer'],
            'bedrijf' => $request['bedrijf'],
        );
        User::where('id', '=', $id)->update($data);
        $request->session()->flash('alert-success', 'Klant '. $request['username']. ' veranderd.');
        return redirect('/klanten');
    }
    public function getUpdateData(){
        $input = $_POST['input'];
        $inputdata = User::getMedewerker($input);
        return $inputdata;
    }
    public function getKlantData(){
        $input = $_POST['input'];
        $inputdata = User::getKlant($input);
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
    return redirect('newmedewerker');

}
    public function addUser(Request $request){

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
            'bedrijf'    => $request['bedrijf'],
            'voornaam'   => $request['voornaam'],
            'tussenvoegsel'   => $request['tussenvoegsel'],
            'achternaam' => $request['achternaam'],
            'telefoonnummer' => $request['telefoonnummer'],
            'geslacht' => $request['geslacht'],
        ]);
        $request->session()->flash('alert-success', 'Gebruiker '. $request['username']. ' toegevoegd.');
        return redirect('newmedewerker');

    }
    public function verwijderGebruiker(){
        $sid = Route::current()->getParameter('id');
        session()->flash('alert-danger', 'Gebruiker met id : '. $sid . ' verwijderd.');
        return User::verwijderGebruiker($sid);
    }
    public function resetUserPassword(Request $request){
        $email = $request->input('email');
        $data = array(
            'email'   => $request['email'],
            'password'   => bcrypt($request['password']),
        );
        User::where('email', '=', $email)->update($data);
        $request->session()->flash('alert-success',  $request['email']. ' veranderd.');
        return redirect('/admindashboard');
    }
}