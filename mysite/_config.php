<?php

global $project;
$project = 'mysite';

global $database;
$database = '';

require_once('conf/ConfigureFromEnv.php');

/*global $databaseConfig;
$databaseConfig = array(
	"type" => 'MySQLDatabase',
	"server" => 'localhost',
	"username" => 'root',
	"password" => '19foumoila76',
	"database" => 'luna2',
	"path" => '',
);*/

// Set the site locale
i18n::set_locale('en_US');

Director::set_environment_type("dev");
// error_reporting(E_ALL);

// SSViewer::set_theme('luna');

Translatable::set_default_locale('en_US');
Translatable::set_allowed_locales(array('vi_VN', 'it_IT', 'en_US', 'fr_FR', 'ja_JP'));

GDBackend::set_default_quality(100);

ImageExtension::setResize(768,680);