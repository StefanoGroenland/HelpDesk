<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Bug as Bug;
use App\User as User;
use App\Http\Controllers\Hash as Hash;
use Illuminate\Support\Facades\Validator;
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
use Route, View;
class BugController extends Controller
{
    public function showBugChat($id){
        $bug = Bug::find($id);
        $medewerkers = User::where('bedrijf' ,'=' , 'moodles')->get();
        return View::make('/bugchat', compact('bug', 'medewerkers'));
    }
    public function showBugmuteren(){
        return View::make('/bugmuteren');
    }
    public function showBugOverzicht(){
        $bugs = Bug::all();
        return View::make('/bugoverzicht', compact('bugs'));
    }
    public function verwijderBug(){
//      flash of alert bij voegen?
        $sid = Route::current()->getParameter('id');
        session()->flash('alert-danger', 'Bug met id : '. $sid . ' verwijderd.');
        return Bug::verwijderBug($sid);
    }
    public function veranderBugInfo(Request $request){
//        functionaliteit
    }
}
