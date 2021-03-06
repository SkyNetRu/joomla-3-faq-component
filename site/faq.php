<?php

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */


// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//sessions
jimport( 'joomla.session.session' );

//load tables
JTable::addIncludePath(JPATH_COMPONENT.'/tables');

//load classes
JLoader::registerPrefix('FAQ', JPATH_COMPONENT);

//Load plugins
JPluginHelper::importPlugin('faq');

//application
$app = JFactory::getApplication();

//Load styles and javascripts
FAQHelpersStyle::load();

// Require specific controller if requested
if($controller = $app->input->get('controller','default')) {
	require_once (JPATH_COMPONENT.'/controllers/'.$controller.'.php');
}

// Create the controller
$classname = 'FAQControllers'.$controller;
$controller = new $classname();

// Perform the Request task
$controller->execute();