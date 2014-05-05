<?php
class ImageRestaurant extends ImageExtras{
	public static $has_one = array(
		'RestaurantPage' => 'RestaurantPage',
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->removeByName('Image');
			
		$uploadField = new UploadField('Image', 'Image');
		$uploadField->setFolderName('restaurants');
		$uploadField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$fields->push($uploadField);
		
		return $fields;
	}
}