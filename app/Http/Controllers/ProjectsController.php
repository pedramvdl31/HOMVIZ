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

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;
use App\Simulation;

class ProjectsController extends Controller
{
	public function __construct() {
        $this->layout = "layouts.master";
        //CHECK IF THE HOMEPAGE IS SET
    }

    public function getAdd()
    {   
        return view('projects.add')
        ->with('layout',$this->layout);
    }

    public function postAdd()
    {   
       
        $p = new Project();
        $p->name = Input::get("name");
        $p->description = Input::get("description");
        $p->leader = Input::get("leader");
        $p->user_id = Auth::user()->id;

        if ($p->save()) {
            return Redirect::route('simulation_add',$p->id);
        }

    }


    public function getEdit($project_id=null)
    {   

        $project = Project::find($project_id);
        $simulation = Simulation::where("project_id",$project_id)->first();

        return view('projects.edit')
        ->with('project',$project)
        ->with('simulation',$simulation)
        ->with('layout',$this->layout);

    }

    public function postEdit()
    {   
       
        $project_id = Input::get("project_id");
        $p = Project::find($project_id);
        $p->name = Input::get("name");
        $p->description = Input::get("description");
        $p->leader = Input::get("leader");
        $p->user_id = Auth::user()->id;

        if ($p->save()) {
            return Redirect::route('simulation_index',$p->id);
        }

    }

    public function getDelete($project_id=null)
    {   

        $project = Project::find($project_id);


        $sim = Simulation::where("project_id",$project_id)->get();

        foreach ($sim as $key => $value) {

            $s = Simulation::find($value->id);
            $s->delete();

        }

        $project->delete();

        return Redirect::route('index');

    }


}
