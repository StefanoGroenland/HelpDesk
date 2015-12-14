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
        'profielfoto'
    ];
    protected $guarded = ['id'];


    public function bug(){
        return $this->hasMany('App\Bug','klant_id','id');
    }
    public function project(){
        return $this->hasMany('App\Project','gebruiker_id');
    }

    public static function getMedewerkers()
    {
        return DB::table('gebruikers')
            ->select(DB::raw('id,voornaam,achternaam,email,bedrijf'))
            ->where('bedrijf', 'moodles')
            ->get();

    }
    public static function getMedewerker($email){
        return DB::table('gebruikers')
            ->select(DB::raw('email,username,voornaam,achternaam,tussenvoegsel,geslacht,telefoonnummer'))
            ->where('email', 'LIKE', '%'.$email.'%')
            ->where('bedrijf', '=' , 'moodles')
            ->get();
    }
    public static function verwijderGebruiker($id){
        DB::table('gebruikers')->where('id', '=',$id)->delete();
        return redirect('/medewerkermuteren');
    }
    public static function getLastRow(){
        $data =  DB::table('gebruikers')->select('id')
            ->orderBy('id', 'desc')
            ->first();
        return $data->id;
    }
    public static function insertNewKlant(Request $request){
        return DB::table('gebruikers')->insert(
            [
                'username' => $request['username'],
                'password' => bcrypt($request['password']),
                'email' => $request['email'],
                'bedrijf' => $request['bedrijf'],
                'voornaam' => $request['voornaam'],
                'tussenvoegsel' => $request['tussenvoegsel'],
                'achternaam' => $request['achternaam'],
                'geslacht' => $request['geslacht'],
                'telefoonnummer' => $request['telefoonnummer'],
            ]
        );
    }
}
