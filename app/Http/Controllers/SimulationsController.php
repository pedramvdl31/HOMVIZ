<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Validator;
use Redirect;
use Hash;
use Route;
use Response;
use Auth;
use URL;
use Session;
use DB;
use App\Job;
use App\Simulation;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SimulationsController extends Controller
{
	public function __construct() {
        $this->layout = "layouts.master";
        //CHECK IF THE HOMEPAGE IS SET
    }

    public function getAdd()
    {

        return view('simulations.add')
        ->with('layout',$this->layout);

    }

    public function postAdd()
    {

        $sim = new Simulation();
        $sim->user_id = Auth::user()->id;  
        $sim->location = Input::get("location");  
        $sim->resources = json_encode(Input::get("resource"));
        $sim->subresources = json_encode(Input::get("subresource"));
        $sim->states = json_encode(Input::get("states"));  
        $sim->table = json_encode(Input::get("table"));  
        $sim->name = Input::get("simulation_name");  
        $sim->numberofweeks = Input::get("numberofweeks");  
        $sim->numberofsims = Input::get("numberofsims");  
        $sim->save();

        return Redirect::route('index');

    }

    public function getDelete($sim_id=null)
    {

        $sim = Simulation::find($sim_id);
        $sim->delete();

        return Redirect::route('index');

    }

    public function getView($sim_id=null)
    {

        $sim = Simulation::find($sim_id);

        return view('simulations.view')
        ->with('layout',$this->layout)
        ->with('sim',$sim);

    }

    


}
