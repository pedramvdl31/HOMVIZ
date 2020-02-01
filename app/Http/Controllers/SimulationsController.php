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

    public function getIndex($project_id=null)
    {   

        $sim = Simulation::where("project_id",$project_id)->get();

        return view('simulations.index')
        ->with('layout',$this->layout)
        ->with('project_id',$project_id)
        ->with('sim',$sim);

    }

    public function getAdd($project_id=null)
    {

        return view('simulations.add')
        ->with('layout',$this->layout)
        ->with('project_id',$project_id);

    }

    public function postAdd()
    {


        $sim = new Simulation();
        $sim->project_id = Input::get("project_id");  
        $sim->location = Input::get("location");  
        $sim->resources = json_encode(Input::get("resource"));
        $sim->subresources = json_encode(Input::get("subresource"));
        $sim->states = json_encode(Input::get("states"));  
        $sim->table = json_encode(Input::get("table"));  
        $sim->name = Input::get("simulation_name");  
        $sim->numberofweeks = Input::get("numberofweeks");  
        $sim->numberofsims = Input::get("numberofsims");  

        $sim->save();

        return Redirect::route('simulation_index',Input::get("project_id"));

    }



    public function getEdit($sim_id=null)
    {

        $sim = Simulation::find($sim_id);


        $newtablestr = "";
        $oldtable = json_decode($sim->table);

        $c = 0;
        foreach ($oldtable as $key => $value) {

            foreach ($value as $j => $val) {

                if ($c==0) {

                    $newtablestr .= $val;

                } else {

                    $newtablestr .= ','.$val;

                }

                $c++;

            }

        }

        return view('simulations.edit')
        ->with('layout',$this->layout)
        ->with('sim_id',$sim->id)
        ->with('location',$sim->location)
        ->with('states',json_decode($sim->states))
        ->with('resources',json_decode($sim->resources))
        ->with('subresources',json_decode($sim->subresources))
        ->with('tablestring',$newtablestr)
        ->with('simname',$sim->name)
        ->with('simweeks',$sim->numberofweeks)
        ->with('simnum',$sim->numberofsims)
        ->with('project_id',$sim->project_id);

    }

    public function postEdit()
    {

        $id = Input::get("sim_id");

        $sim = Simulation::find($id);
        $sim->project_id = Input::get("project_id");  
        $sim->location = Input::get("location");  
        $sim->resources = json_encode(Input::get("resource"));
        $sim->subresources = json_encode(Input::get("subresource"));
        $sim->states = json_encode(Input::get("states"));  
        $sim->table = json_encode(Input::get("table"));  
        $sim->name = Input::get("simulation_name");  
        $sim->numberofweeks = Input::get("numberofweeks");  
        $sim->numberofsims = Input::get("numberofsims");  

        $sim->save();

        return Redirect::route('simulation_index',Input::get("project_id"));

    }


    public function getDelete($sim_id=null,$project_id)
    {

        $sim = Simulation::find($sim_id);
        $sim->delete();

        return Redirect::route('simulation_index',$project_id);

    }

    public function getView($sim_id=null)
    {

        $sim = Simulation::find($sim_id);

        return view('simulations.view')
        ->with('layout',$this->layout)
        ->with('sim',$sim);

    }

    


}
