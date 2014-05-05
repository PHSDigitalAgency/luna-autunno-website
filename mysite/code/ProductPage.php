<?php
class ProductPage extends Page{
	public static $db = array(
	);

	public static $has_one = array(
		'TypeProduct' => 'TypeProduct',
	);

	public static $has_many = array(
		'Images' => 'ImageProduct',
	);

	public $default = array(
		'CouleurMenu' => 'black',
	);

	public static $can_be_root = false;

	public function PopulateDefaults(){
		parent::PopulateDefaults();

		$this->CouleurMenu = 'black';
	}

	public function getMenuTitle(){
		return $this->Title . " - " . $this->TypeProduct()->Title;
	}

	public function getCMSfields(){
		$fields = parent::getCMSFields();

		$fields->removeByName('Content');
		$fields->removeByName('Admin');
		$fields->removeByName('Logo');

		$fields->addFieldToTab("Root.Main", new HTMLEditorField('Content', 'Product Description'), 'Metadata');
		$fields->addFieldToTab("Root.Main", $dropdown = new DropdownField('TypeProductID', 'Type Product', TypeProduct::get()->map('ID', 'Title')), 'Metadata');
		$dropdown->setEmptyString('(Select a type of product)');

		if($this->ID && Translatable::get_current_locale() == "en_US"){
			$config = GridFieldConfig_RecordEditor::create();
			$config->addComponent(new GridFieldBulkImageUpload());
			// $config->addComponent(new GridFieldBulkManager());
			$config->addComponent(new GridFieldSortableRows('SortOrder'));
			$config->getComponentByType('GridFieldBulkImageUpload')->setConfig('folderName', 'products' );
			$f = new GridField('Images', 'Images', $this->Images(), $config);
			$fields->addFieldToTab("Root.Images", $f);
		}

		return $fields;
	}

	public function CMSTreeClasses(){
		Requirements::css("mysite/css/TreeSelector.css"); 
		
		$classes = parent::CMSTreeClasses();

		// $classes .= " TypeSet";
		if(!$this->TypeProduct()->Title){
			// $classes = str_replace("TypeSet", "TypeNotSet", $classes);
			$classes .= " TypeNotSet";
		}else{
			
			$typeProd = $this->TypeProduct();
			
			$id = $this->TypeProduct()->ID;

			$sqlQuery = new SQLQuery();
			$sqlQuery->setFrom('TypeProduct_translationgroups')->selectField('OriginalID')->addSelect('OriginalID')->addWhere("ID = $id")->setLimit(1);
			$results = $sqlQuery->execute();

			foreach($results as $result){
				$TypeProdID = $result["OriginalID"];
			}

			$classes .= " TypeSet type-$TypeProdID";
		}

		return $classes;
	}
}
class ProductPage_Controller extends Page_Controller {
	// private static $allowed_actions = array();


}