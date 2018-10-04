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
		$pathToMyXMLFile = JPATH_COMPONENT_ADMINISTRATOR.'/models/forms/category.xml';
		$this->form = &JForm::getInstance('form', $pathToMyXMLFile);
		$this->task = 'category.store';
		$this->category_id = $app->input->get('cid', null);
		if ($this->category_id) {
			$categoryModel = new FAQModelsCategory();
			$categoryModel->_category_id = $this->category_id;
			$this->category = $categoryModel->getItem();
			foreach ($this->category as $key => $value) {
				$this->form->setValue($key, '', $value);
			}
		}
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
			JToolbarHelper::title(JText::_('FAQ_ADD_CATEGORY'));
			JToolBarHelper::apply('category.save');
			JToolBarHelper::save('category.save_and_close');
			JToolBarHelper::cancel('category.cancel');

		}
	}
}