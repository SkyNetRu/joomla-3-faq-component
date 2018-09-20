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
	var $_featured = null;
	var $_trash = null;
	var $_language = null;

	function __construct()
	{
		parent::__construct();
		$app = JFactory::getApplication();
		$this->_section_id  = $app->input->get('section_id',null);
		$this->_category_id = $app->input->get('category_id',null);
		$this->_published   = $app->input->get('published',1);
		$this->_featured    = $app->input->get('featured',null);
		$this->_language    = $app->input->get('language',null);
	}

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

	/**
	 * Get the list of categories.
	 *
	 * @return  array.
	 *
	 */
	function listItems()
	{
		$sectionModel = new FAQModelsSection();
		$categories = parent::listItems();

		foreach ($categories as $key => $category) {
			$sectionModel->_category_id = $category->id;
			$categories[$key]->questions = $sectionModel->listItems();
		}

		return $categories;
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

	function store()
	{

    }

	function getCategory()
	{

    }

	function getCategories()
	{

    }

	function populateState()
	{

    }
}