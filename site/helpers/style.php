<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class FAQHelpersStyle
{
	function load()
	{
		$document = JFactory::getDocument();

		//stylesheets
		$document->addStylesheet(JURI::base().'components/com_faq/assets/css/style.css');

		//javascripts
		$document->addScript(JURI::base().'components/com_faq/assets/js/faq.js');
	}
}