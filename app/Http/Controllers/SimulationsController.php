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
                                "simulation_id: 32\r\n"
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

        $data = '{
            "simulation_0": 
                {  
                    "week_0": {
                        "Shelter": {
                            "Male": 100,
                            "Female": 50,
                            "Other": 20
                        },
                        "Street": {
                            "Male": 50,
                            "Female": 25,
                            "Other": 10
                        },
                        "Hidden Homeless": {
                            "Male": 25,
                            "Female": 10,
                            "Other": 5
                        },
                        "Not Homeless": {
                            "Male": 200,
                            "Female": 100,
                            "Other": 40
                        }
                    },
                    "week_1": {
                        "Shelter": {
                            "Male": 75,
                            "Female": 40,
                            "Other": 10
                        },
                        "Street": {
                            "Male": 75,
                            "Female": 35,
                            "Other": 20
                        },
                        "Hidden Homeless": {
                            "Male": 25,
                            "Female": 10,
                            "Other": 5
                        },
                        "Not Homeless": {
                            "Male": 200,
                            "Female": 100,
                            "Other": 40
                        }
                    },
                    "week_2": {
                        "Shelter": {
                            "Male": 100,
                            "Female": 50,
                            "Other": 20
                        },
                        "Street": {
                            "Male": 50,
                            "Female": 25,
                            "Other": 10
                        },
                        "Hidden Homeless": {
                            "Male": 50,
                            "Female": 20,
                            "Other": 15
                        },
                        "Not Homeless": {
                            "Male": 200,
                            "Female": 100,
                            "Other": 40
                        }
                    },
                    "week_3": {
                        "Shelter": {
                            "Male": 100,
                            "Female": 50,
                            "Other": 20
                        },
                        "Street": {
                            "Male": 50,
                            "Female": 25,
                            "Other": 10
                        },
                        "Hidden Homeless": {
                            "Male": 25,
                            "Female": 10,
                            "Other": 5
                        },
                        "Not Homeless": {
                            "Male": 225,
                            "Female": 110,
                            "Other": 50
                        }
                    },
                    "week_4": {
                        "Shelter": {
                            "Male": 125,
                            "Female": 60,
                            "Other": 50
                        },
                        "Street": {
                            "Male": 50,
                            "Female": 25,
                            "Other": 10
                        },
                        "Hidden Homeless": {
                            "Male": 25,
                            "Female": 10,
                            "Other": 5
                        },
                        "Not Homeless": {
                            "Male": 200,
                            "Female": 100,
                            "Other": 40
                        }
                    },
                    "week_5": {
                        "Shelter": {
                            "Male": 100,
                            "Female": 50,
                            "Other": 20
                        },
                        "Street": {
                            "Male": 75,
                            "Female": 35,
                            "Other": 40
                        },
                        "Hidden Homeless": {
                            "Male": 25,
                            "Female": 10,
                            "Other": 5
                        },
                        "Not Homeless": {
                            "Male": 200,
                            "Female": 100,
                            "Other": 40
                        }
                    },
                    "week_6": {
                        "Shelter": {
                            "Male": 100,
                            "Female": 50,
                            "Other": 20
                        },
                        "Street": {
                            "Male": 50,
                            "Female": 25,
                            "Other": 10
                        },
                        "Hidden Homeless": {
                            "Male": 25,
                            "Female": 10,
                            "Other": 5
                        },
                        "Not Homeless": {
                            "Male": 200,
                            "Female": 100,
                            "Other": 40
                        }
                    },
                    "week_7": {
                        "Shelter": {
                            "Male": 120,
                            "Female": 60,
                            "Other": 35
                        },
                        "Street": {
                            "Male": 50,
                            "Female": 25,
                            "Other": 10
                        },
                        "Hidden Homeless": {
                            "Male": 25,
                            "Female": 10,
                            "Other": 5
                        },
                        "Not Homeless": {
                            "Male": 200,
                            "Female": 100,
                            "Other": 40
                        }
                    },
                    "week_8": {
                        "Shelter": {
                            "Male": 100,
                            "Female": 50,
                            "Other": 20
                        },
                        "Street": {
                            "Male": 50,
                            "Female": 25,
                            "Other": 10
                        },
                        "Hidden Homeless": {
                            "Male": 25,
                            "Female": 10,
                            "Other": 5
                        },
                        "Not Homeless": {
                            "Male": 220,
                            "Female": 110,
                            "Other": 60
                        }
                    },
                    "week_9": {
                        "Shelter": {
                            "Male": 100,
                            "Female": 50,
                            "Other": 20
                        },
                        "Street": {
                            "Male": 50,
                            "Female": 25,
                            "Other": 10
                        },
                        "Hidden Homeless": {
                            "Male": 25,
                            "Female": 10,
                            "Other": 5
                        },
                        "Not Homeless": {
                            "Male": 200,
                            "Female": 100,
                            "Other": 40
                        }
                    }
                }
            }';

        $data = json_decode($sim->result, true);

        $numberofweeks = 0;

        $weekLabel = [];
        $dataSeriesLabel = [];
        $populationLabel = [];

        foreach ($data as $key => $sim) {
            foreach ($sim as $key => $week) {
                $numberofweeks = $numberofweeks + 1;
                array_push($weekLabel, 'Week '.$numberofweeks);
                $weektotal = 0;
                foreach ($week as $wk => $wv) {
                    $total = 0;
                    foreach ($wv as $pk => $pv) {
                        $total = $total + $pv;
                    }
                    // $data[$key][$wk]['Total'] = $total;
                    $weektotal = $weektotal + $total;
                }
                // $data[$key]['Total'] = [$weektotal];
            }
        }


        foreach ($data as $key => $sim) {

            foreach ($sim as $key => $week) {

                foreach ($week as $wk => $wv) {

                    if(!isset($dataSeriesLabel[$wk]))
                        $dataSeriesLabel[$wk]=[];

                    foreach ($wv as $pk => $pv) {

                        if(!isset($dataSeriesLabel[$wk][$pk]))
                            $dataSeriesLabel[$wk][$pk]=[];

                        if(!in_array($pk, $populationLabel))
                            array_push($populationLabel, $pk);

                        array_push($dataSeriesLabel[$wk][$pk], $pv);
                    }

                }

            }
        }


        return view('simulations.view')
        ->with('dataSeriesLabel',json_encode($dataSeriesLabel))
        ->with('populationLabel',json_encode($populationLabel))
        ->with('weekLabel',json_encode($weekLabel))
        ->with('populationLabelview',$populationLabel)
        ->with('layout',$this->layout)
        ->with('sim',$sim);

    }

    


}
