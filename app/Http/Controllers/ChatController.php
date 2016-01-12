<?php

namespace App\Http\Controllers;

use App\Bug as Bug;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Chat as Chat;
use Illuminate\Support\Facades\Auth;
use App\BugAttachment as BugAttachment;

class ChatController extends Controller
{
    public function sendMessage(Request $request){


        $afzender_id        =       $request['afzender_id'];
        $klant_id           =       $request['klant_id'];
        $medewerker_id      =       $request['medewerker_id'];
        $bug_id             =       $request['bug_id'];
        $project_id         =       $request['project_id'];
        $msg                =       $request['bericht'];
        $msg_with           =       $request['bericht']. '<hr> -Bijlage(s) meeverzonden.';

        if(!empty($msg)){
            $files = $request->file('file');

            $id = $request->get('bug_id');
            $mime = array('jpeg','bmp','png','jpg','pdf','doc','docx','csv');

            foreach($files as $file){
                if($file !== null){
                    if(in_array($file->getClientOriginalExtension(), $mime)){
                        $filename = str_random(10) . '.'. $file->getClientOriginalExtension();
                        $destinationPath = 'assets/uploads/bug_attachments';
                        $file->move($destinationPath,$filename);
                        $ava = $destinationPath .'/'. $filename;
                        BugAttachment::uploadToDb($ava,$id);
                    }else{
                        $request->session()->flash('alert-danger', 'Bestand(en) uploaden mislukt! een of meerdere bestands types werden niet geaccepteerd.');
                        Chat::sendMessage($afzender_id,$klant_id,$medewerker_id,$bug_id,$project_id,$msg);
                        return redirect('/bugchat/'.$id);
                    }
                }else{
                    $request->session()->flash('alert-info', 'Bericht zonder bijlages verstuurd.');
                    Chat::sendMessage($afzender_id,$klant_id,$medewerker_id,$bug_id,$project_id,$msg);
                    return redirect('/bugchat/'.$id);
                }
            }
            $request->session()->flash('alert-info', 'Bericht met bijlages verstuurd.');
            Chat::sendMessage($afzender_id,$klant_id,$medewerker_id,$bug_id,$project_id,$msg_with);
            if(Auth::user()->bedrijf){
                Bug::lastPerson($bug_id,1,0);
            }else{
                Bug::lastPerson($bug_id,0,1);
            }
            return redirect('/bugchat/'.$id);
        }else{
            $request->session()->flash('alert-warning', 'Bericht verzenden mislukt, geen bericht content gevonden.');
            return redirect('/bugchat/'.$bug_id);
        }
        $request->session()->flash('alert-alert', 'Er ging iets mis. Neem contact op met de systeembeheerder !');
        return redirect('/bugchat/'.$bug_id);
    }

}
