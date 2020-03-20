<?php

namespace App\Http\Controllers;


use Input;
use Validator;
use Redirect;
use Hash;
use Request;
use Route;
use Response;
use Auth;
use URL;
use Session;
use Laracasts\Flash\Flash;
use View;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Project;
use App\Simulation;

class HomeController extends Controller
{
    public function __construct() {

    }

        public function getHomePage()
    {

        $layout_title = 'layouts.master';

        $sim = Simulation::where("user_id",Auth::user()->id)->get();

        foreach ($sim as $sk => $sv) {

            $d = json_decode($sv->data);

            $sv->data = '';
            $sv->simulation_name = $d->simulation_name;
            $sv->simulation_location = $d->simulation_location;
            $sv->numberofweeks = $d->numberofweeks;
            $sv->numberofsims = $d->numberofsims;
            $sv->creatorname = $d->creatorname;
            
            $sv->statusMessage = '<span class="badge badge-success">Submitted</span>';
            if ($sv->status==1) {
               $sv->statusMessage = '<span class="badge badge-info">Completed</span>';
            } else if($sv->status==2) {
               $sv->statusMessage = '<span class="badge badge-info">Processing</span>';
            }

            $phpdate = strtotime( $sv->created_at );
            $sv->created_at = date( 'Y-m-d H:i:s', $phpdate );
        }

        return view('index')
        ->with('sim',$sim)
        ->with('layout',$layout_title);

    }

}
