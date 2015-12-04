<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Bug as Bug;
use App\User as User;
use App\Http\Controllers\Hash as Hash;
use Illuminate\Support\Facades\Validator;
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
use Route, View;
use Illuminate\Http\Request;
class BugController extends Controller
{
    public function showBugChat($id){
        $bug = Bug::with('user')->find($id);
        $medewerkers = User::where('bedrijf' ,'=', 'moodles')->get();
//        $koppel = $bug->user();

        return View::make('/bugchat', compact('bug', 'medewerkers', 'koppel'));
    }
    public function showBugmuteren(){
        return View::make('/bugmuteren');
    }
    public function showBugOverzicht(){
        $bugs = Bug::all();
        return View::make('/bugoverzicht', compact('bugs'));
    }
    public function verwijderBug(){
        $sid = Route::current()->getParameter('id');
        session()->flash('alert-danger', 'Bug met id : '. $sid . ' verwijderd.');
        return Bug::verwijderBug($sid);
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
        return redirect('/bugoverzicht');
    }
}
