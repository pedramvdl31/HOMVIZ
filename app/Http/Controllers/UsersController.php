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
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Thread;
use App\Category;
use App\RoleUser;
use App\QuestionsNAnswer;
use App\Review;

class UsersController extends Controller
{
    public function __construct() {

        $this->layout = "layouts.default";

    }

    public function getRegistration()
    {

        return view('auth.register')
        ->with('layout',$this->layout);

    }

    public function postRegistration()
    {

        $email = Input::get('email');
        $u = User::where('email',$email)->first();

        if ($u===null) {

            $user = new User;
            $user->name = Input::get('name');
            $user->email = $email;
            $user->password = Hash::make(Input::get('password')); 
            $user->save();
            Auth::attempt(array('email'=> $user->email, 'password'=>Input::get('password')));

        } else {

            Flash::error('User exists');

        }

        return Redirect::route('index');

    }

    public function getLogin()
    {
        return view('auth.login')
        ->with('layout',$this->layout);
    }

    public function postLogin()
    {
        $email = Input::get('email');
        $password = Input::get('password');

        if (Auth::attempt(array('email'=>$email, 'password'=>$password))) {
            return Redirect::route('index');
        } else {
            return Redirect::route('login');
        }
        
    }   

    public function getLogout()
    {
        Auth::logout();
        return Redirect::action('HomeController@getHomepage');
    }

    public function postLogout()
    {
        Auth::logout();
        return Redirect::action('HomeController@getHomepage');
    }

}
