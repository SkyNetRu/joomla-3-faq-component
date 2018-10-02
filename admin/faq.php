<?php

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//load classes
JLoader::registerPrefix('FAQ', JPATH_COMPONENT_ADMINISTRATOR);

//Load plugins
JPluginHelper::importPlugin('FAQ');

//application
$app = JFactory::getApplication();

$task = $app->input->getCmd('task', null);
if ($task){
	$controllername = explode(".", $task)[0];
	$methodname = explode(".", $task)[1];
	$classname = 'FAQControllers'.ucwords($controllername);
	$controller = new $classname();
	$controller->$methodname();
} else {
	// Require specific controller if requested
	$controller = $app->input->get('controller','default');

// Create the controller
	$classname  = 'FAQControllers'.ucwords($controller);
	$controller = new $classname();

// Perform the Request task
	$controller->execute();
}
