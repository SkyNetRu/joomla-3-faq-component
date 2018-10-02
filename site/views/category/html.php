<?php
/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class FAQViewsCategoryHtml extends JViewHtml
{
	function render()
	{
		$app = JFactory::getApplication();
		$layout = $app->input->get('layout');

		//retrieve task list from model
		$categoryModel = new FAQModelsCategory();

		switch($layout) {

			case "category":
				$this->category = $categoryModel->getItem();
				$this->_addCategoryView = FAQHelpersView::load('category','_add','phtml');
				break;

			case "list":
			default:
				$this->categories = $categoryModel->listItems();
				$this->_categoriesListView = FAQHelpersView::load('category','_entry','phtml');
				break;
		}

		//display
		return parent::render();
	}
}