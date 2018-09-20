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
	var $_published = 1;
	var $_featured = null;
	var $_language = null;

	function __construct()
	{
		parent::__construct();
		$app = JFactory::getApplication();
		$this->_section_id = $app->input->get('section_id',null);
		$this->_language = $app->input->get('language',null);
		$this->_published = $app->input->get('published',1);
		$this->_featured = $app->input->get('featured',null);
	}

	/**
	 * Get the question.
	 *
	 * @return  object.
	 *
	 */
	function getItem()
	{
		$question = parent::getItem();
		return $question;
	}

	/**
	 * Get the list of questions.
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

		$query->select("q.question, q.answer");
		$query->from("#__faq_questions as q");

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

		if(is_numeric($this->_section_id))
		{
			$query->where('q.section_id = ' . (int) $this->_section_id);
		}

		if(is_numeric($this->_featured))
		{
			$query->where('q.featured = ' . (int) $this->_featured);
		}

		if($this->_language !== null)
		{
			$query->where('q.language = ' . (STRING) $this->_language);
		}


		$query->where('q.published = '. (int) $this->_published);

		return $query;
	}
}