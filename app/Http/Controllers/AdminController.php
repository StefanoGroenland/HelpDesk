<?php
/**
 * Created by PhpStorm.
 * User: Stefano
 * Date: 20-11-2015
 * Time: 10:04
 */

namespace App\Http\Controllers;
use App\Admin;



class AdminController extends Controller
{
    /**
     * Show the dashboard to the user
     *
     * @return Response
     */

    public function showDashboard()
    {
        $admin = new Admin();
        return $admin->showAdminDashboard();
    }
    public function showMwMuteren(){
        $admin = new Admin();
        return $admin->showMedewerkerMuteren();
    }
    public function showMedewerkers(){
        $admin = new Admin();
        return $admin->getMedewerkers();
    }

}