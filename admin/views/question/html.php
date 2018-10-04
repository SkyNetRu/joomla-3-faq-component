<?php defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

class FAQViewsQuestionHtml extends JViewHtml
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
		$sectionsModel = new FAQModelsSections();
		$sections = $sectionsModel->listItems();
		$sections_options[] = JHTML::_('select.option', 0, JText::_('FAQ_SELECT_SECTION'));
		foreach ($sections as $section){
			$sections_options[] = JHTML::_('select.option', $section->id, $section->name);
		}


		$pathToMyXMLFile = JPATH_COMPONENT_ADMINISTRATOR.'/models/forms/question.xml';
		$this->form = &JForm::getInstance('form', $pathToMyXMLFile);
		$this->task = 'question.store';
		$this->question_id = $app->input->get('qid', null);
		if ($this->question_id) {
			$questionModel = new FAQModelsQuestion();
			$questionModel->_question_id = $this->question_id;
			$this->question = $questionModel->getItem();
			foreach ($this->question as $key => $value) {
				$this->form->setValue($key, '', $value);
			}
		}
		$this->sections = JHTML::_('select.genericlist', $sections_options, 'section_id', '', 'value', 'text', $this->question_id ? $this->question->section_id : null );
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
			JToolbarHelper::title(JText::_('FAQ_ADD_QUESTION'));
			JToolBarHelper::apply('question.save');
			JToolBarHelper::save('question.save_and_close');
			JToolBarHelper::cancel('question.cancel');

		}
	}
}