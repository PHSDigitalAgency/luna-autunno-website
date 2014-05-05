<?php
class LunaCalendarAnnouncement extends DataExtension{
	public static $db = array(
		'Content2' => 'HTMLText',
	);

	public static $has_one = array(
		'Image' => 'Image',
	);

/*	public function ContentSummary(){
		return nl2br($this->owner->Content2, true);
	}*/

	public function ImageThumbnail(){
		if($this->owner->Image()){
			return $this->owner->Image()->SetHeight(30);
		}
		return NULL;
	}

	public function updateCMSFields(FieldList $fields){
		$fields->removeByName('Content');
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('Content2', 'Content'));

		$uploadField = new UploadField('Image', 'Image');
		$uploadField->setFolderName('events');
		$uploadField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$fields->addFieldToTab('Root.Main', $uploadField);

		$fields->removeByName('CalendarID');
	}

	public function onBeforeDelete(){
		parent::onBeforeDelete();
		if($image = $this->owner->Image()){
			$this->owner->Image()->delete();
		}
	}

	/*
	 * Permissions
	 */
	function canView($member = false) {
		return true;
	}
	function canEdit($member = false) {
		if(!$member) $member = Member::currentUser();
			return $member->inGroup('administrators') || $member->inGroup('content-authors');
	}
	function canDelete($member = false) {
		if(!$member) $member = Member::currentUser();
			return $member->inGroup('administrators');
	}
	function canCreate($member = false) {
		if(!$member) $member = Member::currentUser();
			return $member->inGroup('administrators');
	}
}