<?php
class LunaAddress extends DataObject implements PermissionProvider{
	public static $db = array(
		'SortOrder'=>'Int',
		'City' => 'Varchar',
		'Address' => 'Text',
		'Phone' => 'Varchar',
		'Phone2' => 'Varchar',
		'Email' => 'Varchar',
	);

	public static $has_one = array(
		'ProductPageHolder' => 'ProductPageHolder',
	);
	
	public static $summary_fields = array(
		'SortOrder' => 'Order',
		'City' => 'City',
		'Address' => 'Address',
		// 'Phone' => 'Phone',
		'Email' => 'Email',
	);

	public static $default_sort = 'SortOrder';

	public function Address(){
		return nl2br($this->Address, true);
	}
	
	public function getCMSFields(){
		$fields = parent::getCMSFields();
		
		$fields->removeByName('SortOrder');
		$fields->removeByName('ProductPageHolderID');
		$fields->removeByName('Phone');
		$fields->removeByName('Phone2');
		$fields->removeByName('Email');

		$fields->addFieldToTab("Root.Main", new TextField('Phone', 'Phone 1'));
		$fields->addFieldToTab("Root.Main", new TextField('Phone2', 'Phone 2'));
		$fields->addFieldToTab("Root.Main", new EmailField('Email', 'Email'));

		return $fields;
	}

	/* 
	 * Permissions
	 */
	public static $api_access = true;

	public function canView($member = NULL) {
		return Permission::check('LUNAADDRESS_VIEW');
	}
	public function canEdit($member = NULL) {
		return Permission::check('LUNAADDRESS_EDIT');
	}
	public function canDelete($member = NULL) {
		return Permission::check('LUNAADDRESS_DELETE');
	}
	public function canCreate($member = NULL) {
		return Permission::check('LUNAADDRESS_CREATE');
	}
	public function providePermissions() {
		return array(
			'LUNAADDRESS_VIEW' => 'Read an address object',
			'LUNAADDRESS_EDIT' => 'Edit an address object',
			'LUNAADDRESS_DELETE' => 'Delete an address object',
			'LUNAADDRESS_CREATE' => 'Create an address object',
		);
	}
}