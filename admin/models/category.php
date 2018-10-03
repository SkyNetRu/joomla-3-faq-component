<?php

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class FAQModelsCategory extends FAQModelsDefault
{
	/**
	 * Protected fields
	 *
	 */
	var $_category_id = null;
	var $_published = 1;
	var $_trash = null;
	var $_featured = null;
	var $_language = null;

	/**
	 * Get the category.
	 *
	 * @return  object.
	 *
	 */
	function getItem()
	{
		$category = parent::getItem();

		$sectionModel = new FAQModelsSection();
		$sectionModel->set('_category_id',$this->_category_id);
		$category->sections = $sectionModel->listItems();

		return $category;
	}

	public function updateCategory ($input = null) {
		$category = (object) $input;
		if (!$category->alias) {
			$category->alias = str_replace(' ', '_', preg_replace('/[^ a-zа-яё\d]/ui', '',strtolower($category->name)));
		}

		return JFactory::getDbo()->updateObject('#__faq_categories', $category, 'id');
	}

	public function addCategory ($input = null) {
		$category = (object) $input;
		unset($category->id);
		if (!$category->alias) {
			$category->alias = str_replace(' ', '_', preg_replace('/[^ a-zа-яё\d]/ui', '',strtolower($category->name)));
		}

		$category->ordering = $this->getNextOrder('trash=0', 'faq_categories');

		return JFactory::getDbo()->insertObject('#__faq_categories', $category);
	}

	/**
	 * Builds the query to be used by the book model
	 * @return object Query object
	 *
	 */
	protected function _buildQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(TRUE);

		$query->select('c.*');
		$query->from('#__faq_categories as c');

		return $query;
	}

	/**
	 * Builds the filter for the query
	 * @param object Query object
	 * @return object Query object
	 *
	 */
	protected function _buildWhere(&$query)
	{

		if(is_numeric($this->_category_id))
		{
			$query->where('c.id = ' . (int) $this->_category_id);
		}

		if(is_numeric($this->_trash))
		{
			$query->where('c.published = ' . (int) $this->_trash);
		}

		if(is_numeric($this->_featured))
		{
			$query->where('c.featured = ' . (int) $this->_featured);
		}

		if(is_numeric($this->_language))
		{
			$query->where('c.language = ' . (int) $this->_language);
		}

		$query->where('c.published = ' . (int) $this->_published);

		return $query;
	}

}