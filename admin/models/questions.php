<?php

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class FAQModelsQuestions extends FAQModelsDefault
{
	/**
	 * Protected fields
	 *
	 */
	var $_section_id = null;
	var $_category_id = null;
	var $_question_ids = null;
	var $_published = 1;
	var $_featured = null;
	var $_trash = null;
	var $_language = null;

	function __construct()
	{
		parent::__construct();
		$app = JFactory::getApplication();
		$this->_section_id  = $app->input->get('section_id',null);
		$this->_category_id  = $app->input->get('category_id',null);
		$this->_question_ids = $app->input->get('question_ids',null);
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
		$questions = parent::listItems();

		return $questions;
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

		$query->select('q.*, s.name as section_name, c.name as category_name');
		$query->from('#__faq_questions as q');
		$query->join('LEFT', '#__faq_sections as s ON s.id = q.section_id');
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

		if(is_string($this->_question_ids))
		{
			$query->where('q.id IN ' . (string) $this->_question_ids);
		}
		else if (is_array($this->_category_ids))
		{
			$query->where('q.id IN ' . (string) implode ( ', ' , $this->_question_ids ));
		}

		if(is_numeric($this->_section_id ))
		{
			$query->where('s.id = ' . (int) $this->_section_id);
		}

		if(is_numeric($this->_category_id))
		{
			$query->where('c.id = ' . (int) $this->_category_id);
		}

		if(is_numeric($this->_trash))
		{
			$query->where('q.trash = ' . (int) $this->_trash);
		}

		if(is_numeric($this->_featured))
		{
			$query->where('q.featured = ' . (int) $this->_featured);
		}

		if(is_numeric($this->_language))
		{
			$query->where('q.language = ' . (int) $this->_language);
		}

		$query->where('q.published = ' . (int) $this->_published);

		return $query;
	}
}