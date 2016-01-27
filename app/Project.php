<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Bug as Bug;
use DB;

class Project extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projecten';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'projectnaam',
        'liveurl',
        'developmenturl',
        'gebruikersnaam',
        'wachtwoord',
        'telefoonnummer',
        'omschrijvingproject',
        'gebruiker_id',
    ];
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'gebruiker_id', 'id');
    }

    public function bug()
    {
        return $this->hasMany('App\Bug', 'project_id');
    }

    public static function getUsers()
    {
        $users = User::where('rol', '!=', 'medewerker')->get();
        return $users;
    }

    public static function verwijderProject($id)
    {
        DB::table('projecten')->where('id', '=', $id)->delete();
        Bug::verwijderBug($id);
        return redirect('/projecten');
    }

    public static function getProjectOnSearch($inp)
    {
        return DB::table('projecten')
            ->select(DB::raw('id,titel,projectnaam,liveurl,developmenturl
            ,gebruikersnaam,wachtwoord
            ,gebruiker_id,omschrijvingproject'))
            ->where('projectnaam', '=', $inp)
            ->get();
    }


}
