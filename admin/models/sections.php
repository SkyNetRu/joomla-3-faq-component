<?php

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class FAQModelsSections extends FAQModelsDefault
{
	/**
	 * Protected fields
	 *
	 */
	var $_section_ids = null;
	var $_category_id = null;
	var $_published = 1;
	var $_featured = null;
	var $_trash = null;
	var $_language = null;

	function __construct()
	{
		parent::__construct();
		$app = JFactory::getApplication();
		$this->_section_id  = $app->input->get('section_ids',null);
		$this->_category_id = $app->input->get('category_id',null);
		$this->_published   = $app->input->get('published',1);
		$this->_featured    = $app->input->get('featured',null);
		$this->_trash       = $app->input->get('trash',null);
		$this->_language    = $app->input->get('language',null);
	}

	/**
	 * Get the list of sections.
	 *
	 * @return  array.
	 *
	 */
	function listItems()
	{
		$questionsModel = new FAQModelsQuestions();
		$sections = parent::listItems();

		foreach ($sections as $key => $section) {
			$questionsModel->_section_id = $section->id;
			$sections[$key]->questions = $questionsModel->listItems();
		}

		return $sections;
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

		$query->select('s.*, c.name as category_name');
		$query->from('#__faq_sections as s');
		$query->join('LEFT', '#__faq_categories as c ON c.id = s.category_id');
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

		if(is_string($this->_category_ids))
		{
			$query->where('c.id IN ' . (string) $this->_category_ids);
		}
		else if (is_array($this->_category_ids))
		{
			$query->where('c.id IN ' . (string) implode ( ', ' , $this->_category_ids ));
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