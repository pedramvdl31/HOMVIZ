<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteBrand extends Model
{
	protected $table = 'website_brand';
    public static $slogan_add = array(
        'slogan'=>'required'
    );
    static public function CheckDataAndReturn()
    {
    	$webbrand = WebsiteBrand::find(1);
    	if (!isset($webbrand)) {
    		$webrand_new = new 	WebsiteBrand();
    		$webrand_new->title = "My Brand";
    		$webrand_new->brand_img_src = "brand_placeholder.jpg";
    		$webrand_new->save();
            $webbrand = WebsiteBrand::find(1);
    	}
        return $webbrand;
    }

    static public function PrepareSloganForIndex($data) {
        $new_data = [];
        if(isset($data)) {
            if (isset($data['slogan_array'])) {
                $new_data['slogan_array_html'] = json_decode($data['slogan_array']);
            }
        }
        return $new_data;
    }
}
