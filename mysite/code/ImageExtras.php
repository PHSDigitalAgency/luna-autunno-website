<?php
class ImageExtras extends DataObject implements PermissionProvider{
	public static $db = array(
		'Title' => 'Varchar',
		'SortOrder' => 'Int',
	);

	public static $has_one = array(
		'Image' => 'Image',
	);

	public static $summary_fields = array(
		'SortOrder' => 'Order',
		'ImageThumbnail' => 'Thumbnail',
		'Title' => 'Title',
		'ImageDimensions' => 'Dimensions',
		'ImageSize' => 'Size',
	);
	
	public static $searchable_fields = array(
		'Title',
	);

	public static $default_sort = 'SortOrder';

	public function ImageDimensions(){
		if($this->Image())
			return $this->Image()->getDimensions();
		return NULL;
	}

	public function ImageSize(){
		if($this->Image())
			return $this->Image()->getSize();
		return NULL;
	}

	public function ImageThumbnail(){
		if($this->Image())
			return $this->Image()->SetHeight(30);
		return NULL;
	}

	public function getCMSFields(){
		$fields = new FieldList();

		$fields->push( new TextField('Title', 'Title'));
		$uploadField = new UploadField('Image', 'Image file');
		$uploadField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$fields->push($uploadField);

		return $fields;
	}

	public function onBeforeDelete(){
		parent::onBeforeDelete();

		$image = $this->Image();
		if($image->ID){
			$image->delete();
		}
	}

	public function onBeforeWrite(){
		parent::onBeforeWrite();
		if(!$this->Title){
			if($image = $this->Image())
				$this->Title = $image->Title;
		}
	}

	/* 
	 * Permissions
	 */
	public static $api_access = true;

	public function canView($member = NULL) {
		return Permission::check('IMAGEEXTRAS_VIEW');
	}
	public function canEdit($member = NULL) {
		return Permission::check('IMAGEEXTRAS_EDIT');
	}
	public function canDelete($member = NULL) {
		return Permission::check('IMAGEEXTRAS_DELETE');
	}
	public function canCreate($member = NULL) {
		return Permission::check('IMAGEEXTRAS_CREATE');
	}
	public function providePermissions() {
		return array(
			'IMAGEEXTRAS_VIEW' => 'Read an image object',
			'IMAGEEXTRAS_EDIT' => 'Edit an image object',
			'IMAGEEXTRAS_DELETE' => 'Delete an image object',
			'IMAGEEXTRAS_CREATE' => 'Create an image object',
		);
	}
}