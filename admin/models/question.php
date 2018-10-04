<?php

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class FAQModelsQuestion extends FAQModelsDefault
{

	/**
	 * Protected fields
	 *
	 */
	var $_question_id = null;
	var $_published = 1;
	var $_featured = null;
	var $_trash = null;
	var $_language = null;

	function __construct()
	{
		parent::__construct();

		$app = JFactory::getApplication();
		$this->_question_id = $app->input->get('question_id',null);
		$this->_published   = $app->input->get('published',1);
		$this->_trash       = $app->input->get('trash',null);
		$this->_featured    = $app->input->get('featured',null);
		$this->_language    = $app->input->get('language',null);
	}

	/**
	 * Get the section.
	 *
	 * @return  object.
	 *
	 */
	function getItem()
	{
		$question = parent::getItem();

		return $question;
	}

	public function updateQuestion ($input = null)
	{
		$question = (object) $input;

		return JFactory::getDbo()->updateObject('#__faq_sections', $question, 'id');
	}

	public function addQuestion ($input = null)
	{
		$question = (object) $input;
		unset($question->id);

		$question->ordering = $this->getNextOrder('trash=0', 'faq_questions');

		return JFactory::getDbo()->insertObject('#__faq_questions', $question);
	}



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

	protected function _buildWhere(&$query)
	{

		if(is_numeric($this->_question_id))
		{
			$query->where('q.id = ' . (int) $this->_question_id);
		}

		if(is_numeric($this->_featured))
		{
			$query->where('q.featured = ' . (int) $this->_featured);
		}

		if(is_numeric($this->_trash))
		{
			$query->where('q.trash = ' . (int) $this->_trash);
		}

		if($this->_language !== null)
		{
			$query->where('q.language = ' . (STRING) $this->_language);
		}

		$query->where('s.published = '. (int) $this->_published);

		return $query;
	}
}