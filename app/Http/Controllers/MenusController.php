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
use App\Review;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Page;
use App\Layout;
use App\Menu;
use App\WebsiteBrand;
use App\QuestionsNAnswer;


class MenusController extends Controller
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

    }

    public function getIndex()
    {   
        $all_menus = Menu::PrepareForIndex(Menu::all());
        return view('menus.index')
        ->with('layout',$this->layout)
        ->with('all_menus',$all_menus);
    }

    public function getAdd()
    {   
        $type_select = Menu::PrepareMenuSelect();
        $dropdowns = Menu::PrepareDropdownsSelect();
        $first_dropdowns = Menu::PrepareFirstDropdownsSelect();
        $pages = Page::PrepareAllPagesSelect();
        
        return view('menus.add')
        ->with('type_select',$type_select)
        ->with('pages',$pages)
        ->with('dropdowns',$dropdowns)
        ->with('first_dropdowns',$first_dropdowns)
        ->with('layout',$this->layout);
    }

        public function postAdd()
    {   

        $type = Input::get('type');

        if (isset($type)) {
            switch ($type) {
                //LINK
                case 1:

                    $dropdown_id = Input::get('link_dropdown_id');
                    $page_id = Input::get('page_id');
                    $pages_data = Page::find($page_id);
                    $out_link = Input::get('out_link');
                    $link_title = Input::get('link_title');
                    if (($dropdown_id == '') && ($page_id == '') && ($out_link == '') || ($link_title == '')) {
                        Flash::error('Incomplete Forms!');
                        return Redirect::back();
                    } else {
                        $param_one = null;
                        $new_param_one = null;
                        if ($dropdown_id != '') {
                            $dropdown = Menu::find($dropdown_id);
                            if (isset($dropdown)) {
                                $param_one = $dropdown->title;
                                $new_param_one = Job::UrlFriendly($param_one);
                            }
                        }
                        $links = new Menu();

                        $out_link = $out_link == ''?'':Job::UrlFriendly($out_link);
                        $links->title = $link_title;
                        $links->status = 1;
                        $links->type = $type;
                        $links->page_id = $page_id;
                        $links->param_one = $new_param_one;
                        $links->param_two = $out_link == ''?$pages_data['param_one']:$out_link;
                        $links->parent_id = $dropdown_id;
                        $links->out_link = $out_link == ''?0:1;

                        if ($out_link!='') {
                            $ol = Input::get('out_link');
                            if (!preg_match("~^(?:f|ht)tps?://~i", $ol)) {
                                $ol = "http://" . $ol;
                            }
                            $links->param_one = $ol;
                            $links->param_two = $ol;
                        }

                        if ($links->save()) {
                            Flash::Success('Successfully Saved!');
                            return Redirect::route('menus_index');
                        }

                    }
                    break;
                //LEVEL1
                case 2:
                    $dropdown_title = Input::get('first_dropdown_title');
                    if ($dropdown_title != '') {
                        $dropdown = new Menu();
                        $dropdown->title = $dropdown_title;
                        $dropdown->status = 1;
                        $dropdown->type = $type;
                        if ($dropdown->save()) {
                            Flash::Success('Successfully Saved!');
                            return Redirect::route('menus_index');
                        }
                    } else {
                        Flash::error('Dropdown Title cannot be empty.');
                        return Redirect::back();
                    }

                    break;
                //LEVEL2
                case 3:
                    $dropdown_title = Input::get('second_dropdown_title');
                    $first_dropdown_id = Input::get('first_dropdown_id');
                    if ($dropdown_title != '' && $first_dropdown_id != '') {
                        $dropdown = new Menu();
                        $dropdown->title = $dropdown_title;
                        $dropdown->parent_id = $first_dropdown_id;
                        $dropdown->status = 1;
                        $dropdown->type = $type;
                        if ($dropdown->save()) {
                            Flash::Success('Successfully Saved!');
                            return Redirect::route('menus_index');
                        }
                    } else {
                        Flash::error('Incomplete Forms');
                        return Redirect::back();
                    }
                    break;
                
                default:
                    # code...
                    break;
            }
        }

    }

        public function getEdit($id = null)
    {   
        if (isset($id)) {
            $type_select = Menu::PrepareMenuSelect();
            $dropdowns = Menu::PrepareDropdownsSelect();
            $first_dropdowns = Menu::PrepareFirstDropdownsSelect();
            $pages = Page::PrepareAllPagesSelect();
            $menu_data = Menu::find($id);
            return view('menus.edit')
            ->with('layout',$this->layout)
            ->with('this_id',$id)
            ->with('type_select',$type_select)
            ->with('pages',$pages)
            ->with('dropdowns',$dropdowns)
            ->with('first_dropdowns',$first_dropdowns)
            ->with('menu_data',$menu_data);
        }

    }

        public function postEdit()
    {   
        $type = Input::get('type');
        $this_id = Input::get('this_id');
        if (isset($type,$this_id)) {
            switch ($type) {
                //LINK
                case 1:
                    $dropdown_id = Input::get('link_dropdown_id');
                    $page_id = Input::get('page_id');
                    $pages_data = Page::find($page_id);
                    $out_link = Input::get('out_link');
                    $link_title = Input::get('link_title');
                    if (($dropdown_id == '') && ($page_id == '') && ($out_link == '') || ($link_title == '')) {
                        Flash::error('Incomplete Forms!');
                        return Redirect::back();
                    } else {
                        $param_one = null;
                        $new_param_one = null;
                        if ($dropdown_id != '') {
                            $dropdown = Menu::find($dropdown_id);
                            if (isset($dropdown)) {
                                $param_one = $dropdown->title;
                                $new_param_one = Job::UrlFriendly($param_one);
                            }
                        }
                        $links = Menu::find($this_id);
                        $out_link = $out_link == ''?'':Job::UrlFriendly($out_link);
                        $links->title = $link_title;
                        $links->status = 1;
                        $links->type = $type;
                        $links->page_id = $page_id;
                        $links->param_one = $new_param_one;
                        $links->param_two = $out_link == ''?$pages_data['param_one']:$out_link;
                        $links->parent_id = $dropdown_id;
                        $links->out_link = $out_link == ''?0:1;

                        if ($out_link!='') {
                            $ol = Input::get('out_link');
                            if (!preg_match("~^(?:f|ht)tps?://~i", $ol)) {
                                $ol = "http://" . $ol;
                            }
                            $links->param_one = $ol;
                            $links->param_two = $ol;
                        }


                        if ($links->save()) {
                            Flash::Success('Successfully Saved!');
                            return Redirect::route('menus_index');
                        }

                    }
                    break;
                //LEVEL1
                case 2:
                    $dropdown_title = Input::get('first_dropdown_title');
                    if ($dropdown_title != '') {
                        $dropdown = Menu::find($this_id);
                        $dropdown->title = $dropdown_title;
                        $dropdown->status = 1;
                        $dropdown->type = $type;
                        if ($dropdown->save()) {
                            Flash::Success('Successfully Saved!');
                            return Redirect::route('menus_index');
                        }
                    } else {
                        Flash::error('Dropdown Title cannot be empty.');
                        return Redirect::back();
                    }

                    break;
                //LEVEL2
                case 3:
                    $dropdown_title = Input::get('second_dropdown_title');
                    $first_dropdown_id = Input::get('first_dropdown_id');
                    if ($dropdown_title != '' && $first_dropdown_id != '') {
                        $dropdown = Menu::find($this_id);
                        $dropdown->title = $dropdown_title;
                        $dropdown->parent_id = $first_dropdown_id;
                        $dropdown->status = 1;
                        $dropdown->type = $type;
                        if ($dropdown->save()) {
                            Flash::Success('Successfully Saved!');
                            return Redirect::route('menus_index');
                        }
                    } else {
                        Flash::error('Incomplete Forms');
                        return Redirect::back();
                    }
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }

    public function getView($id = null)
    {   
        $menus = Menu::PrepareMenuForEdit(Menu::find($id));
        return view('menus.view')
        ->with('layout',$this->layout)
        ->with('menus',$menus);
    }

    public function getRemove($id = null)
    {   
        $menu = Menu::find($id);
        if (isset($menu)) {
            if ($menu->delete()) {
                Flash::success("Menu Deleted!");
                return Redirect::route('menus_index');
            }
        } else {
                Flash::success("Menu doesn't exist");
                return Redirect::route('menus_index');
        }
    }


    public function getOrder()
    {
        $menus = Menu::where('status',1)->orderBy('order', 'ASC')->get();
        $list_html = Menu::prepareNestable($menus,null);
        return view('menus.order')
        ->with('layout',$this->layout)
        ->with('list_html',$list_html);

    }

    public function postOrder()
    {
        $menus_arranged = Input::get('menu');
        foreach ($menus_arranged as $key => $value) {
            $menus = Menu::find($key);
            $menus->order = $value['order'];
            if (isset($value['secondtier'])) {
                $menus->type = 2;
                foreach ($value['secondtier'] as $skey => $svalue) {
                    $smenu = Menu::find($skey);
                    $smenu->order = $svalue['order'];
                    $smenu->parent_id = $key;
                    if (isset($svalue['thirdtier'])) {
                        $smenu->type = 3;
                        foreach ($svalue['thirdtier'] as $tkey => $tvalue) {
                            $tmenu = Menu::find($tkey);
                            $tmenu->order = $tvalue['order'];
                            $tmenu->type = 1;
                            $tmenu->parent_id = $skey;
                            $tmenu->save();
                        }
                    } else {
                        $smenu->type = 1;
                    }
                    $smenu->save();
                }
            } else {
                $menus->type = 1;
                $menus->parent_id = 0;
            }
            $menus->save();
        }
            Flash::success("Saved!");
            return Redirect::route('menus_order');
    }



}