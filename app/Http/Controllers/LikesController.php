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
use App\Like;

class LikesController extends Controller
{
    public function postLikeUs()
    {
        if(Request::ajax()){
            $count = 0;
            $status = 400;

            $pre_like = Session::get('like-session');
            if ($pre_like != true){
                Session::put('like-session',true);
                $status = 200;
                $likes = new Like();
                $likes->status = 1;
                if ($likes->save()) {
                    $count = count(Like::get());
                    $count += 14;
                } else {
                    $status = 400;
                }
            } else {
                $status = 401;
            }


            return Response::json(array(
                'status' => $status,
                'count' => $count
                ));
        }
    }
}
