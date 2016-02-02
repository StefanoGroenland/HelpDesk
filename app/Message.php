<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Message extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['from',
        'subject',
        'date',
        'body'
    ];
    protected $guarded = ['id'];


    public static function insertMail($from,$subject,$date,$body){
        return DB::table('messages')
        ->insert([
            'from'      => $from,
            'subject'   => $subject,
            'date'      => $date,
            'body'      => $body
        ]);
    }
    public static function deleteMail($id){
        return DB::table('messages')->where('id',$id)->delete();
    }

}
