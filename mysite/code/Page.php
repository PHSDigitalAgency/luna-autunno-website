<?php
class Page extends SiteTree {

	private static $db = array(
		'CouleurMenu' => 'Enum("white,black")'
	);

	private static $has_one = array(
		'LogoImage' => 'Image',
	);

	/*private static $extensions = array(
		'Translatable'
	);*/
	
	private static $allowed_children = array();

	public function getCMSfields(){
		$fields = parent::getCMSfields();

		// $fields->removeByName('MenuTitle');
		
		$fields->addFieldToTab('Root.Logo', $uploadField = new UploadField('LogoImage', 'Upload a logo'));
		$uploadField->setFolderName('logos');
		$uploadField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
	
		/*if(!Permission::check('ADMIN') && $this->URLSegment == 'home'){
			$fields->removeByName('URLSegment');
		}*/

		return $fields;
	}
	public function getSettingsfields(){
		$fields = parent::getSettingsfields();

		if(Permission::check('ADMIN')){
			$fields->addFieldToTab('Root.Settings', new DropdownField('CouleurMenu', 'CouleurMenu', $this->dbObject('CouleurMenu')->enumValues()));
		}else{
			$fields->removeByName('Settings');
		}
		return $fields;
	}

	
}
class Page_Controller extends ContentController {
	private static $allowed_actions = array();

	public function init() {
		parent::init();

		Requirements::clear();

		Requirements::combine_files(
			'styles.css',
			array(
				'themes/luna/css/bootstrap.min.css',
				'themes/luna/css/bootstrap-responsive.min.css',
				'themes/luna/css/main.css',
				'themes/luna/css/main-responsive.css',
				'themes/luna/css/colorbox.css',
				// 'themes/luna/css/jquery.jscrollpane.css',
			)
		);

		// Requirements::themedCSS('bootstrap.min');
		// Requirements::themedCSS('bootstrap-responsive.min');
		// Requirements::themedCSS('main');
		// Requirements::themedCSS('main-responsive');
		// Requirements::themedCSS('colorbox');
		Requirements::themedCSS('jquery.jscrollpane');
		
		Requirements::combine_files(
			'scripts.js',
			array(
				'themes/luna/javascript/jquery-1.10.1.min.js',
				'themes/luna/javascript/bootstrap.min.js',
				'themes/luna/javascript/jquery.mousewheel.js',
				'themes/luna/javascript/jquery.jscrollpane.min.js',
				'themes/luna/javascript/jquery.colorbox-min.js',
				'themes/luna/javascript/plugins/CSSPlugin.min.js',
				'themes/luna/javascript/TweenLite.min.js',
				'themes/luna/javascript/TimelineLite.min.js',
				'themes/luna/javascript/script.js'
			)
		);

		if($this->dataRecord->hasExtension('Translatable')) { 
			i18n::set_locale($this->dataRecord->Locale); 
		}
	}

	public function PageByLang($url, $lang) {
		$SQL_url = Convert::raw2sql($url);
		$SQL_lang = Convert::raw2sql($lang);

		$page = Translatable::get_one_by_lang('SiteTree', $SQL_lang, "URLSegment = '$SQL_url'");

		if ($page->Locale != Translatable::get_current_locale()) {
			$page = $page->getTranslation(Translatable::get_current_locale());
		}
		return $page;
	}

	public function OrigineTranslation($lang) {
		$SQL_url = Convert::raw2sql($this->URLSegment);
		$SQL_lang = Convert::raw2sql($lang);

		$page = Translatable::get_one_by_lang('SiteTree', $SQL_lang, "URLSegment = '$SQL_url'");

		if ($page->Locale != Translatable::get_current_locale()) {
			$page = $page->getTranslation(Translatable::get_current_locale());
		}
		return $page;
	}

	public function FloorDecimal($zahl,$decimals=2){    
		return floor($zahl*pow(10,$decimals))/pow(10,$decimals);
	}

	public function StyleMenuBar(){
		$numItems = SiteTree::get()->where('ShowInMenus = 1 AND ParentID = 0')->count();
		if(!$numItems){
			return "";
		}
		$pct = $this->FloorDecimal(100 / $numItems) . "%";
		return " style=width:$pct";
	}
}
