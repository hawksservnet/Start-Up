<?php

//class Controller_Ajax extends Controller_Rest_Base
class Controller_Ajax extends Controller_Rest
{


	public function action_bike(){
		$result = array();

		$query = Model_Bike::BuildSearchQuery();
		$query->order_by('lat', 'desc');
		$query->order_by('lon', 'asc');
		$bikes = $query->get();
		$return_array = array();
		foreach($bikes as $bike){
			if(!$bike->lat or !$bike->lon)
				continue;
			$return_array[$bike->id] = $bike;
			$return_array[$bike->id]['lat'] = $bike->lat;
			$return_array[$bike->id]['lng'] = $bike->lon;
			$return_array[$bike->id]['icon'] = 'map_bicycle.png';
			$return_array[$bike->id]['order'] = $bike->getCurrentOrder();
			$return_array[$bike->id]['admin_bike_url'] = Uri::create('admin/bikes/detail/'.$bike->id);
			$return_array[$bike->id]['category_'] = $bike->category->name;
			$return_array[$bike->id]['company_'] = $bike->company->name;
			$return_array[$bike->id]['status_'] = $bike->getStatus();
			$return_array[$bike->id]['battery_remaining_'] = intval($bike->battery_remaining) .'%';
			$return_array[$bike->id]['photo_path'] = $bike->photo_path?:Asset::get_file('common/no_image.png', 'img');
			
		}
		return $this->response($return_array);
		
	}
	
}
