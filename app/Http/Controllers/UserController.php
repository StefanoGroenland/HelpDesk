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
use Illuminate\Support\Facades\Hash as Hash;
use Illuminate\Support\Facades\Auth;
use App\Bug as Bug;
use Image as Image;
use Illuminate\Support\Facades\Mail as Mail;

class UserController extends Controller
{
    public function showWelcome()
    {
        if (Auth::user()) {
            return $this->showDashboard();
        } else {
            return View::make('auth/welcome');
        }
    }

    public function showDashboard()
    {
        $klant_id = Auth::user()->id;
        $bugs = Bug::with('chat')->get();
        $bugs_send = Bug::with('chat')->where('klant_id', '=', $klant_id)->get();

        if (\Auth::guest()) {
            return redirect('/');
        } else if (\Auth::user()->rol == 'medewerker') {
//            $temp_projects = Project::has('bug','>',0)->get();
            $temp_projects = Project::whereHas('bug', function ($q) {
                $q->where('status', '!=', 'gesloten');
            })->get();

            $projects = array();

            foreach ($temp_projects as $project) {
                $prio = 0;
                foreach ($project->bug as $bug) {
                    if ($bug->prioriteit > $prio && $bug->status != 'gesloten') {
                        $prio = $bug->prioriteit;
                    }
                }
                $projects[$prio][] = $project;
            }
            krsort($projects);
            $temp_projects = $projects;

            $projects = array();

            foreach ($temp_projects as $priority) {
                foreach ($priority as $project) {
                    $projects[] = $project;
                }
            }
            return View::make('/dashboard', compact('bugs', 'projects'));
        } else {
            $projects_send = Project::with('bug')->where('gebruiker_id', '=', $klant_id)->get();

            $projects = array();

            foreach ($projects_send as $project) {
                $prio = 0;
                foreach ($project->bug as $bug) {
                    if ($bug->prioriteit > $prio && $bug->status != 'gesloten') {
                        $prio = $bug->prioriteit;
                    }
                }
                $projects[$prio][] = $project;
            }

            krsort($projects);
            $projects_send = $projects;
            $projects = array();
            foreach ($projects_send as $priority) {
                foreach ($priority as $project) {
                    $projects[] = $project;
                }
            }


            return View::make('/dashboard', compact('bugs_send', 'projects'));
        }
    }

    public function showMwMuteren($id)
    {
        $medewerker = User::find($id);
        return View::make('medewerkerwijzigen', compact('medewerker'));
    }

    public function showKlantMuteren($id)
    {
        $klant = User::find($id);
        return View::make('klantwijzigen', compact('klant'));
    }

    public function showNewMedewerker()
    {
        $medewerkers = User::all();
        return View::make('newmedewerker', compact('medewerkers'));
    }

    public function showNewKlant()
    {
        return View::make('newklant');
    }

