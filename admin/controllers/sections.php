<?php

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class FAQControllersSections extends FAQControllersDefault
{
	public function sections () {
		$app = JFactory::getApplication();
		$app->input->set('layout','default');
		$app->input->set('view', 'sections');
		//display view
		return parent::execute();
	}
}