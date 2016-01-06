<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Chat as Chat;
use DB;
class Bug extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bugs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id',
        'titel',
        'prioriteit',
        'status',
        'soort',
        'beschrijving',
        'start_datum',
        'eind_datum',
        'klant_id',
        'project_id',
        'medewerker_id',
    ];
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo('App\User','medewerker_id','id');
    }
    public function klant(){
        return $this->belongsTo('App\User','klant_id','id');
    }
    public function chat(){
        return $this->belongsTo('App\Chats','bug_id','id');
    }
    public function project(){
        return $this->belongsTo('App\Project', 'project_id', 'id');
    }
    public function getAllBugs(){
       DB::table('bugs')->all();
    }
    public static function verwijderBug($id){
        $bug_id = DB::table('bugs')->select(DB::raw('id'))->where('project_id','=',$id)->first();
        if($bug_id != null){
            $bug_id = $bug_id->id;
            Chat::deleteChatFeedPerBug($bug_id);
            DB::table('bugs_attachments')->where('bug_id', '=',$bug_id)->delete();
            return DB::table('bugs')->where('project_id', '=',$id)->delete();
        }else {
            return DB::table('bugs')->where('id', '=',$id)->delete();
        }
    }
    public static function uploadToDb($file,$id){
        return DB::table('bugs_attachments')->insert([
            'bug_id' => $id,
            'image' => $file,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
    public static function defineKlant($id){
        return DB::table('projecten')->select(DB::raw('gebruiker_id'))->where('id','=',$id)->first();
    }
    public static function defineProject($id){
        return DB::table('bugs')->select(DB::raw('project_id'))->where('id','=',$id)->first();
    }
}
