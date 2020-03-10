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

        Job::dump(Input::all());

        $resources = Input::get('resources');

        $subresources = Input::get('subresources');

        $states = Input::get('states');

        $substates = Input::get('substates');


        if (isset($resources)) {

            foreach ($resources as $rk => $resource) {

                $resources[$rk]['subresources'] = [];

                if (isset($subresources)) {

                    #Look for the same ID in subreserouces array, if so that means this resrouces has a subresource
                    if (isset($subresources[$rk])) {

                        $resources[$rk]['subresources'] = $subresources[$rk];

                    }

                }

            }

        }


        Job::dump($resources);


        if (isset($states)) {

            foreach ($states as $sk => $state) {

                $states[$sk]['substates'] = [];

                if (isset($substates)) {

                    #Look for the same ID in subreserouces array, if so that means this resrouces has a subresource
                    if (isset($substates[$sk])) {

                        array_push($states[$sk]['substates'], $substates[$sk]);
                        $states[$sk]['substates'] = $substates[$sk];

                    }

                }

            }

        }

        Job::dump($states);


        $allowedPopulation = Input::get('allowedPopulation');
        $initialPopulation = Input::get('initialPopulation');
        $maximumlengthofstay = Input::get('maximumlengthofstay');
        $capacity = Input::get('capacity');

        $resources = Simulation::mergeResourcesPropreties($resources, $allowedPopulation, 'allowedpopulation');
        $resources = Simulation::mergeResourcesPropreties($resources, $initialPopulation, 'initialPopulation');
        $resources = Simulation::mergeResourcesPropreties($resources, $maximumlengthofstay, 'maximumlengthofstay');
        $resources = Simulation::mergeResourcesPropreties($resources, $capacity, 'capacity');


        $states = Simulation::mergeStatesPropreties($states, $allowedPopulation, 'allowedpopulation');
        $states = Simulation::mergeStatesPropreties($states, $initialPopulation, 'initialPopulation');


        Job::dump('-------');


        Job::dump($allowedPopulation);

        Job::dump('-------');

        Job::dump($resources);
        Job::dump($states);

        // $sim = new Simulation();
        // $sim->user_id = Auth::user()->id;  
        // $sim->location = Input::get("simulation_location");  
        // $sim->resources = json_encode(Input::get("resource"));
        // $sim->subresources = json_encode(Input::get("subresource"));
        // $sim->states = json_encode(Input::get("states"));  
        // $sim->table = json_encode(Input::get("table"));  
        // $sim->name = Input::get("simulation_name");  
        // $sim->numberofweeks = Input::get("numberofweeks");  
        // $sim->numberofsims = Input::get("numberofsims");
        // $sim->creatorname = Input::get("creatorname");  
        // $sim->save();

        // return Redirect::route('index');

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
