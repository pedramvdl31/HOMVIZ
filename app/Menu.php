<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    static public function PrepareForIndex($all_menus) {
    	if(isset($all_menus)) {
    		foreach ($all_menus as $ackey => $acvalue) {
				if(isset($acvalue['created_at'])) {
					$acvalue['created_at_html'] = date ( 'Y/n/d g:ia',  strtotime($acvalue['created_at']) );
				}    		
				if(isset($acvalue['type'])) {
					switch ($acvalue['type']) {
						case 1:
							$acvalue['type_html'] = 'Link';
							break;
						case 2:
							$acvalue['type_html'] = 'Level 1 DropDown';
							break;
						case 3:
							$acvalue['type_html'] = 'Level 2 DropDown';
							break;
					}
				}    		
				if(isset($acvalue['status'])) {

					if ($acvalue['status'] == 3) {
						$acvalue['status_message']= '<span class="label label-danger">Deleted</span>';
					} else {
						$this_date = strtotime($acvalue->menu_date);
			    		$now_time = time();
			    		if ($this_date > $now_time) {
			    			$acvalue['status_message']= '<span class="label label-success">Active</span>';
			    		} else {
			    			$acvalue['status_message']= '<span class="label label-warning">Ended</span>';
			    		}
					}
				}
			}

    	}

    	return $all_menus;
    }

	public static function prepareNestable($menus) {
		if (isset($menus)) {
			$html = '<div class="cf nestable-lists">
        			<div class="dd" id="nestable">
            		<ol class="dd-list">';
			foreach ($menus as $mk => $mv) {
				if ($mv['type']==1 && $mv['parent_id']==0) {//Link
					$html .= '	<li class="dd-item" data-id="'.$mv['id'].'">
			                    	<div class="dd-handle">'.$mv['title'].'</div>';
					$html .= '</li>';
				} elseif ($mv['type']==2) {
					$html .= '	<li class="dd-item" data-id="'.$mv['id'].'">
				                    <div class="dd-handle">'.$mv['title'].'</div>';
				    $html .= '<ol class="dd-list">';

					foreach ($menus as $ma => $mx) {
						
						if ($mx['parent_id']==$mv['id'] && $mx['type']==1) {

							$html .= '<li class="dd-item" data-id="'.$mx['id'].'"><div class="dd-handle">'.$mx['title'].'</div>';
							$html .= '</li>';

						} elseif ($mx['parent_id']==$mv['id'] && $mx['type']==3) {
							$html .= '	<li class="dd-item" data-id="'.$mx['id'].'">
			                            <div class="dd-handle">'.$mx['title'].'</div>';
			                $html .= '<ol class="dd-list">';
			                foreach ($menus as $max => $mxd) {
			                	if ($mxd['parent_id']==$mx['id'] && $mxd['type']==1) {
			                		$html .= '<li class="dd-item" data-id="'.$mxd['id'].'"><div class="dd-handle">'.$mxd['title'].'</div>';
									$html .= '</li>';
			                	}
			                }
			                $html .= '	</ol>
                        				</li>';
						}
					}
					$html .= '</ol>';
				    $html .=  '</li>';
				}
			}

			$html .= '</ol>
					  </div>
					  </div>';




		}




		return $html;
	}
    static public function PrepareMenuForEdit($menu) {

    	if(isset($menu)) {
                if(isset($menu['created_at'])) {
                    $menu['created_at_html'] = date ( 'Y/n/d g:ia',  strtotime($menu['created_at']) );
                }
                if(isset($menu['description'])) {
                	$menu['decoded_description'] = json_decode($menu['description']);
                }           
          
    	}

    	return $menu;
    }

    static public function PrepareMenuSelect() {
	    return array
	    	(
	        '' => 'Select Menu Type',
	        1 => 'Link',
	        2 => 'Level 1 Dropdown',
	        3 => 'Level 2 Dropdown',
	        );      
    }

    static public function PrepareDropdownsSelect() {
        $data =  Menu::where('type',2)->orWhere('type',3)->get();
        $ps = array(''=>'Select Dropdown');
        if(isset($data)) {
            foreach ($data as $dkey => $dvalue) {
                
                $idd = $dvalue->id;
                $title = $dvalue['title'];
                $ps[$idd] = $title; 
            }

        }
        return $ps;      
    }

    static public function PrepareFirstDropdownsSelect() {
        $data =  Menu::where('type',2)->get();
        $ps = array(''=>'Select Dropdown');
        if(isset($data)) {
            foreach ($data as $dkey => $dvalue) {
                
                $idd = $dvalue->id;
                $title = $dvalue['title'];
                $ps[$idd] = $title; 
            }

        }
        return $ps;      
    }


    static public function CountMenusForIndex() {

    	$menus = Menu::all();
    	$all_count = 0;
    	foreach ($menus as $key => $menu) {
    		$this_date = strtotime($menu->menu_date);
    		$now_time = time();
    		if ($this_date > $now_time) {
    			$all_count++;
    		}
    	}

    	return $all_count;
    }

    static public function PrepareMenusForMenuPage() {
    	$all_menus = Menu::all();
    	if(isset($all_menus)) {
    		foreach ($all_menus as $ackey => $acvalue) {
				if(isset($acvalue['created_at'])) {
					$acvalue['created_at_html'] = date ( 'Y/n/d g:ia',  strtotime($acvalue['created_at']) );
				}    		
				if(isset($acvalue['status'])) {

					if ($acvalue['status'] == 3) {
						$acvalue['status_message']= '<span class="label label-danger">Deleted</span>';
					} else {
						$this_date = strtotime($acvalue->menu_date);
			    		$now_time = time();
			    		if ($this_date > $now_time) {

			    			$acvalue['status_message']= '<span class="label label-success">Active</span>';
			    		} else {
			    			$acvalue['status_message']= '<span class="label label-warning">Ended</span>';
			    		}
					}
				}

				if(isset($acvalue['description'])) {
                	$acvalue['decoded_description'] = json_decode($acvalue['description']);
				}  

				if(isset($acvalue['menu_date'])) {
						$this_date = strtotime($acvalue['menu_date']);
			    		$now_time = time();
			    		$new_date = date('l jS M',$this_date);
			    		if ($this_date > $now_time) {
							$acvalue['date_formated_label']= '<span class="label label-warning pull-right menu_date_label">'.$new_date.'</span>';
			    		} else {
							$acvalue['date_formated_label']= '<span class="label label-danger pull-right menu_date_label">'.$new_date.'&nbspEnded!</span>';
			    		}
				}  
			}
    	}
    	return $all_menus;
    }

    
}
