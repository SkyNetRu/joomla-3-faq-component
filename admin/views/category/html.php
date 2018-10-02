<?php defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

class FAQViewsCategoryHtml extends JViewHtml
{

	/**
	 * View form
	 *
	 * @var         form
	 */
	protected $form = null;




	function render()
	{
		$app = JFactory::getApplication();
		$layout = $app->input->get('layout', 'edit');

		//retrieve task list from model
//		$categoryModelForm = new FAQModelsCategoryform();
//		$categoryModel = new FAQModelsCategory();

		// Get the Data
//		$this->form = $categoryModelForm->getForm();
//		$this->category = $categoryModel->getItem();

		//$this->form = $this->get('Form');
		//$this->category = $categoryModel->getItem();



//		JHtmlSidebar::setAction('index.php?option=com_falang&view=categories');
//
//		JHtmlSidebar::addEntry(JText::_('COM_FAQ_CATEGORIES_MENU_POINT'), 'index.php?option=com_falang&view=categories', true);
//		JHtmlSidebar::addEntry(JText::_('COM_FAQ_SECTIONS_MENU_POINT'), 'index.php?option=com_falang&view=sections');
//		JHtmlSidebar::addEntry(JText::_('COM_FAQ_QUESTIONS_MENU_POINT'), 'index.php?option=com_falang&view=questions');
//		JHtmlSidebar::addEntry(JText::_('COM_FAQ_SETTINGS_MENU_POINT'), 'index.php?option=com_falang&view=settings');
//
//		$this->sidebar = JHtmlSidebar::render();

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

		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_faq');
			JToolbarHelper::title(JText::_('COM_FAQ_CATEGORY'));
			JToolBarHelper::apply();
			JToolBarHelper::save();
			JToolBarHelper::cancel();

		}
	}
}