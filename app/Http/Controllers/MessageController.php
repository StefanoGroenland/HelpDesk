<?php
/**
 * Created by PhpStorm.
 * User: Stefano
 * Date: 2-2-2016
 * Time: 13:09
 */


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Message as Message;
use App\Bug as Bug;
use App\Project as Project;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\Validator;

use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
use Route, View;

class MessageController extends Controller {

    public function index()
    {
        $this->fetchMails();
        $messages = Message::all();

        return View::make('mailoverzicht', compact('messages'));
    }
    public function fetchMails()
    {
        $order   = array("\r\n", "\n", "\r");
        $server = "{mail.moodles.nl:143/novalidate-cert}INBOX";
        $username = "helpdesk@moodles.nl";
        $password = "4SQ1wddTQU";
        $mbox = imap_open($server,$username,$password);


        $num = imap_num_msg($mbox);
        if($num > 0){
            $header = imap_headerinfo($mbox,$num);
            $from = $header->from;
            foreach($from as $id=>$object){
                $fromaddress = $object->mailbox . "@" . $object->host;
            }
            $subject = $header->subject;
            $date = $header->date;
            $formatted = date('Y-m-d H:i:s', strtotime($date));


            $body = quoted_printable_decode(imap_fetchbody($mbox,$num,1.1));


            if($body == '')
            {
                $body = (imap_fetchbody($mbox,$num,1));
            }

            if($fromaddress !== "helpdesk@moodles.nl" && $fromaddress !== "Mailer-Daemon@mx02.ips.nl"){
                Message::insertMail($fromaddress,$subject,$formatted,$body);
                imap_delete($mbox, $num);
                imap_expunge($mbox);
            }



            header('refresh: 3');
        } else {
            //no emails, refresh again in 20 seconds to check for new
            header('refresh: 20');
        }
        imap_close($mbox);
    }
    public function mailVerwerken($id)
    {
        $message = Message::where('id','=',$id)->get();
        $projects = Project::all();

        return View::make('/mailverwerken', compact('message', 'projects', 'id'));
    }
    public function postFeedback($id, Request $request)
    {
        $customer = Bug::defineKlant($request['project_id']);

        $data = array(
            'titel' => $request['titel'],
            'prioriteit' => $request['prioriteit'],
            'soort' => $request['soort'],
            'status' => 'open',
            'start_datum' => $request['start_datum'],
            'beschrijving' => $request['beschrijving'],
            'klant_id' => $customer->gebruiker_id,
            'gemeld_door' => Auth::user()->id,
            'project_id' => $request['project_id'],
        );

        if (Auth::user()->rol == 'medewerker') {
            $data['last_admin'] = 1;
            $data['last_client'] = 0;
        }
        $rules = array(
            'titel' => 'required|min:4|max:50|string',
            'prioriteit' => 'required',
            'soort' => 'required',
            'status' => 'required',
            'start_datum' => 'required',
            'beschrijving' => 'required',
            'klant_id' => 'required',
            'project_id' => 'required',
        );
        if ($data['start_datum'] == '1970-01-01 00:00:00' || $data['start_datum'] == '1899-31-12 00:00:00' || $data['start_datum'] == '') {
            $request->session()->flash('alert-danger', 'Start datum moet correct worden ingevuld.');
            return redirect('/mailverwerken/' . $id)->withInput($data);
        }
        $data['start_datum'] = date('Y-m-d H:i', strtotime($data['start_datum']));


        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect('/mailverwerken/' . $id)->withErrors($validator)->withInput($data);
        }
        Bug::create($data);
        Message::deleteMail($id);
        $request->session()->flash('alert-success', 'Feedback ' . $request['titel'] . ' toegevoegd.');
        return redirect('/mails');
    }
    public function verwijderMail()
    {
        $sid = Route::current()->getParameter('id');
        $mail = Message::find($sid);
        session()->flash('alert-success', 'Mail : ' . $mail->subject . ' verwijderd.');
        Message::deleteMail($sid);
        return redirect('/mails');

    }

}