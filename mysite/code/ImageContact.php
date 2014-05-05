<?php
class ImageContact extends ImageExtras{
	public static $has_one = array(
		'UserDefinedForm' => 'UserDefinedForm',
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->removeByName('Image');

		$uploadField = new UploadField('Image', 'Image');
		$uploadField->setFolderName('contact');
		$uploadField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$fields->push($uploadField);

		return $fields;
	}
}