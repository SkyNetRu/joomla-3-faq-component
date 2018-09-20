<?php

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class FAQControllersEdit extends FAQControllersDefault
{
	function execute()
	{
		$app = JFactory::getApplication();
		$viewName = $app->input->get('view');
		$app->input->set('layout','edit');
		$app->input->set('view', $viewName);
		//display view
		return parent::execute();
	}
}