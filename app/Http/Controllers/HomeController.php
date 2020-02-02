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

        return view('index')
        ->with('sim',$sim)
        ->with('layout',$layout_title);

    }

}
