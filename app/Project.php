<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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
    protected $fillable = ['titel',
        'status',
        'prioriteit',
        'type',
        'projectnaam',
        'projecturl',
        'gebruikersnaam',
        'wachtwoord',
        'bedrijf',
        'telefoonnummer',
        'omschrijvingproject'
    ];
    protected $guarded = ['id'];

    public static function verwijderProject($id){
        DB::table('projecten')->where('id', '=',$id)->delete();
        return redirect('/projectmuteren');
    }
}
