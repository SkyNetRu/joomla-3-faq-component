<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class FAQHelpersView
{
	function load($viewName, $layoutName='default', $viewFormat='html', $vars=null)
	{
		// Get the application
		$app = JFactory::getApplication();

		$app->input->set('view', $viewName);

		// Register the layout paths for the view
		$paths = new SplPriorityQueue;
		$paths->insert(JPATH_COMPONENT . '/views/' . $viewName . '/tmpl', 'normal');
		$viewClass = 'FAQViews' . ucfirst($viewName) . ucfirst($viewFormat);
		$modelClass = 'FAQModels' . ucfirst($viewName);

		if (false === class_exists($modelClass))
		{
			$modelClass = 'FAQModelsDefault';
		}

		$view = new $viewClass(new $modelClass, $paths);

		$view->setLayout($layoutName);
		if(isset($vars))
		{
			foreach($vars as $varName => $var)
			{
				$view->$varName = $var;
			}
		}

		return $view;
	}
}