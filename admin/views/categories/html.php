<?php defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

class FAQViewsCategoriesHtml extends JViewHtml
{
	function render()
	{
		$app = JFactory::getApplication();

		//retrieve categories list from model
		$model = new FAQModelsCategory();
		$this->categories = $model->listItems();
		$this->addToolbar();

		//display
		return parent::render();
	}
	/**
	 * Add the page title and toolbar.
	 *
	 */
	protected function addToolbar()
	{
		$canDo  = FAQHelpersFAQ::getActions();
		// Get the toolbar object instance

		$bar = JToolBar::getInstance('toolbar');
		JToolbarHelper::title(JText::_('COM_FAQ_CATEGORIES'));

		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_faq');
		}
	}
}