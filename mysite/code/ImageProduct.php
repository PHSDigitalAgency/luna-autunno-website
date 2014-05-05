<?php
class ImageProduct extends ImageExtras{
	public static $has_one = array(
		'ProductPage' => 'ProductPage',
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->removeByName('Image');

		$uploadField = new UploadField('Image', 'Image');
		$uploadField->setFolderName('products');
		$uploadField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$fields->push($uploadField);

		return $fields;
	}
}