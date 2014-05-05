<?php
class ImageAbout extends ImageExtras{
	public static $has_one = array(
		'AboutPage' => 'AboutPage',
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->removeByName('Image');

		$uploadField = new UploadField('Image', 'Image');
		$uploadField->setFolderName('about');
		$uploadField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$fields->push($uploadField);

		return $fields;
	}
}