    public function showProfiel()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return View::make('profiel', compact('user'));
    }

    public function updateProfiel(Request $request)
    {
        $id = $request['id'];

        $data = array(
            'id' => $request['id'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => $request['password'],
            'password_confirmation' => $request['password_confirmation'],
            'voornaam' => $request['voornaam'],
            'tussenvoegsel' => $request['tussenvoegsel'],
            'achternaam' => $request['achternaam'],
            'geslacht' => $request['geslacht'],
            'telefoonnummer' => $request['telefoonnummer'],
            'bedrijf' => $request['bedrijf'],
        );

        if (empty($data['password']) || empty($data['password_confirmation'])) {
            array_forget($data, 'password');
            array_forget($data, 'password_confirmation');
        }
        if (Auth::user()->rol == 'medewerker') {
            $rules = array(
                'email' => 'required|unique:gebruikers,email,' . $id,
                'username' => 'required|unique:gebruikers,username,' . $id,
                'telefoonnummer' => 'required|numeric|digits:10',
                'password' => 'min:4|confirmed',
                'password_confirmation' => 'min:4',
                'voornaam' => 'required|min:4|max:50',
                'achternaam' => 'required|min:4|max:50',
            );
        } else {
            $rules = array(
                'email' => 'required|unique:gebruikers,email,' . $id,
                'username' => 'required|unique:gebruikers,username,' . $id,
                'telefoonnummer' => 'required|numeric|digits:10',
                'password' => 'min:4|confirmed',
                'password_confirmation' => 'min:4',
                'voornaam' => 'required|min:4',
                'achternaam' => 'required|min:4',
                'bedrijf' => 'required|min:4',
            );
        }


        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect('/profiel')->withErrors($validator);
        }

        if (array_key_exists('password', $data)) {
            $data['password'] = Hash::make($data['password']);
        } else {
            User::where('id', '=', $id)->update($data);
            $request->session()->flash('alert-warning', 'Uw account is gewijziged, er zijn geen wijzigingen aan het wachtwoord doorgevoerd.');
            return redirect('/profiel');
        }
        array_forget($data, 'password_confirmation');
        User::where('id', '=', $id)->update($data);
        $request->session()->flash('alert-success', 'Uw account is succesvol gewijigd.');
        return redirect('/profiel');
    }

    public function upload(Request $request)
    {
        $id = $request['id'];
        $file = array('profielfoto' => $request->file('profielfoto'));

        $rules = array('profielfoto' => 'required|mimes:jpeg,bmp,png,jpg',);

        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            if ($file) {
                $request->session()->flash('alert-danger', 'U heeft geen bestand / geen geldig bestand gekozen om te uploaden, voeg een foto toe.');
            }
            return redirect('/profiel');
        } else {
            if ($request->file('profielfoto')->isValid()) {

                $destinationPath = 'assets/uploads';
                $extension = $request->file('profielfoto')->getClientOriginalExtension();
                $fileName = rand(1111, 9999) . '.' . $extension;

                $request->file('profielfoto')->move($destinationPath, $fileName);
                $ava = $destinationPath . '/' . $fileName;

                $img = Image::make($ava)->resize(100, 100)->save();


                $final = $destinationPath . '/' . $img->basename;
                User::uploadPicture($id, $final);

                $request->session()->flash('alert-success', 'Uw profiel foto is veranderd.');
                return redirect('/profiel');
            } else {
                $request->session()->flash('alert-danger', 'Er is een fout opgetreden tijdens het uploaden van uw bestand.');
                return redirect('/profiel');
            }
        }
    }

    public function showKlantenOverzicht()
    {
        $klanten = User::where('rol', '!=', 'medewerker')->get();
        return View::make('klanten', compact('klanten'));
    }

    public function showMedewerkersOverzicht()
    {
        $medewerkers = User::getMedewerkers();
        return View::make('medewerkers', compact('medewerkers'));
    }

    public function updateMedewerker(Request $request)
    {
        $id = $request['id'];

        if (isset($_POST['radman'])) {
            $geslacht = 'man';
        } else {
            $geslacht = 'vrouw';
        }

        $data = array(
            'id' => $request['id'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => $request['password'],
            'password_confirmation' => $request['password_confirmation'],
            'voornaam' => $request['voornaam'],
            'tussenvoegsel' => $request['tussenvoegsel'],
            'achternaam' => $request['achternaam'],
            'geslacht' => $geslacht,
            'telefoonnummer' => $request['telefoonnummer'],
        );

        $rules = array(
            'email' => 'required|unique:gebruikers,email,' . $id,
            'username' => 'required|unique:gebruikers,username,' . $id,
            'telefoonnummer' => 'required|numeric|digits:10',
            'voornaam' => 'required|min:3|max:50',
            'achternaam' => 'required|min:3|max:50',
            'password' => 'min:4|confirmed',
            'password_confirmation' => 'min:4',
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect('/medewerkerwijzigen/' . $id)->withErrors($validator);
        }
        if (array_key_exists('password', $data)) {
            $data['password'] = Hash::make($data['password']);
        } else {
            User::where('id', '=', $id)->update($data);
            $request->session()->flash('alert-warning', 'Gebruiker ' . $request['username'] . ' veranderd zonder wijzigingen aan het wachtwoord.');
            return redirect('/medewerkers');
        }
        array_forget($data, 'password_confirmation');
        User::where('id', '=', $id)->update($data);
        $request->session()->flash('alert-success', 'Gebruiker ' . $request['username'] . ' veranderd.');
        return redirect('/medewerkers');
    }

    public function updateKlant(Request $request)
    {
        $id = $request['id'];
        if (isset($_POST['radman'])) {
            $geslacht = 'man';
        } else {
            $geslacht = 'vrouw';
        }
        $data = array(
            'id' => $request['id'],
            'username' => $request['username'],
            'email' => $request['email'],
            'voornaam' => $request['voornaam'],
            'tussenvoegsel' => $request['tussenvoegsel'],
            'achternaam' => $request['achternaam'],
            'geslacht' => $geslacht,
            'telefoonnummer' => $request['telefoonnummer'],
            'bedrijf' => $request['bedrijf'],
            'password' => $request['password'],
            'password_confirmation' => $request['password_confirmation'],
        );

        if (empty($data['password']) || empty($data['password_confirmation'])) {
            array_forget($data, 'password');
            array_forget($data, 'password_confirmation');
        }
        $rules = array(
            'email' => 'required|unique:gebruikers,email,' . $id,
            'username' => 'required|unique:gebruikers,username,' . $id,
            'telefoonnummer' => 'required|numeric|digits:10',
            'voornaam' => 'required|min:3|max:50',
            'achternaam' => 'required|min:3|max:50',
            'bedrijf' => 'required|max:50',
            'password' => 'min:4|confirmed',
            'password_confirmation' => 'min:4',
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect('/klantwijzigen/' . $id)->withErrors($validator);
        }

        if (array_key_exists('password', $data)) {
            $data['password'] = Hash::make($data['password']);
        } else {
            User::where('id', '=', $id)->update($data);
            $request->session()->flash('alert-warning', 'Klant ' . $request['username'] . ' veranderd zonder wijzigingen aan het wachtwoord.');
            return redirect('/klanten');
        }
        array_forget($data, 'password_confirmation');

        User::where('id', '=', $id)->update($data);
        $request->session()->flash('alert-success', 'Klant ' . $request['username'] . ' veranderd.');
        return redirect('/klanten');
    }

    public function getUpdateData()
    {
        $input = $_POST['input'];
        $inputdata = User::getMedewerker($input);
        return $inputdata;
    }

    public function getKlantData()
    {
        $input = $_POST['input'];
        $inputdata = User::getKlant($input);
        return $inputdata;
    }

    public function addMedewerker(Request $request)
    {

        if (isset($_POST['radman'])) {
            $geslacht = 'man';
        } else {
            $geslacht = 'vrouw';
        }

        $data = array(
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => $request['password'],
            'password_confirmation' => $request['password_confirmation'],
            'bedrijf' => 'moodles',
            'voornaam' => $request['voornaam'],
            'tussenvoegsel' => $request['tussenvoegsel'],
            'achternaam' => $request['achternaam'],
            'telefoonnummer' => $request['telefoonnummer'],
            'geslacht' => $geslacht,
            'profielfoto' => 'assets/images/avatar.png',
            'rol' => 'medewerker'
        );

        $rules = array(
            'email' => 'unique:gebruikers|email',
            'username' => 'unique:gebruikers',
            'telefoonnummer' => 'required|numeric|digits:10',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4',
            'geslacht' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect('/newmedewerker')->withErrors($validator)->withInput($data);
        }

        $data['password'] = Hash::make($data['password']);
        array_forget($data, 'password_confirmation');
        User::create($data);
        $request->session()->flash('alert-success', 'Gebruiker ' . $request['username'] . ' toegevoegd.');
        return redirect('/medewerkers');
    }

    public function addUser(Request $request)
    {

        if (isset($_POST['radman'])) {
            $geslacht = 'man';
        } else {
            $geslacht = 'vrouw';
        }

        $data = array(
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => $request['password'],
            'password_confirmation' => $request['password_confirmation'],
            'bedrijf' => $request['bedrijf'],
            'voornaam' => $request['voornaam'],
            'tussenvoegsel' => $request['tussenvoegsel'],
            'achternaam' => $request['achternaam'],
            'telefoonnummer' => $request['telefoonnummer'],
            'geslacht' => $geslacht,
            'profielfoto' => 'assets/images/avatar.png',
            'rol' => 'klant'
        );
        $rules = array(
            'email' => 'required|unique:gebruikers|email',
            'voornaam'  => 'required|max:30',
            'tussenvoegsel' => 'max:30',
            'achternaam'    => 'required|max:60',
            'username' => 'required|unique:gebruikers',
            'telefoonnummer' => 'required|numeric|digits:10',
            'bedrijf' => 'required|max:50',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4',
            'geslacht' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect('/newklant')->withErrors($validator)->withInput($data);
        }
        array_forget($data, 'password_confirmation');
        $data['password'] = Hash::make($request['password']);
        $user = User::create($data);

        $klant = User::find($user->id);
        $dat = array(
            'volledige_naam' => $klant->voornaam . ' ' .
                $klant->tussenvoegsel . ' ' .
                $klant->achternaam,
            'username' => $klant->username,
            'password' => $request['password'],
            'bedrijf' => $klant->bedrijf,
            'email' => $klant->email,
            'id' => $user->id,
            'user' => $user
        );
        Mail::send('emails.newklant', $dat, function ($msg) use ($dat) {
            $klant = User::find($dat['id']);
            $msg->from('helpdesk@moodles.nl', 'Moodles Helpdesk');
            $msg->to($klant->email, $name = null);
            $msg->replyTo('no-reply@moodles.nl', $name = null);
            $msg->subject('Uw account gegevens');
        });
        $request->session()->flash('alert-success', 'Gebruiker ' . $request['username'] . ' toegevoegd.');
        return redirect('/klanten');
    }

    public function verwijderGebruiker()
    {
        $sid = Route::current()->getParameter('id');
        $user = User::find($sid);
        session()->flash('alert-success', 'Gebruiker ' . $user->voornaam . ' verwijderd.');
        return User::verwijderGebruiker($sid);
    }
}