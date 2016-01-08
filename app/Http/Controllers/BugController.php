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

        $bug = Bug::with('klant','user','project')->find($id);

        if(Auth::user()->bedrijf == 'moodles'){
            Bug::lastPerson($id,1,0);
        }else{
            Bug::lastPerson($id,0,1);
        }
        if(Auth::user()->bedrijf == 'moodles' || $bug->klant->id == $bug->project->gebruiker_id){
            $afzenders              = Chat::with('medewerker','klant')->where('bug_id','=',$id)->get();
            $bug_attachments        = BugAttachment::where('bug_id','=',$id)->get();


            return View::make('/bugchat', compact('bug', 'medewerkers','afzenders','bug_attachments','project'));
        }
        return redirect('/dashboard');
    }
    public function refreshChat($id){
        if(Auth::user()->bedrijf == 'moodles'){
            Bug::lastPerson($id,1,0);
        }else{
            Bug::lastPerson($id,0,1);
        }
        return $afzenders = Chat::with('medewerker','klant')->where('bug_id','=',$id)->get();
    }
    public function feedCount($id){
        return $query = Chat::where('bug_id','=',$id)->get();
    }
    public function showBugMuteren($id){

            $user_id = Auth::user()->id;
            if(Auth::user()->bedrijf == 'moodles'){
                $projecten = Project::all();
            }else{
                $projecten = Project::where('gebruiker_id', '=', $user_id)->get();
            }
            return View::make('/bugmuteren' , compact('projecten','id'));
    }

    public function showBugOverzicht($id){
        if(Auth::user()->bedrijf == 'moodles' || Auth::user()->id == $id){
            $bugs_related           = $this->getRelatedBugs($id);
            $bugs_all               = Bug::with('klant')->orderBy('id','desc')->get();
            $projects               = Project::where('gebruiker_id','=', $id)->get();
            $projects_all           = Project::all();
            return View::make('/bugoverzicht', compact('bugs_related', 'bugs_all', 'projects', 'projects_all', 'klanten'));
        }else{
            return redirect('/dashboard');
        }
    }
    public function showBugOverzichtPerProject($id)
    {
        $project = Project::find($id);

        if (Auth::user()->bedrijf == 'moodles' || Auth::user()->id == $project->gebruiker_id){
            $bugs = Bug::where('project_id', '=', $id)->get();
            return View::make('/bugoverzichtperproject', compact('bugs', 'project'));
        }else{
            return redirect('/dashboard');
        }
    }

    public function verwijderBug(){
        $sid = Route::current()->getParameter('id');
        $pid = Bug::defineProject($sid);
        session()->flash('alert-danger', 'Bug met id : '. $sid . ' verwijderd.');
        Bug::verwijderBug($sid);
        return redirect('/bugs/'.$pid->project_id);
    }

    public function getRelatedBugs($id){
        return $bugs = Bug::where('klant_id','=', $id)->get();
    }
    public function updateBug($id,Request $request){
        $bug = Bug::find($id);
        $data = array(
            'prioriteit'        => $request['prioriteit'],
            'soort'             => $request['soort'],
            'status'            => $request['status'],
            'eind_datum'        => $request['eind_datum'],
        );
        $data['eind_datum'] = date('Y-m-d H:i',strtotime($data['eind_datum']));

        if($data['eind_datum'] == "1970-01-01 01:00"){
            array_forget($data,'eind_datum');
        }
        Bug::lastPerson($bug,1,0);

        Bug::where('id', '=', $bug->id)->update($data);
        $request->session()->flash('alert-success', 'Bug # '. $bug->id . ' veranderd.');
        return redirect('/bugchat/'. $bug->id);
    }


    public function addBug(Request $request){

        $posted_by = Bug::defineKlant($request['project']);
        $pro_id = $request['project'];

            $data = array(
                'titel'             => $request['titel'],
                'prioriteit'        => $request['prioriteit'],
                'soort'             => $request['soort'],
                'status'            => 'open',
                'start_datum'       => $request['start_datum'],
                'beschrijving'      => $request['beschrijving'],
                'klant_id'          => $posted_by->gebruiker_id,
                'project_id'        => $request['project'],
            );

        if(Auth::useR()->bedrijf == 'moodles' ){
            $data['last_admin']     = 1;
            $data['last_client']    = 0;
        }else{
            $data['last_admin']     = 0;
            $data['last_client']    = 1;
        }



        $rules = array(
            'titel'             => 'required|min:4',
            'prioriteit'        => 'required',
            'soort'             => 'required',
            'status'            => 'required',
            'start_datum'       => 'required',
            'beschrijving'      => 'required',
            'klant_id'          => 'required',
            'project_id'        => 'required',
        );

        $data['start_datum'] = date('Y-m-d H:i',strtotime($data['start_datum']));


        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            return redirect('/bugmuteren/'.$pro_id)->withErrors($validator);
        }
        Bug::create($data);
        $request->session()->flash('alert-success', 'Bug'. $request['titel']. ' toegevoegd.');
        return redirect('/bugs/'.$pro_id);
    }

    public function upload(Request $request){
        $files = $request->file('file');
        $id = $request->get('id');
        $mime = array('jpeg','bmp','png','jpg','pdf','doc','docx','csv');

        if(!empty($files)){
            foreach($files as $file){
                if(in_array($file->getClientOriginalExtension(), $mime)){
                    $filename = str_random(10) . '.'. $file->getClientOriginalExtension();
                    $destinationPath = 'assets/uploads/bug_attachments';
                    $file->move($destinationPath,$filename);
                    $ava = $destinationPath .'/'. $filename;
                    BugAttachment::uploadToDb($ava,$id);
                }else{
                    $request->session()->flash('alert-danger', 'Bestanden uploaden mislukt!');
                    return redirect('/bugchat/'.$id);
                }
            }
            $request->session()->flash('alert-info', 'Bestanden uploaden voltooid.');
            return redirect('/bugchat/'.$id);
        }
    }
}
