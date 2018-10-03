<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_faq
 *
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * FAQ component helper.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_faq
 */
class FAQHelpersStyle
{
	function load()
	{
		JHtml::_('jquery.framework', true, true);
		$document = JFactory::getDocument();

		//stylesheets
		$document->addStylesheet(JURI::base().'components/com_faq/assets/css/faq.css');

		//j-avascripts
		$document->addScript(JURI::base().'components/com_faq/assets/js/faq.js');
	}
}