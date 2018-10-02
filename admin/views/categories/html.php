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
		$layout = $app->input->get('layout', 'categories');

		//retrieve task list from model
		$categoryModel = new FAQModelsCategories();

		switch($layout) {

			case "category":
				$this->category = $categoryModel->getItem();
				$this->_addCategoryView = FAQHelpersView::load('category','_add','html');
				break;

			case "categories":
				$this->categories = $categoryModel->listItems();
				$this->published = $app->getUserStateFromRequest('faq.published', 'filter_published', '');
				$this->sortDirection = $app->getUserStateFromRequest('faq.sort_direction', 'sort_direction', '');
				$this->sortColumn = $app->getUserStateFromRequest('faq.sort_column', 'sort_column', '');
				$app->setUserState('filter.published', $this->published);
				$app->setUserState('faq.sort_direction', $this->sortDirection);
				$app->setUserState('faq.sort_column', $this->sortColumn);
				$this->_categoriesListView = FAQHelpersView::load('categories','_entry','html');
				break;
			default:
				$this->categories = $categoryModel->listItems();
				$this->_categoriesListView = FAQHelpersView::load('categories','_entry','html');
				break;
		}

		//retrieve categories list from model
//		$model = new FAQModelsCategories();
//		$this->categories = $model->listItems();
		JHtmlSidebar::setAction('index.php?option=com_falang&view=categories');

		JHtmlSidebar::addEntry(JText::_('COM_FAQ_CATEGORIES_MENU_POINT'), 'index.php?option=com_falang&view=categories', true);
		JHtmlSidebar::addEntry(JText::_('COM_FAQ_SECTIONS_MENU_POINT'), 'index.php?option=com_falang&view=sections');
		JHtmlSidebar::addEntry(JText::_('COM_FAQ_QUESTIONS_MENU_POINT'), 'index.php?option=com_falang&view=questions');
		JHtmlSidebar::addEntry(JText::_('COM_FAQ_SETTINGS_MENU_POINT'), 'index.php?option=com_falang&view=settings');

		$this->sidebar = JHtmlSidebar::render();

		$this->addToolbar();

		//display
		return parent::render();
	}

//	function display($tpl = null)
//	{
//		// Get data from the model
//		$this->items		= $this->get('Items');
//		$this->pagination	= $this->get('Pagination');
//
//		$app = JFactory::getApplication();
//		//$layout = $app->input->get('layout', 'categories');
//
//		//retrieve task list from model
//		$categoryModel = new FAQModelsCategories();
//
//		$this->categories = $categoryModel->listItems();
//		$this->published = $app->getUserStateFromRequest('faq.published', 'filter_published', '');
//		$this->sortDirection = $app->getUserStateFromRequest('faq.sort_direction', 'sort_direction', '');
//		$this->sortColumn = $app->getUserStateFromRequest('faq.sort_column', 'sort_column', '');
//		$app->setUserState('filter.published', $this->published);
//		$app->setUserState('faq.sort_direction', $this->sortDirection);
//		$app->setUserState('faq.sort_column', $this->sortColumn);
//		$this->_categoriesListView = FAQHelpersView::load('categories','_entry','html');
//
//		// Check for errors.
//		if (count($errors = $this->get('Errors')))
//		{
//			JError::raiseError(500, implode('<br />', $errors));
//
//			return false;
//		}
//
//		JHtmlSidebar::setAction('index.php?option=com_falang&view=categories');
//
//		JHtmlSidebar::addEntry(JText::_('COM_FAQ_CATEGORIES_MENU_POINT'), 'index.php?option=com_falang&view=categories', true);
//		JHtmlSidebar::addEntry(JText::_('COM_FAQ_SECTIONS_MENU_POINT'), 'index.php?option=com_falang&view=sections');
//		JHtmlSidebar::addEntry(JText::_('COM_FAQ_QUESTIONS_MENU_POINT'), 'index.php?option=com_falang&view=questions');
//		JHtmlSidebar::addEntry(JText::_('COM_FAQ_SETTINGS_MENU_POINT'), 'index.php?option=com_falang&view=settings');
//
//		$this->sidebar = JHtmlSidebar::render();
//
//		$this->addToolbar();
//
//		// Display the template
//		parent::display($tpl);
//	}

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
			JToolbarHelper::title(JText::_('COM_FAQ_CATEGORIES'));
			JToolbarHelper::addNew('category.add');
			JToolbarHelper::editList('category.edit');
			JToolbarHelper::deleteList('', 'categories.delete');
		}
	}
}