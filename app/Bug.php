<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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
        return DB::table('bugs')->where('id', '=',$id)->delete();
    }

}
