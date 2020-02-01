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
use View;
use Session;
use Laracasts\Flash\Flash;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Thread;
use App\Category;
use App\RoleUser;
use App\WebsiteBrand;

class WebsiteBrandController extends Controller
{
     public function __construct() {
       if (Auth::user()) {
            switch (Auth::user()->roles) {
                case 1:
                    $this->layout = 'layouts.admins';
                    break;
                case 2:
                    $this->layout = 'layouts.admins';
                    break;
                case 3:
                    $this->layout = 'layouts.admins_simple';
                    break;
                
                default:
                    # code...
                    break;
            }
        }
        //check if nothing is set, set the default image and title
        WebsiteBrand::CheckDataAndReturn();
    }  
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $website_brand = WebsiteBrand::find(1);
        return view('website_brand.index')
            ->with('layout',$this->layout)
            ->with('website_brand',$website_brand);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function postIndex()
    {
        $images = Input::get('files');
        $imagename = [];
        $file_name = '';


        //GO THROUGH ALL IMAGES AND SAVE THE NAMES
        if (isset($images) && !empty($images)) {
            foreach ($images as $immkey => $immvalue) {
                $imagem_ex = explode(DIRECTORY_SEPARATOR, $immvalue['path']);
                $imagem_ex_count = sizeof($imagem_ex);
                $image_ex_name_type = $imagem_ex[$imagem_ex_count-1];
                $imagename[$immkey] = $image_ex_name_type;
            }
            $file_name = $imagename[0];
        }


        $webbrands = WebsiteBrand::find(1);
        $webbrands->title = Input::get('brand-title');
        $webbrands->brand_img_src = $file_name?$file_name:'brand_placeholder.jpg';
        if ($webbrands->save()) {



            if (isset($images) && !empty($images)) {
                if (!file_exists('assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'brand_image'.DIRECTORY_SEPARATOR.'perm')) {
                    mkdir('assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'brand_image'.DIRECTORY_SEPARATOR.'perm', 0777, true);
                }
                $oldpath_s = public_path("assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."brand_image".DIRECTORY_SEPARATOR."temp".DIRECTORY_SEPARATOR."".$file_name);
                $newpath_s = public_path("assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."brand_image".DIRECTORY_SEPARATOR."perm".DIRECTORY_SEPARATOR."".$file_name);
                rename($oldpath_s, $newpath_s);
            }

            return Redirect::route('website_brand_index');
        }

    }

    public function postUpload()
    {
        error_reporting(E_ALL | E_STRICT);
        $destinationPath = public_path("assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."brand_image".DIRECTORY_SEPARATOR."temp".DIRECTORY_SEPARATOR);
        $savePath = DIRECTORY_SEPARATOR."assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."brand_image".DIRECTORY_SEPARATOR."temp".DIRECTORY_SEPARATOR;
        // Check if directory is made for this company if not then create a new directory
        if (!file_exists($destinationPath)) {
            @mkdir($destinationPath);
        }    
        $files = Input::file('files');
        $fileName = str_random(12).'.jpg';
        // Save image and rename it to new name
        if(Input::file('files')->move($destinationPath, $fileName)){
            return Response::json([
                'success'=>true,
                'path'=> $savePath.$fileName
            ]);
        } else {
            return Response::json([
                'success'=>false,
                'reason'=> 'Error saving image.' 
            ]);
        } 
    }  

  public function getSloganIndex()
    {
        $slogans = WebsiteBrand::PrepareSloganForIndex(WebsiteBrand::find(1));
        return view('slogans.index')
            ->with('layout',$this->layout)
            ->with('slogans',$slogans);

    }
    /**
     * Adds a task 
     *
     * @return Response
     */
    public function getSloganAdd()
    {
        return view('slogans.add')
            ->with('layout',$this->layout);
    }  
    /**
     * Process Task Request
     *
     * @return Response
     */
    public function postSloganAdd()
    {       

        $validator = Validator::make(Input::all(), WebsiteBrand::$slogan_add);
        if ($validator->passes()) {
            $slogan = Input::get('slogan');

            $wb = WebsiteBrand::find(1);
            if (isset($wb['slogan_array'])) {
                $pre_a = json_decode($wb['slogan_array'],true);
                array_push($pre_a, $slogan);
                $wb->slogan_array = json_encode($pre_a);
            } else {
                $s_a = array();
                array_push($s_a, $slogan);
                $wb->slogan_array = json_encode($s_a);
            }

            if ($wb->save()) {
                 Flash::success('Successfully added!');
                 return Redirect::route('slogans_index');
            }
        }
        else {
             // validation has failed, display error messages    
            return Redirect::back()
            ->with('message', 'The following errors occurred')
            ->with('alert_type','alert-danger')
            ->withErrors($validator)
            ->withInput(); 
        } 
        
    }  
    /**
     * /admins/tasks/edit.
     * @param $id - task_id
     * @return Response
     */
    public function getSloganEdit($id = null)
    {
        if (isset($id)) {
            $kr_cities = Job::StatesOfKoreaForSelect();
            $country_code = Job::country_code();
            $slogans = Tag::find($id);
            $status = Tag::PrepareStatusForSelect();
                return view('slogans.edit')
                ->with('layout',$this->layout)
                ->with('status',$status)
                ->with('slogans',$slogans);
        } else {
            Redirect::back();
        }
    } 
    /**
     * Process Task Edit Request
     *
     * @return Response
     */
    public function postSloganEdit()
    {
       $validator = Validator::make(Input::all(), Tag::$rule_add);
        if ($validator->passes()) {
            $title = Input::get('title');
            $description = Input::get('description');
            $id = Input::get('id');
            $slogans_data = Tag::find($id);
            $slogans_data->title = $title;
            $slogans_data->description = $description;
            if ($slogans_data->save()) {
                 Flash::success('Successfully added!');
                 return Redirect::route('slogans_index');
            }
        }
        else {
             // validation has failed, display error messages    
            return Redirect::back()
            ->with('message', 'The following errors occurred')
            ->with('alert_type','alert-danger')
            ->withErrors($validator)
            ->withInput(); 
        } 
    }  

    public function getSloganRemove($id = null)
    {
        if (isset($id)) {
            $wd = WebsiteBrand::find(1);
            if (isset($wd)) {
                $sa = $wd->slogan_array;
                if (isset($sa)) {
                    $new_array = json_decode($sa,true);
                    if (isset($new_array[$id])) {
                        unset($new_array[$id]);
                        $wd->slogan_array =  json_encode($new_array);
                        if ($wd->save()) {
                            Flash::success('Successfully Removed!');
                            return Redirect::route('slogans_index');
                        }
                    } else {
                        Flash::error('Slogan not found!');
                        return Redirect::route('slogans_index');
                    }
                }

            }
        }
    } 
}
