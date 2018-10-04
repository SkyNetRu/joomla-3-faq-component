<?php defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

class FAQViewsSectionHtml extends JViewHtml
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
		$categoriesModel = new FAQModelsCategories();
		$categories = $categoriesModel->listItems();
		$categories_options[] = JHTML::_('select.option', 0, JText::_('FAQ_SELECT_CATEGORY'));
		foreach ($categories as $category){
			$categories_options[] = JHTML::_('select.option', $category->id, $category->name);
		}


		$pathToMyXMLFile = JPATH_COMPONENT_ADMINISTRATOR.'/models/forms/section.xml';
		$this->form = &JForm::getInstance('form', $pathToMyXMLFile);
		$this->task = 'section.store';
		$this->section_id = $app->input->get('sid', null);
		if ($this->section_id) {
			$sectionModel = new FAQModelsSection();
			$sectionModel->_section_id = $this->section_id;
			$this->section = $sectionModel->getItem();
			foreach ($this->section as $key => $value) {
				$this->form->setValue($key, '', $value);
			}
		}
		$this->categories = JHTML::_('select.genericlist', $categories_options, 'category_id', '', 'value', 'text', $this->section_id ? $this->section->category_id : null );
		$this->published = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', 1);
		$this->featured = JHTML::_('select.booleanlist', 'featured', 'class="inputbox"', 0);
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
			JToolbarHelper::title(JText::_('FAQ_ADD_SECTION'));
			JToolBarHelper::apply('section.save');
			JToolBarHelper::save('section.save_and_close');
			JToolBarHelper::cancel('section.cancel');

		}
	}
}