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
		$questions = $questionsModel->listItems();
		if ($questions){
			$section->questions = $questions;
		}

		return $section;
	}

	public function updateSection ($input = null)
	{
		$section = (object) $input;
		if (!$section->alias) {
			$section->alias = str_replace(' ', '_', preg_replace('/[^ a-zа-яё\d]/ui', '',strtolower($section->name)));
		}

		return JFactory::getDbo()->updateObject('#__faq_sections', $section, 'id');
	}

	public function addSection ($input = null)
	{
		$section = (object) $input;
		unset($section->id);
		if (!$section->alias) {
			$section->alias = str_replace(' ', '_', preg_replace('/[^ a-zа-яё\d]/ui', '',strtolower($section->name)));
		}

		$section->ordering = $this->getNextOrder('trash=0', 'faq_sections');

		return JFactory::getDbo()->insertObject('#__faq_sections', $section);
	}



	protected function _buildQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(TRUE);

		$query->select('s.*, c.name as category_name');
		$query->from('#__faq_sections as s');
		$query->join('LEFT', '#__faq_categories as c ON c.id = s.category_id');

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