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
use DateTime;
use App\Job;
use App\User;
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

    public function getTest()
    {

        // $u = User::all();

        // foreach ($u as $key => $value) {
        //     Job::dump($value->gender);
        //     // Job::dump($value->age);
        // }


        // $malecount = 0;
        // $femalecount = 0;
        // foreach ($u as $key => $value) {
        //     $age = '31 to 45';
        //     if ($value->age == $age && $value->gender == 'male') {
        //         $malecount++;
        //     }
        //     if ($value->age == $age && $value->gender == 'female') {
        //         $femalecount++;
        //     }
        // }
        // Job::dump('male count = '.$malecount);
        // Job::dump('female count = '.$femalecount);



        // $qs = DB::table('questionnaires')->get();
        // foreach ($qs as $key => $value) {
        //     Job::dump($value->stopwatch);
        // }


        // $qs = DB::table('questionnaires')->get();
        // foreach ($qs as $key => $value) {
        //     Job::dump($value->stopwatch);
        // }


        // $qs = DB::table('simulations')->get();
        // foreach ($qs as $key => $value) {
        //     Job::dump($value->user_id);
        // }


        // $qs = DB::table('simulations')->get();
        // $sum = 0;
        // foreach ($qs as $key => $value) {
        //     $sum = $sum + $value->videosliderwatches;
        // }
        // Job::dump($sum);


        $qs = DB::table('simulations')->get();
        foreach ($qs as $key => $value) {
            Job::dump($value->user_id.','.$value->videosliderwatches);
        }


        // $qs = DB::table('userdata')->get();
        // $limit = 0;
        // foreach ($qs as $key => $value) {
        //     $limit += 1;

        //     if ($limit!=999) {

        //         $total = 0;

        //         if (!empty($value->data)) {

        //             $data_array = explode(',', $value->data);


        //             foreach ($data_array as $k => $v) {
                        
        //                 if (!empty($v)) {

        //                     $data_point = explode(' ', $v);

        //                     $kind = $data_point[0];

        //                     if ($kind == 'started') {
                            
        //                         $date1 = date("Y-m-d H:i:s", substr($data_point[1], 0, 10));

        //                         $next_pasued = explode(' ', $data_array[$k+1]);

        //                         $date2 = date("Y-m-d H:i:s", substr($next_pasued[1], 0, 10));

        //                         $total = $total + Job::time_diff($date2,$date1);


        //                     }

        //                 }

        //             }

        //             Job::dump($value->user_id.','.$total);

        //         }

        //     }
        // }

        // $qs = DB::table('userdata')->get();
        // $limit = 0;
        // foreach ($qs as $key => $value) {
        //     $limit += 1;
        //     if ($limit==1) {

        //         $total = 0;

        //         $data_array = explode(',', $value->data);

        //         foreach ($data_array as $k => $v) {

        //             if (!empty($v)) {

        //                 $data_point = explode(' ', $v);

        //                 $kind = $data_point[0];
        //                 $data = date("Y-m-d H:i:s", substr($data_point[1], 0, 10));

        //                 $p = $pdata = $diff = $pkind = null;
        //                 if ($k!=0) {

        //                     $p = explode(' ', $data_array[$k-1]);
        //                     $pdata = $p[1];
        //                     $pkind = $p[0];

        //                 }

        //                 if ($pdata!=null && $pkind == 'started') {
                        
        //                     $diff = $data_point[1] - $pdata;
        //                     $pdata = date("Y-m-d H:i:s", substr($p[1], 0, 10));

        //                     $total = $total + Job::time_diff($data,$pdata);


        //                 }

        //             }

        //         }

        //         Job::dump($value->user_id.','.$total);

        //     }
        // }

        //---
        // $qs = DB::table('userdata')->get();
        // $qx = [];

        // $limit = 0;

        // foreach ($qs as $key => $value) {
        //     $limit += 1;

        //     if ($limit==5) {

        //         $data_array = explode(',', $value->data);
        //         array_push($qx, $data_array);

        //     }
        // }

        // $qx = json_encode($qx);


        // return view('test')
        // ->with('qx',$qx)
        // ->with('layout',"layouts.default");
        //----


        // $qs = DB::table('questionnaires')->get();
        // foreach ($qs as $key => $value) {

        //     $answer = json_decode($value->answer);

        //     foreach ($answer as $ka => $va) {
        //         if ($ka == 'sus') {
        //             $text=$value->user_id.',';
        //             foreach ($va as $keach => $veach) {

        //                 $comma = '';

        //                 if ($keach==11) {
        //                     $comma=',';
        //                 }
                    
        //                 if ($keach>=11 && $keach<=12) {
        //                     $comment = str_replace(',', '.', $veach);
        //                     $text.=$comment.$comma;
        //                 }

        //             }
        //             Job::dump($text);
        //             // Job::dump($value->user_id);
        //         }
        //     }
        // }



        // $qs = DB::table('questionnaires')->get();
        // foreach ($qs as $key => $value) {

        //     $answer = json_decode($value->answer);

        //     foreach ($answer as $ka => $va) {
        //         if ($ka == 'cuq') {

        //             $data = '';

        //             foreach ($va as $keach => $veach) {

        //                 foreach ($veach as $k2 => $v2) {
        //                     $data .= $v2.',';
        //                 }

        //             }

        //             Job::dump($data);

        //         }
        //     }
        // }

        // $qs = DB::table('users')->get();
        // foreach ($qs as $key => $value) {
        //     Job::dump($value->email);
        // }

        // $qs = DB::table('users')->get();
        // foreach ($qs as $key => $value) {

        //     $qsx = DB::table('userdata')->where('user_id',$value->id)->first();

        //     $video = 0;
        //     if (isset($qsx)) {
        //         $video = 1;
        //     }

        //     $qsy = DB::table('questionnaires')->where('user_id',$value->id)->first();
            
        //     $questionnaire = 0;
        //     if (isset($qsy)) {
        //         $questionnaire = 1;
        //     }

        //     $qsz = DB::table('simulations')->where('user_id',$value->id)->first();
            
        //     $sim = 0;
        //     if (isset($qsz)) {
        //         $sim = 1;
        //     }

        //     Job::dump($value->id.','.$video.','.$sim.','.$questionnaire);

        // }



    }




    public function getAdd()
    {

        return view('simulations.add')
        ->with('layout',$this->layout);

    }

    public function postprogressUpdate()
    {   

        $status = 400;
        $serverkey = env("SERVER_KEY");

        $output = [];

        try {

            $status = 200;

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
                            $output[$simulation->id]['statushtml']='<span class="badge badge-success">Completed</span>';
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
                    $output[$simulation->id]['statushtml']='<span class="badge badge-success">Completed</span>';
                    
                }

            }

        } catch (Throwable $e) {
   
        }

        return Response::json(array(
        'status' => $status,
        'output' => $output
        ));

    }

    public function postAdd()
    {
        
        $resources = Input::get('resources');
        $subresources = Input::get('subresources');
        $states = Input::get('states');
        $substates = Input::get('substates');

        if (isset($resources)) {

            foreach ($resources as $rk => $resource) {

                if ($resource['name']=='Addiction / Rehabilitation Center') {
                    $resources[$rk]['name'] = 'Rehabilitation';
                }

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
        $monthlyquota = Input::get('monthlyquota');
        $capacity = Input::get('capacity');

        $resources = Simulation::mergeResourcesPropreties($resources, $allowedPopulation, 'allowedpopulation');
        $resources = Simulation::mergeResourcesPropreties($resources, $initialPopulation, 'initialPopulation');
        $resources = Simulation::mergeResourcesPropreties($resources, $maximumlengthofstay, 'maximumlengthofstay');
        $resources = Simulation::mergeResourcesPropreties($resources, $monthlyquota, 'monthlyquota');
        $resources = Simulation::mergeResourcesPropreties($resources, $capacity, 'capacity');
        $states = Simulation::mergeStatesPropreties($states, $allowedPopulation, 'allowedpopulation');
        $states = Simulation::mergeStatesPropreties($states, $initialPopulation, 'initialPopulation');

        $creatorname = 'none';
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
        $output['transitionProbability'] = null;

        $sim = new Simulation();
        $sim->user_id = Auth::user()->id;
        $sim->data = json_encode($output);
        $sim->population_content = json_encode(Input::get('populationTypeCount'));
        $sim->stopwatch = Input::get('stopwatch');

        $sim->videosliderwatches = Input::get('videosliderwatches');
        
        $sim->save();

        return Redirect::route('index');

    }

    public function postDelete()
    {

        $status = 400;
        $sim_id = Input::get('sim_id');
        $sim = Simulation::where('id',$sim_id)->where('user_id',Auth::user()->id)->first();

        if (isset($sim) && !empty($sim)) {
            if ($sim->delete()) {
                $status = 200;
            }
        }

        return Response::json(array(
        'status' => $status
        ));

    }

    public function getView($sim_id=null)
    {

        $sim_info = [];

        $sim = Simulation::find($sim_id);

        if (isset($sim->result) && !empty($sim->result)) {

            $metadata = json_decode($sim->data, true);
            $sim_info['name'] = $metadata['simulation_name'];
            $sim_info['city'] = $metadata['simulation_location'];
            $sim_info['numberofweeks'] = $metadata['numberofweeks'];
            $sim_info['numberofsims'] = $metadata['numberofsims'];
            $sim_info['populattioncontent'] = json_decode($sim->population_content,true);
            $phpdate = strtotime( $sim->created_at );
            $sim_info['creatorname'] = date( 'Y-m-d H:i:s', $phpdate );

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


            //Get more info to show in details section
            $sim_info['listofresources'] = [];
            if (isset($metadata['resources'])) {

                foreach ($metadata['resources'] as $resval) {
                    
                    if (isset($resval['name-for-show'])) {

                        array_push($sim_info['listofresources'], $resval['name-for-show']);

                    }

                }

            }

            $sim_info['listofstates'] = [];
            if (isset($metadata['states'])) {

                foreach ($metadata['states'] as $stateval) {
                
                    array_push($sim_info['listofstates'], $stateval['name-for-show']);

                }

            }

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
            ->with('sim_info',$sim_info)
            ->with('simnumber',$number_of_simulations);

        } else {
            return Redirect::route('index');
        }



    }

}
