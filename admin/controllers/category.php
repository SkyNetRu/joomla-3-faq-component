<?php

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class FAQControllersCategory extends FAQControllersDefault
{

	public function add()
	{
		$app = JFactory::getApplication();
		$app->input->set('layout','edit');
		$app->input->set('view', 'category');
		//display view
		return parent::execute();
	}

	public function edit ()
	{
		$app = JFactory::getApplication();
		$app->input->set('layout','edit');
		$app->input->set('view', 'category');
		//$app->input->set('cid', 'category');
		//display view
		return parent::execute();
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
			'description' => 'string'
		));

		$categoryModel = new FAQModelsCategory();
		if ($input_values['id'] > 0){
			if ($categoryModel->updateCategory($input_values)){
				$app->enqueueMessage('Category updated', 'success');
			}
		} else {
			if ($categoryModel->addCategory($input_values)){
				$app->enqueueMessage('Category added', 'success');
			}
		}

		$app->redirect(JRoute::_('index.php?option=com_faq&view=categories'));
	}

	public function save_and_close ()
	{
		$this->save();
	}

	public function cancel ()
	{
		$app = JFactory::getApplication();
		$app->redirect(JRoute::_('index.php?option=com_faq&view=categories'));
	}
}