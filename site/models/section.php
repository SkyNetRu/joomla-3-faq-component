<?php

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class FAQModelsSection extends FAQModelsDefault
{

	/**
	 * Protected fields
	 *
	 */
	var $_section_id = null;
	var $_category_id = null;
	var $_published = 1;
	var $_featured = null;
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
	 * Get the section.
	 *
	 * @return  object.
	 *
	 */
	function getItem()
	{
		$section = parent::getItem();

		$questionsModel = new FAQModelsQuestions();
		$questionsModel->set('_section_id',$this->_section_id);
		$section->questions = $questionsModel->listItems();

		return $section;
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

	protected function _buildQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(TRUE);

		$query->select("s.name, s.alias, s.description");
		$query->from("#__faq_sections as s");

		return $query;
	}

	protected function _buildWhere(&$query)
	{

		if(is_numeric($this->_category_id))
		{
			$query->where('s.category_id = ' . (int) $this->_category_id);
		}

		if(is_numeric($this->_featured))
		{
			$query->where('s.featured = ' . (int) $this->_featured);
		}

		if($this->_language !== null)
		{
			$query->where('s.language = ' . (STRING) $this->_language);
		}

		$query->where('s.published = '. (int) $this->_published);

		return $query;
	}
}