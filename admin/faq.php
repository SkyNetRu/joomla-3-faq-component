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
JPluginHelper::importPlugin('faq');

//application
$app = JFactory::getApplication();

// Require specific controller if requested
$controller = $app->input->get('controller','display');
// Create the controller

$classname  = 'FAQControllers'.ucwords($controller);
$controller = new $classname();

// Perform the Request task
$controller->execute();