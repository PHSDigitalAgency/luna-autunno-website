<?php
class ProductPageHolder extends Page{
	public static $has_many = array(
		'Addresses' => 'LunaAddress',
		'Images' => 'ImageProductPageHolder',
	);

	public static $allowed_children = array(
		'ProductPage',
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		if($this->ID){
			$config = GridFieldConfig_RecordEditor::create();
			$config->addComponent(new GridFieldSortableRows('SortOrder'));
			$gridfield = new GridField('Addresses', 'Addresses', $this->Addresses(), $config);
			$fields->addFieldToTab('Root.Addresses', $gridfield);
		}
		if($this->ID && Translatable::get_current_locale() == "en_US"){
			$config2 = GridFieldConfig_RecordEditor::create();
			$config2->addComponent(new GridFieldBulkImageUpload());
			$config2->addComponent(new GridFieldSortableRows('SortOrder'));
			$config2->getComponentByType('GridFieldBulkImageUpload')->setConfig('folderName', 'products' );
			$f = new GridField('Images', 'Images', $this->Images(), $config2);
			$fields->addFieldToTab("Root.Images", $f);
		}
		return $fields;
	}
}
class ProductPageHolder_Controller extends Page_Controller {
	// private static $allowed_actions = array();


	public function getTypeProduct(){
		return TypeProduct::get();
	}
}