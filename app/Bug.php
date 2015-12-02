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
        'voornaam_contactpersoon',
        'achternaam_contactpersoon',
        'email_contactpersoon',
        'bedrijf_contactpersoon',
        'telefoon_contactpersoon',
        'gebruikersnaam',
        'wachtwoord',
        'naam_medewerker',
        'behandeld_door',
        'beschrijving',
        'soort',
        'start_datum',
        'eind_datum',
    ];
    protected $guarded = ['id'];

    public function getAllBugs(){
       DB::table('bugs')->all();
    }
    public static function verwijderBug($id){
        DB::table('bugs')->where('id', '=',$id)->delete();
        return redirect('/bugoverzicht');
    }
}
