<?php
class RestaurantPage extends Page{
	public static $db = array(
		'ContentMenu' => 'HTMLText',
		'City' => 'Varchar',
		'Address' => 'Text',
		'Phone' => 'Varchar',
		'Phone2' => 'Varchar',
		'Email' => 'Varchar',
		'PubHeader' => 'Text',
		'NewGroup' => 'Enum("false,true")',
	);

	public static $has_many = array(
		'Images' => 'ImageRestaurant',
	);

	public function getMenuTitle(){
		return $this->Title . " - " . $this->City;
	}

	public function PubHeader(){
		return nl2br($this->PubHeader, true);
	}

	public function Address(){
		return nl2br($this->Address, true);
	}

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName('MenuTitle');

		$fields->addFieldToTab('Root.Menu', new HTMLEditorField('ContentMenu', 'Menu'));

		$fields->addFieldsToTab('Root.Informations', array(
			new TextField('City', 'City'),
			new TextareaField('Address', 'Address'),
			new TextField('Phone', 'Phone 1'),
			new TextField('Phone2', 'Phone 2'),
			new EmailField('Email', 'Email'),
			));

		$fields->addFieldsToTab('Root.Header', array(
			new TextareaField('PubHeader', 'PubHeader'),
			));


		$member = Member::currentUser();
		if($member->inGroup('admin')){
			$fields->addFieldToTab('Root.Admin', new DropdownField('NewGroup', 'NewGroup', $this->dbObject('NewGroup')->enumValues()));
		}		

		if($this->ID && Translatable::get_current_locale() == "en_US"){
			$config = GridFieldConfig_RecordEditor::create();
			$config->addComponent(new GridFieldBulkImageUpload());
			$config->addComponent(new GridFieldSortableRows('SortOrder'));
			$config->getComponentByType('GridFieldBulkImageUpload')->setConfig('folderName', 'restaurants' );
			$gridfield = new GridField('Images', 'Images', $this->Images(), $config);
			$fields->addFieldToTab('Root.Images', $gridfield);
		}

		return $fields;
	}
}
class RestaurantPage_Controller extends Page_Controller {
	// private static $allowed_actions = array();
}