<?php defined( '_JEXEC' ) or die( 'Restricted access' );

class FAQViewsCategoryHtml extends JViewHtml
{
	function render()
	{
		$app = JFactory::getApplication();
		$type = $app->input->get('type');
		$id = $app->input->get('id');
		$view = $app->input->get('view');

		//retrieve task list from model
		$model = new FAQModelCategory();

		$this->category = $model->getCategory($id,$view,FALSE);
		//display
		return parent::render();
	}
}