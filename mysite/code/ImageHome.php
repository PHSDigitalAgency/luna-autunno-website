<?php
class ImageHome extends ImageExtras{
	public static $has_one = array(
		'HomePage' => 'HomePage',
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->removeByName('Image');

		$uploadField = new UploadField('Image', 'Image');
		$uploadField->setFolderName('home');
		$uploadField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$fields->push($uploadField);

		return $fields;
	}
}