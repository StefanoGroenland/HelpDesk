<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Chat extends Model
{

    public function medewerker(){
        return $this->belongsTo('App\User','medewerker_id','id');
    }
    public function klant(){
        return $this->belongsTo('App\User','klant_id','id');
    }

    public static function sendMessage($afzender_id,$klant_id,$medewerker_id,$bug_id,$project_id,$msg){
        return DB::table('chats')->insert(
            [
                'created_at' => date('y-m-d - H:i:s'),
                'project_id' => $project_id,
                'bug_id' => $bug_id,
                'afzender_id' => $afzender_id,
                'klant_id' => $klant_id,
                'medewerker_id' => $medewerker_id,
                'bericht' => $msg
            ]
        );
    }
    public static function deleteChatFeedPerBug($id){
        return DB::table('chats')->where('bug_id', '=',$id)->delete();
    }


}
