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
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

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


    public function postprogressUpdate()
    {   
        
        $status = 200;
        $serverkey = env("SERVER_KEY");

        $output = [];

        $sim = Simulation::all();

        foreach ($sim as $key => $simulation) {

            $output[$simulation->id] = [];

            if ($simulation->status==0) {

                $url = 'http://andr.fish:3114/api/v1/simulation/create';
                
                $opts = [
                    "http" => [
                        "method" => "POST",
                        "header" => "key: ".$serverkey."\r\n" .
                            "Content-Type:'application/json'\r\n" .
                            "data: ".$simulation->data."\r\n"
                    ]
                ];

                $context = stream_context_create($opts);
                $file = file_get_contents($url, false, $context);
                $res = json_decode($file,1);

                if ($res['status']=='succeeded') {
                    if (isset($res['simulation_id'])) {
                        $s = Simulation::find($simulation->id);
                        $s->serverID=$res['simulation_id'];
                        $s->status = 2;
                        $s->save();

                        $output[$simulation->id]['status']=2;
                        $output[$simulation->id]['progress']=0;

                    }
                }

            } elseif ($simulation->status==2) {
                
                $url = 'http://andr.fish:3114/api/v1/simulation/status';

                // Create a stream
                $opts = [
                    "http" => [
                        "method" => "POST",
                        "header" => "key: ".$serverkey."\r\n" .
                            "simulation_id: ".$simulation->serverID."\r\n"
                    ]
                ];

                $context = stream_context_create($opts);

                // Open the file using the HTTP headers set above
                $file = file_get_contents($url, false, $context);

                $res = json_decode($file,1);

                if ($res['status']=='complete') {

                    $s = Simulation::find($simulation->id);
                    $s->status = 1;
                    $s->save();
                    $output[$simulation->id]['status']=1;

                    $url = 'http://andr.fish:3114/api/v1/simulation/result';
                    $opts = [
                        "http" => [
                            "method" => "POST",
                            "header" => "key: ".$serverkey."\r\n" .
                                "simulation_id: ".$simulation->serverID."\r\n"
                        ]
                    ];

                    $context = stream_context_create($opts);
                    $file = file_get_contents($url, false, $context);
                    $res = json_decode($file,1);
                    if (isset($res['result'])) {
                        $s = Simulation::find($simulation->id);
                        $s->result = $res['result'];
                        $s->save();
                        $output[$simulation->id]['progress']=100;
                        $output[$simulation->id]['statushtml']='<span class="badge badge-info">Completed</span>';
                    }

                } else {

                    if (isset($res['status'])) {
                    
                        $var = $res['status'];
                        $var = str_replace(' ', '', $var);
                        $var = explode(',', $var);

                        if (isset($var[0])) {
                            $simnum = str_replace('sim_', '', $var[0]);
                            $simname = 'Simulation '. ( ((int)$simnum)+1  );
                            $output[$simulation->id]['simulationname'] = $simname;
                        }

                        $first4='';
                        if (isset($var[1])) {
                           $first4 = substr($var[1], 0,4);
                        }

                        if ($first4=='week') {

                            $d = json_decode($simulation->data,1);
                            $numofweeks = $d['numberofweeks'];

                            $weekno = substr($var[1], 5);
                            $weekno = (int)$weekno+1;
                            $progress = $weekno / $numofweeks * 100;

                            $output[$simulation->id]['status']=2;
                            $output[$simulation->id]['progress']=$progress;
                            $output[$simulation->id]['statushtml']='<span class="badge badge-info">Processing</span>';

                        }

                    }

                }

            } elseif ($simulation->status==1) {
                $output[$simulation->id]['progress']=100;
                $output[$simulation->id]['status']=1;
                $output[$simulation->id]['statushtml']='<span class="badge badge-info">Completed</span>';
                
            }

        }

        return Response::json(array(
        'status' => $status,
        'output' => $output
        ));

    }

    public function getTest()
    {

        $serverkey = env("SERVER_KEY");
        $url = 'http://andr.fish:3114/api/v1/simulation/result';
        $opts = [
            "http" => [
                "method" => "POST",
                "header" => "key: ".$serverkey."\r\n" .
                    "simulation_id: 32\r\n"
            ]
        ];
        $context = stream_context_create($opts);
        $file = file_get_contents($url, false, $context);
        $res = json_decode($file,1);
        if (isset($res['result'])) {
            Job::dump($res);
        }
        

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

        // Job::dump(json_encode($output));

        $sim = new Simulation();
        $sim->user_id = Auth::user()->id;
        $sim->data = json_encode($output);
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

        if (isset($sim->result) && !empty($sim->result)) {

            $data = json_decode($sim->result, true);

            $numberofweeks = 0;

            $weekLabel = [];
            $dataSeriesLabel = [];
            $dataSeriesLabelPie = [];
            $populationLabel = [];
            $resourceLabel = [];
            $avg_msg = null;

            $c2 = 0;

            foreach ($data as $key => $sim) {

                foreach ($sim as $w1key => $week) {


                    if ($c2==0) {
                        array_push($weekLabel, 'Week '.$numberofweeks);
                        $numberofweeks = $numberofweeks + 1;
                    }
                    
                    $weektotal = 0;

                    foreach ($week as $wk => $wv) {

                        array_push($resourceLabel, $wk);

                        $total = 0;

                        foreach ($wv as $pk => $pv) {
                            $total = $total + $pv;
                        }

                        $data[$key][$w1key][$wk]['Combined'] = $total;
                        $weektotal = $weektotal + $total;
                    }

                }

                $c2 += 1;

            }

            $resourceLabel = array_unique($resourceLabel);

            $mycounter = 0;



            $number_of_simulations = count($data);

            if ( $number_of_simulations > 1 ) {
                $data = Simulation::AverageMultipleSimulations($data);

                $avg_msg = 'Average of '.$number_of_simulations.' Simulations';

                $number_of_simulations = 1;

            }

            foreach ($data as $key0 => $sim) {

                $dataSeriesLabel[$key0]=[];
                $dataSeriesLabelPie[$key0]=[];

                foreach ($sim as $key => $week) {

                    foreach ($week as $wk => $wv) {

                        if(!isset($dataSeriesLabel[$key0][$wk]))
                            $dataSeriesLabel[$key0][$wk]=[];

                        if(!isset($dataSeriesLabelPie[$key0][$wk]))
                            $dataSeriesLabelPie[$key0][$wk]=[];                    

                        foreach ($wv as $pk => $pv) {

                            if(!isset($dataSeriesLabel[$key0][$wk][$pk]))
                                $dataSeriesLabel[$key0][$wk][$pk]=[];

                            if(!isset($dataSeriesLabelPie[$key0][$wk][$pk]))
                                $dataSeriesLabelPie[$key0][$wk][$pk]=['init'=>null,'final'=>null];

                            if ($mycounter==0) {
                                $dataSeriesLabelPie[$key0][$wk][$pk]['init'] = $pv;
                            }

                            // Job::dump($numberofweeks);
                            if ($mycounter==$numberofweeks-1) {
                                $dataSeriesLabelPie[$key0][$wk][$pk]['final'] = $pv;
                            }


                            if(!in_array($pk, $populationLabel))
                                array_push($populationLabel, $pk);

                            array_push($dataSeriesLabel[$key0][$wk][$pk], $pv);
                        }

                        
                    }

                    $mycounter += 1;

                }
                $mycounter = 0;
            }

            // Job::dump($number_of_simulations);

            return view('simulations.view')
            ->with('dataSeriesLabel',json_encode($dataSeriesLabel))
            ->with('dataSeriesLabelPie',json_encode($dataSeriesLabelPie))
            ->with('resourceLabel',json_encode($resourceLabel))
            ->with('populationLabel',json_encode($populationLabel))
            ->with('weekLabel',json_encode($weekLabel))
            ->with('populationLabelview',$populationLabel)
            ->with('layout',$this->layout)
            ->with('numberofweeks',$numberofweeks)
            ->with('avg_msg',$avg_msg)
            ->with('simnumber',$number_of_simulations);

        } else {
            return Redirect::route('index');
        }



    }

}
