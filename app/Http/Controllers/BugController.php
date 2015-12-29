<?php

namespace App\Http\Controllers;


use App\BugAttachment;
use App\Http\Requests;
use App\Bug as Bug;
use Storage;
use App\User as User;
use App\Chat as Chat;
use App\Project as Project;
use App\Http\Controllers\Hash as Hash;
use Illuminate\Support\Facades\Validator;
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
use Route, View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class BugController extends Controller
{
    public function showBugChat($id){
        $bug = Bug::with('klant','user')->find($id);
        $afzenders = Chat::with('medewerker','klant')->where('bug_id','=',$id)->get();
        $medewerkers = User::where('bedrijf' ,'=', 'moodles')->get();
        $bug_attachments = BugAttachment::where('bug_id','=',$id)->get();
        return View::make('/bugchat', compact('bug', 'medewerkers','afzenders','bug_attachments'));
    }
    public function refreshChat($id){
        return $afzenders = Chat::with('medewerker','klant')->where('bug_id','=',$id)->get();
    }
    public function feedCount($id){
        return $query = Chat::where('bug_id','=',$id)->get();
    }
    public function showBugmuteren(){
        $user_id = Auth::user()->id;
        $projecten = Project::where('gebruiker_id', '=', $user_id)->get();
        return View::make('/bugmuteren' , compact('projecten'));
    }

    public function showBugOverzicht($id){
        if($id == Auth::user()->id){
            $bugs_related = $this->getRelatedBugs($id);
            $bugs_all = Bug::with('klant','user')->orderBy('id','desc')->get();
            $projects = Project::where('gebruiker_id','=', $id)->get();
            $projects_all = Project::all();
            $klanten = User::all();
            return View::make('/bugoverzicht', compact('bugs_related', 'bugs_all', 'projects', 'projects_all', 'klanten'));
        }else{
            return redirect('/dashboard');
        }
    }

    public function verwijderBug(){
        $sid = Route::current()->getParameter('id');
        session()->flash('alert-danger', 'Bug met id : '. $sid . ' verwijderd.');
        Bug::verwijderBug($sid);
        return redirect('/bugoverzicht/'. Auth::user()->id);
    }

    public function getRelatedBugs($id){
        if(Auth::user()->bedrijf == 'moodles'){
            $bugs = Bug::where('medewerker_id','=', $id)->get();
        }else{
            $bugs = Bug::where('klant_id','=', $id)->get();
        }
        return $bugs;
    }
    public function updateBug($id,Request $request){
        $bug = Bug::find($id);
        $data = array(
            'prioriteit'        => $request['prioriteit'],
            'soort'             => $request['soort'],
            'status'            => $request['status'],
            'medewerker_id'     => $request['medewerker'],
        );
        Bug::where('id', '=', $bug->id)->update($data);
        $request->session()->flash('alert-success', 'Bug # '. $bug->id . ' veranderd.');
        return redirect('/bugchat/'. $bug->id);
    }


    public function addBug( Request $request){

        $data = array(
            'titel'             => $request['titel'],
            'prioriteit'        => $request['prioriteit'],
            'soort'             => $request['soort'],
            'status'            => 'open',
            'start_datum'       => $request['start_datum'],
            'eind_datum'        => $request['eind_datum'],
            'beschrijving'      => $request['beschrijving'],
            'klant_id'          => Auth::user()->id,
            'project_id'        => $request['project'],
        );

        $rules = array(
            'titel'             => 'required',
            'prioriteit'        => 'required',
            'soort'             => 'required',
            'status'            => 'required',
            'start_datum'       => 'required',
            'eind_datum'        => 'required',
            'beschrijving'      => 'required',
            'klant_id'          => 'required',
            'project_id'        => 'required',
        );
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            return redirect('/bugmuteren')->withErrors($validator);
        }
        Bug::create($data);
        $request->session()->flash('alert-success', 'Bug'. $request['titel']. ' toegevoegd.');
        return redirect('/bugmuteren');
    }

    public function upload(Request $request){
        $files = $request->file('file');
        $id = $request->get('id');
        $mime = array('jpeg','bmp','png','jpg');

        if(!empty($files)){
            foreach($files as $file){
                if(in_array($file->getClientOriginalExtension(), $mime)){
                    $filename = str_random(10) . '.'. $file->getClientOriginalExtension();
                    $destinationPath = 'assets/uploads/bug_attachments';
                    $file->move($destinationPath,$filename);
                    $ava = $destinationPath .'/'. $filename;
                    BugAttachment::uploadToDb($ava,$id);
                }else{
                    return \Response::json(array('success' => false));
                }
            }
            return \Response::json(array('success' => true));
        }
    }
}
