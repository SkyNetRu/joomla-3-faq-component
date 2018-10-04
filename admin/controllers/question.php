<?php

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class FAQControllersQuestion extends FAQControllersDefault
{

	public function add()
	{
		$app = JFactory::getApplication();
		$app->input->set('layout','edit');
		$app->input->set('view', 'question');
		//display view
		return parent::execute();
	}

	public function edit ()
	{
		$this->add();
	}

	public function save ()
	{
		$jinput = JFactory::getApplication()->input;
		$app = JFactory::getApplication();
		$input_values = $jinput->getArray(array(
			'id' => 'int',
			'name' => 'string',
			'published' => 'bool',
			'featured' => 'bool',
			'language' => 'string',
			'question' => 'string',
			'answer' => 'string',
			'section_id' => 'int'
		));

		$questionModel = new FAQModelsQuestion();
		if ($input_values['id'] > 0){
			if ($questionModel->updateQuestion($input_values)){
				$app->enqueueMessage(JText::_('FAQ_QUESTION_UPDATED'), 'success');
			}
		} else {
			if ($questionModel->addQuestion($input_values)){
				$app->enqueueMessage(JText::_('FAQ_QUESTION_ADDED'), 'success');
			}
		}

		$app->redirect(JRoute::_('index.php?option=com_faq&view=questions', false));
	}

	public function save_and_close ()
	{
		$this->save();
	}

	public function cancel ()
	{
		$app = JFactory::getApplication();
		$app->redirect(JRoute::_('index.php?option=com_faq&view=questions', false));
	}
}