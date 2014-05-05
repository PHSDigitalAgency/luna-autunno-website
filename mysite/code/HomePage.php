<?php
class HomePage extends Calendar{

	public static $db = array(
	);

	public static $has_one = array(
	);

	public static $has_many = array(
		'Images' => 'ImageHome',
	);

	public function getCMSfields(){
		$fields = parent::getCMSfields();
	
		$fields->removeByName('Feeds');
		$fields->removeByName('RSSTitle');
		$fields->removeByName('Announcements');
		$fields->removeByName('Content');

		$fields->addFieldToTab('Root.Events', $gridField = GridField::create(
			'Events',
			'Events',
			$this->Announcements(),
			$config = GridFieldConfig_RecordEditor::create()
		));

		$config->removeComponentsByType('GridFieldFilterHeader');

		$dataColumns = $config->getComponentByType('GridFieldDataColumns');
		$dataColumns->setDisplayFields(array(
			'ImageThumbnail' => 'Thumbnail',
			'Title' => 'Title',
			'FormattedStartDate' => 'Start date',
			'FormattedEndDate' => 'End date',
			'FormattedStartTime' => 'Start time',
			'FormattedEndTime' => 'End time',
			'FormattedAllDay' => 'All day',
		));

		if($this->ID && Translatable::get_current_locale() == "en_US"){
			$config = GridFieldConfig_RecordEditor::create();
			$config->addComponent(new GridFieldBulkImageUpload());
			$config->addComponent(new GridFieldSortableRows('SortOrder'));
			$config->getComponentByType('GridFieldBulkImageUpload')->setConfig('folderName', 'home');
			$f = new GridField('Images', 'Images', $this->Images(), $config);
			$fields->addFieldToTab("Root.Images", $f);
		}

		$member = Member::currentUser();
		if($member->inGroup('content-authors')){
			$fields->removeByName('Configuration');
		}
		
		return $fields;
	}
}
class HomePage_Controller extends Calendar_Controller {
	public static $allowed_actions = array (
	);

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
}