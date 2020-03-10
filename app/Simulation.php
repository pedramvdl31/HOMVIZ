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





}
