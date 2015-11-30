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
        'achternaam',
        'klantnummer',
        'profielfoto'
    ];
    protected $guarded = ['id'];


    public static function getMedewerkers()
    {
        return DB::table('gebruikers')
            ->select(DB::raw('id,voornaam,achternaam,email,bedrijf'))
            ->where('bedrijf', 'moodles')
            ->get();

    }
    public static function updateMedewerker($email)
    {
        return DB::table('gebruikers')
            ->where('email', $email)
            ->update(['email' => \Input::get('email')],
                ['username' => \Input::get('gebruikersnaam')],
                ['password' => \Input::get('wachtwoord')],
                ['voornaam' => \Input::get('voornaam')],
                ['achternaam' => \Input::get('achternaam')]);
    }
    public static function verwijderGebruiker($id){
        DB::table('gebruikers')->where('id', '=',$id)->delete();
        return redirect('/medewerkermuteren');
    }
}
