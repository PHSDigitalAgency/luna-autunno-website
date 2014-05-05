<?php
class TypeProduct extends DataObject implements PermissionProvider{
	public static $db = array(
		'Title' => 'Varchar',
		'Description' => 'Text',
	);

	public static $has_many = array(
		'ProductPages' => 'ProductPage',
	);

	public static $extensions = array(
		'Translatable'
	);

	public function getProductClass(){
		return str_replace(' ', '-', $this->Title);
	}

	/* 
	 * Permissions
	 */
	public static $api_access = true;

	public function canView($member = NULL) {
		return Permission::check('TYPEPRODUCT_VIEW');
	}
	public function canEdit($member = NULL) {
		return Permission::check('TYPEPRODUCT_EDIT');
	}
	public function canDelete($member = NULL) {
		return Permission::check('TYPEPRODUCT_DELETE');
	}
	public function canCreate($member = NULL) {
		return Permission::check('TYPEPRODUCT_CREATE');
	}
	public function providePermissions() {
		return array(
			'TYPEPRODUCT_VIEW' => 'Read a type product object',
			'TYPEPRODUCT_EDIT' => 'Edit a type product object',
			'TYPEPRODUCT_DELETE' => 'Delete a type product object',
			'TYPEPRODUCT_CREATE' => 'Create a type product object',
		);
	}
}