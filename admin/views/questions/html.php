<?php defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

class FAQViewsQuestionsHtml extends JViewHtml
{

	function render()
	{
		$app = JFactory::getApplication();

		//retrieve list from model
		$questionsModel = new FAQModelsQuestions();

		$this->questions = $questionsModel->listItems();
		$this->published = $app->getUserStateFromRequest('faq.published', 'filter_published', '');
		$this->sortDirection = $app->getUserStateFromRequest('faq.sort_direction', 'sort_direction', '');
		$this->sortColumn = $app->getUserStateFromRequest('faq.sort_column', 'sort_column', '');
		$app->setUserState('filter.published', $this->published);
		$app->setUserState('faq.sort_direction', $this->sortDirection);
		$app->setUserState('faq.sort_column', $this->sortColumn);
		$this->_sectionsListView = FAQHelpersView::load('questions','','html');

		JHtmlSidebar::setAction('index.php?option=com_faq&view=categories');
		JHtmlSidebar::addEntry(JText::_('COM_FAQ_CATEGORIES_MENU_POINT'), 'index.php?option=com_faq&view=categories');
		JHtmlSidebar::addEntry(JText::_('COM_FAQ_SECTIONS_MENU_POINT'), 'index.php?option=com_faq&view=sections');
		JHtmlSidebar::addEntry(JText::_('COM_FAQ_QUESTIONS_MENU_POINT'), 'index.php?option=com_faq&view=questions', true);
		JHtmlSidebar::addEntry(JText::_('COM_FAQ_SETTINGS_MENU_POINT'), 'index.php?option=com_faq&view=settings');

		$this->sidebar = JHtmlSidebar::render();

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
			JToolbarHelper::title(JText::_('COM_FAQ_SECTIONS'));
			JToolbarHelper::addNew('question.add');
			JToolbarHelper::editList('question.edit');
			JToolbarHelper::deleteList('', 'question.delete');
		}
	}
}