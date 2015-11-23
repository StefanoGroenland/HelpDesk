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
use Illuminate\Support\Facades\Session;
use DB;
use Symfony\Component\HttpFoundation\Request;


class Admin extends Model implements AuthenticatableContract,
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



    public function showAdminDashboard(){
        if(\Auth::guest()){
            return redirect('/');
        }
        else if(\Auth::user()->bedrijf == 'moodles'){
            return view('admindashboard');
        }else{
            return redirect('/dashboard');
        }
    }
    public function showMedewerkerMuteren(){
        if(\Auth::guest()){
            return redirect('/');
        }
        else if(\Auth::user()->bedrijf == 'moodles'){
            return view('medewerkermuteren');
        }else{
            return redirect('/dashboard');
        }
    }

    public function getMedewerkers(){
      $admins = DB::table('gebruikers')
          ->select(DB::raw('id,voornaam,achternaam,email,bedrijf'))
          ->where('bedrijf', 'moodles')
          ->get();
              foreach ($admins as $adm) {
                  echo "<tr>";
                  echo "<td>". ucfirst($adm->voornaam) ." ". ucfirst($adm->achternaam) . "</td>";
                  echo "<td>". $adm->email . "</td>";
                  echo "<td><a href='#'> <button type='submit' class='btn btn-success btn-xs'> <i class='fa fa-check'> </i> </button> </a>";
                  echo "<input type='hidden'>
                        <a href='../deleteRow/".$adm->id ."' name='remove' value='$adm->id' class='btn btn-danger btn-xs'> <i class='fa fa-remove'></i></a>
                        </td>";
                  echo "</tr>";
            }
}
    public function deleteRow($id){
        DB::table('gebruikers')->where('id', '=',$id)->delete();
        return redirect('/medewerkermuteren');
        }
    }
