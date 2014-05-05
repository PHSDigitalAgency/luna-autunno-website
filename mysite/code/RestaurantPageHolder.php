<?php
class RestaurantPageHolder extends RedirectorPage{
	public static $allowed_children = array(
		'RestaurantPage',
	);

	public function getCMSfields(){
		$fields = parent::getCMSfields();

		$fields->removeByName('Admin');
		
		return $fields;
	}
}
class RestaurantPageHolder_Controller extends RedirectorPage_Controller {
	// private static $allowed_actions = array();


}