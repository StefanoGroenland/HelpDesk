<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Bug as Bug;
use App\User as User;
use App\Http\Controllers\Hash as Hash;
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
use Route, View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class BugController extends Controller
{
    public function showBugChat($id){
        $bug = Bug::with('user')->find($id);
        $medewerkers = User::where('bedrijf' ,'=', 'moodles')->get();

        return View::make('/bugchat', compact('bug', 'medewerkers'));
    }
    public function showBugmuteren(){
        return View::make('/bugmuteren');
    }
    public function showBugOverzicht($id){
        $bugs = $this->getRelatedBugs($id);
        return View::make('/bugoverzicht', compact('bugs'));
    }
    public function verwijderBug(){
        $sid = Route::current()->getParameter('id');
        session()->flash('alert-danger', 'Bug met id : '. $sid . ' verwijderd.');
        return Bug::verwijderBug($sid);
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
            'prioriteit'  => $request['prioriteit'],
            'soort'  => $request['soort'],
            'status'  => $request['status'],
            'medewerker_id'  => $request['medewerker'],
        );
        Bug::where('id', '=', $bug->id)->update($data);
        $request->session()->flash('alert-success', 'Bug # '. $bug->id . ' veranderd.');
        return redirect()->action('BugController@showBugOverzicht', [Auth::user()->id]);
    }
}
