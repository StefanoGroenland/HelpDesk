<?php
/**
 * Created by PhpStorm.
 * User: Stefano
 * Date: 20-11-2015
 * Time: 10:05
 */

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;
use App\Input as Input;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;


class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gebruikers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username',
        'email',
        'password',
        'bedrijf',
        'voornaam',
        'tussenvoegsel',
        'geslacht',
        'telefoonnummer',
        'achternaam',
        'profielfoto',
        'rol',
    ];
    protected $guarded = ['id'];


    public function bug()
    {
        return $this->hasMany('App\Bug', 'klant_id', 'id');
    }

    public function project()
    {
        return $this->hasMany('App\Project', 'gebruiker_id');
    }

    public function chat()
    {
        return $this->hasMany('App\Chat', 'afzender_id', 'id');
    }

    public static function getMedewerkers()
    {
        return DB::table('gebruikers')
            ->select(DB::raw('id,email,username,voornaam,achternaam,tussenvoegsel,geslacht,telefoonnummer'))
            ->where('rol', '=', 'medewerker')
            ->get();
    }

    public static function getMedewerker($id)
    {
        return DB::table('gebruikers')
            ->select(DB::raw('id,email,username,voornaam,achternaam,tussenvoegsel,geslacht,telefoonnummer'))
            ->where('email', '=', $id)
            ->where('rol', '=', 'medewerker')
            ->get();
    }

    public static function getKlant($id)
    {
        return DB::table('gebruikers')
            ->select(DB::raw('id,email,username,voornaam,bedrijf,achternaam,tussenvoegsel,geslacht,telefoonnummer'))
            ->where('email', '=', $id)
            ->where('rol', '!=', 'medewerker')
            ->get();
    }

    public static function verwijderGebruiker($id)
    {
        if (User::find($id)->rol == 'medewerker') {
            DB::table('gebruikers')->where('id', '=', $id)->delete();
            return redirect('/medewerkers');
        } else {
            DB::table('gebruikers')->where('id', '=', $id)->delete();
            $projecten = DB::table('projecten')->where('gebruiker_id', '=', $id)->get();
            foreach ($projecten as $pro) {
                Project::verwijderProject($pro->id);
            }
            return redirect('/klanten');
        }
    }

    public static function uploadPicture($id, $img)
    {
        DB::table('gebruikers')
            ->where('id', $id)
            ->update(['profielfoto' => $img]);
    }
}
