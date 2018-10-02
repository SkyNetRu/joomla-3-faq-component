<?php

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class FAQControllersDefault extends JControllerBase
{
	protected $default_view = 'categories';

	public function execute()
	{
		// Get the application
		$app = $this->getApplication();

		// Get the document object.
		$document     = JFactory::getDocument();

		$viewName     = $app->input->getWord('view', $this->default_view);
		$viewFormat   = $document->getType();
		$layoutName   = $app->input->getWord('layout', 'default');
		$app->input->set('view', $viewName);

		// Register the layout paths for the view
		$paths = new SplPriorityQueue;
		$paths->insert(JPATH_COMPONENT . '/views/' . $viewName . '/tmpl', 'normal');

		$viewClass  = 'FAQViews' . ucfirst($viewName) . ucfirst($viewFormat);
		$modelClass = 'FAQModels' . ucfirst($viewName);
		$view = new $viewClass(new $modelClass, $paths);
		$view->setLayout($layoutName);

		// Render our view.
		echo $view->render();

		return true;
	}
}