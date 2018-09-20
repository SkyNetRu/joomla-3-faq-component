<?php

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class FAQViewsCategoryRaw extends JViewHtml
{
	function render()
	{
		$app = JFactory::getApplication();
		$type = $app->input->get('type');
		$id = $app->input->get('id');
		$view = $app->input->get('view');

		//retrieve task list from model
		$model = new FAQModelCategory();

		$this->category = $model->getCategory($id,$view,FALSE);
		//display
		echo $this->category;
	}
}