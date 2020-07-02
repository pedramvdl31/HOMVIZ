<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Simulation extends Model
{

	static public function mergeResourcesPropreties($resources, $prop, $keyname){

        foreach ($resources as $rk => $resource) {

        	if (count($resource['subresources']) > 0) {

		        foreach ($resource['subresources'] as $sk => $subresource) {

	        		$resources[$rk]['subresources'][$sk][$keyname] = [];

		            if (isset($prop)) {

		                #Look for the same ID in subreserouces array, if so that means this resrouces has a subresource
		                if (isset($prop['resource'][$sk])) {

		                    $resources[$rk]['subresources'][$sk][$keyname] = $prop['resource'][$sk];

		                }

		            }


		        }

        	} else {


	            $resources[$rk][$keyname] = [];

	            if (isset($prop)) {

	                #Look for the same ID in subreserouces array, if so that means this resrouces has a subresource
	                if (isset($prop['resource'][$rk])) {

	                    $resources[$rk][$keyname] = $prop['resource'][$rk];

	                }

	            }


        	}

        }

        return $resources;

   }


	static public function mergeStatesPropreties($states, $prop, $keyname){

        foreach ($states as $rk => $state) {

        	if (count($state['substates']) > 0) {

		        foreach ($state['substates'] as $sk => $substates) {

	        		$states[$rk]['substates'][$sk][$keyname] = [];

		            if (isset($prop)) {

		                #Look for the same ID in subreserouces array, if so that means this resrouces has a subresource
		                if (isset($prop['state'][$sk])) {

		                    $states[$rk]['substates'][$sk][$keyname] = $prop['state'][$sk];

		                }

		            }


		        }

        	} else {


	            $states[$rk][$keyname] = [];

	            if (isset($prop)) {

	                #Look for the same ID in subreserouces array, if so that means this resrouces has a subresource
	                if (isset($prop['state'][$rk])) {

	                    $states[$rk][$keyname] = $prop['state'][$rk];

	                }

	            }


        	}

        }

        return $states;

   }



   static public function AverageMultipleSimulations($data){

   		$output = [];

   		$number_of_simulatons = count($data);

		$current_simulation = 0;

		$output['simulation_0'] = [];

		foreach ($data['simulation_0'] as $weekname => $weekdata) {

			// Job::dump($weekname);

			$output['simulation_0'][$weekname] = [];

			foreach ($weekdata as $resourcename => $resoruces) {

				// Job::dump($resourcename);

				$output['simulation_0'][$weekname][$resourcename] = [];

				foreach ($resoruces as $gendername => $genderdata) {

					// Job::dump($gendername.' '.$weekname);
					$total = 0;

					for ($i=0; $i < $number_of_simulatons; $i++) { 
						$total = $total + $data['simulation_'.$i][$weekname][$resourcename][$gendername];
						// Job::dump('one by one -> '.$data['simulation_'.$i][$weekname][$resourcename][$gendername]);
						// Job::dump('total -> '.$total);
					}

					$avg = $total / $number_of_simulatons;

					$output['simulation_0'][$weekname][$resourcename][$gendername] = (int)$avg;

				// 	Job::dump('average -> '.$avg);


				// Job::dump('+++++++++++++++++++++++');
				// Job::dump('+++++++++++++++++++++++');


				}

				// Job::dump('**************************');
				// Job::dump('**************************');
			

			}


		}

		// Job::dump($output);

   		return $output;

   }



   static public function AverageMultipleSimulatixxxns($data){

   		$output = [];

   		$number_of_simulatons = count($data);

		$current_simulation = 0;

		$output['simulation_0'] = [];

		foreach ($data['simulation_0'] as $res_key => $resrouce) {

			$output['simulation_0'][$res_key] = [];

			foreach ($resrouce as $gender_key => $gender) {
				
				$output['simulation_0'][$res_key][$gender_key] = [];

				foreach ($gender as $dp_key => $datapoint) {
					

					$total = $datapoint;

					for ($i=0; $i < $number_of_simulatons; $i++) { 
						$total = $total + $data['simulation_'.$i][$res_key][$gender_key][$dp_key];
					}

					$output['simulation_0'][$res_key][$gender_key][$dp_key] = $total / $number_of_simulatons;

				}		   			

			}

		}

   		return $output;

   }

}
