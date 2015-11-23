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


    public function getMedewerkers()
    {
        return DB::table('gebruikers')
            ->select(DB::raw('id,voornaam,achternaam,email,bedrijf'))
            ->where('bedrijf', 'moodles')
            ->get();
    }
    public function verwijderMedewerker($id){
        DB::table($this->table)->where('id', '=',$id)->delete();
        return redirect('/medewerkermuteren');
    }
}
