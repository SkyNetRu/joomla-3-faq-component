<?php

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class FAQControllersCategory extends FAQControllersDefault
{

	public function add()
	{
		$app = JFactory::getApplication();
		$app->input->set('layout','edit');
		$app->input->set('view', 'category');
		//display view
		return parent::execute();
	}
}