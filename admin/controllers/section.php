<?php

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class FAQControllersSection extends FAQControllersDefault
{

	public function add()
	{
		$app = JFactory::getApplication();
		$app->input->set('layout','edit');
		$app->input->set('view', 'section');
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
			'alias' => 'string',
			'published' => 'bool',
			'featured' => 'bool',
			'language' => 'string',
			'description' => 'string',
			'category_id' => 'int'
		));

		$sectionModel = new FAQModelsSection();
		if ($input_values['id'] > 0){
			if ($sectionModel->updateSection($input_values)){
				$app->enqueueMessage(JText::_('FAQ_SECTION_UPDATED'), 'success');
			}
		} else {
			if ($sectionModel->addSection($input_values)){
				$app->enqueueMessage(JText::_('FAQ_SECTION_ADDED'), 'success');
			}
		}

		$app->redirect(JRoute::_('index.php?option=com_faq&view=sections', false));
	}

	public function save_and_close ()
	{
		$this->save();
	}

	public function cancel ()
	{
		$app = JFactory::getApplication();
		$app->redirect(JRoute::_('index.php?option=com_faq&view=sections', false));
	}
}