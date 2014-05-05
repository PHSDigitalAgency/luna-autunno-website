<?php
class AboutPage extends Page{
	public static $db = array(
	);

	public static $has_one = array(
	);

	public static $has_many = array(
		'Images' => 'ImageAbout',
	);

	public function getCMSfields(){
		$fields = parent::getCMSFields();

		if($this->ID && Translatable::get_current_locale() == "en_US"){
			$config = GridFieldConfig_RecordEditor::create();
			$config->addComponent(new GridFieldBulkImageUpload());
			$config->addComponent(new GridFieldSortableRows('SortOrder'));
			$config->getComponentByType('GridFieldBulkImageUpload')->setConfig('folderName', 'about' );
			$f = new GridField('Images', 'Images', $this->Images(), $config);
			$fields->addFieldToTab("Root.Images", $f);
		}
		
		return $fields;
	}
}
class AboutPage_Controller extends Page_Controller {
	// private static $allowed_actions = array();
}