<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Chat as Chat;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function sendMessage(Request $request){

        $afzender_id        =       $request['afzender_id'];
        $klant_id           =       $request['klant_id'];
        $medewerker_id      =       $request['medewerker_id'];
        $bug_id             =       $request['bug_id'];
        $project_id         =       $request['project_id'];
        $msg                =       $request['bericht'];

        Chat::sendMessage($afzender_id,$klant_id,$medewerker_id,$bug_id,$project_id,$msg);

        return redirect('/bugchat/'. $bug_id);
    }

}
