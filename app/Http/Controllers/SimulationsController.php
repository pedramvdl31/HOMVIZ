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

        $transitionProbability = Input::get('TransitionProbability');
        $creatorname = Input::get('creatorname');
        $numberofweeks = Input::get('numberofweeks');
        $numberofsims = Input::get('numberofsims');
        $populationType = Input::get('populationType');
        $simulation_name = Input::get('simulation_name');
        $simulation_location = Input::get('simulation_location');

        $output = array();

        $output['simulation_name'] = $simulation_name;
        $output['simulation_location'] = $simulation_location;
        $output['creatorname'] = $creatorname;
        $output['numberofweeks'] = $numberofweeks;
        $output['numberofsims'] = $numberofsims;
        $output['populationType'] = $populationType;
        $output['resources'] = $resources;
        $output['states'] = $states;
        $output['transitionProbability'] = $transitionProbability;

        $sim = new Simulation();
        $sim->user_id = Auth::user()->id;
        $sim->simulation_name = $output['simulation_name'];
        $sim->simulation_location = $output['simulation_location'];
        $sim->creatorname = $output['creatorname'];
        $sim->numberofweeks = $output['numberofweeks'];
        $sim->numberofsims = $output['numberofsims'];
        $sim->populationType = json_encode($output['populationType']);
        $sim->resources = json_encode($output['resources']);
        $sim->states = json_encode($output['states']);
        $sim->transitionProbability = json_encode($output['transitionProbability']);  

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
