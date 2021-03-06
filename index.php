<?php
/*
 * index.php
 * 
 * The main file
 */

define('DEV_MODE',1);

// Initialize the download instance here
require_once('class/DownloadInstance.php');
require_once('class/filesdir.php');
$DownloadInstance = DownloadInstance::getInstance();
// Transloads and getProgress needs to bypass the loader process
// Well, for an unknown reason at the moment...
// I suspect it's the template engine's problem
// So all Ajax request should bypass the loader due to template engine problem
if (isset($_GET['mod'])) {
	switch ($_GET['mod']) {
		case 'getProgress':
			require_once('controller/progress.php');
			break;
		case 'transload':
			require_once('controller/transload.php');
			break;
		case 'ajaxrename':
			require_once('controller/ajaxrename.php');
			break;
		case 'refreshFileTable':
			require_once('controller/refreshftable.php');
			break;
		case 'ajaxaction':
			require_once('controller/ajaxaction.php');
			break;
		case 'createdir':
			require_once('controller/createdir.php');
			break;
		default:
			// Makes sure doesn't exits any defaults
			$out = 1;
	}
	if (!$out)
		exit;
}

// Loader
require_once('loader.php');

// Get mod from _GET
$mod = "";
if (isset($_GET['mod'])) $mod = $_GET['mod'];

$TemplateClass->assignGlobal('template_path', $template_path);

// Content page
$DisplayContent =  $TemplateClass->getDisplay('content', true);
$DisplayContent->assign('display', 'DISPLAY');

switch ($mod) {
	case 'action':
		
		break;
	case 'transload':
		
		break;
	default:
		require_once('controller/default.php');
		$DisplayContent->addTemplate('default', 'default.phtml');
		break;
}

// Print the index page
$DisplayIndex =  $TemplateClass->getDisplay('index'); 

// Assign objects
$DisplayIndex->assign('DisplayContent',     $DisplayContent);

// Add templates
$DisplayIndex->addTemplate('header', 'header.phtml');
$DisplayIndex->addTemplate('index' , 'index.phtml' );
$DisplayIndex->addTemplate('footer', 'footer.phtml'); 

// assign global variables
$TemplateClass->assignGlobal('mod',     $mod);
$TemplateClass->assignGlobal('global',  'GLOBAL');

// display all non separated 'display'
$TemplateClass->display(); 
?>