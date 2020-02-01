<?php

namespace App\Http\Controllers;


use Input;
use Validator;
use Redirect;
use Hash;
use Request;
use Route;
use Response;
use Auth;
use URL;
use Session;
use Laracasts\Flash\Flash;
use View;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Project;
use App\Simulation;

class HomeController extends Controller
{
    public function __construct() {
    }


        public function getHomePage()
    {

        $layout_title = 'layouts.master';

        $projects = Project::get();

        foreach ($projects as $key => $value) {

            $value->simcount = count(Simulation::where("project_id",$value->id)->get());

        }

        return view('index')
        ->with('projects',$projects)
        ->with('layout',$layout_title);

    }

    // public function postSendEmail(){

    //     $pform = null;
    //     parse_str(Input::get('pform'), $pform);
    //     $email = $pform['email'];//useremail
    //     $name = $pform['name'];
    //     $subject = $pform['subject'];
    //     $message = $pform['message'];
    //     $sender_email = [$email];
        

    //     $mdata = array( 'name' => $name,
    //             'message' => $message,
    //             'email' => $email,
    //             'subject' => $subject
    //             );

    //     Mail::send('emails.thankyou', ['mdata' => $mdata], function ($m) use ($sender_email) {
    //                 $m->from('support@www.webprinciples.com', 'Thank You! From KPike Consulting Solutions');
    //                 $m->to($sender_email)->subject('Thank You, from KPike Consulting Solutions');
    //         });
    //     $all_emails = ['info@kpikeconsultingsolutions.com','kassandra.pike@gmail.com'];
    //     if (Mail::send('emails.purchase_request', ['mdata' => $mdata], function ($m) use ($all_emails) {
    //                 $m->from('support@www.webprinciples.com', 'PostMaster-KPike');
    //                 $m->to($all_emails)->subject('KPike-New-Message');
    //         })) {
    //         return Response::json(array(
    //             'status' => 200
    //             ));
    //     } else {
    //         return Response::json(array(
    //             'status' => 400
    //         ));   
    //     }

    // }

    // public function getResources()
    // {
    //     $layout_title = 'layouts.master';

    //     return view('pages.resources')
    //     ->with('layout',$layout_title);
    // }

    // public function getBlog()
    // {
    //     $layout_title = 'layouts.master';


    //     $all_blogs = Page::where("image_option",1)->get();

    //     foreach ($all_blogs as $k => $v) {
    //         $v->date = date ( 'd M, Y',  strtotime($v->created_at) );
    //         $v->keyword = json_decode($v->keywords);
    //     }   


    //     return view('pages.blog')
    //     ->with('layout',$layout_title)
    //     ->with('blogs',$all_blogs);
    // }

    // public function getAbout()
    // {
    //     $layout_title = 'layouts.master';
    //     return view('pages.aboutus')
    //     ->with('layout',$layout_title);
    // }


    // public function getService()
    // {
    //     $layout_title = 'layouts.master';
    //     return view('pages.services')
    //     ->with('layout',$layout_title);
    // }

    // public function getScheduler()
    // {
    //     $layout_title = 'layouts.master';
    //     return view('pages.scheduler')
    //     ->with('layout',$layout_title);
    // }
    // public function getCasestudies()
    // {
    //     $layout_title = 'layouts.master';
    //     return view('pages.casestudies')
    //     ->with('layout',$layout_title);
    // }


}
