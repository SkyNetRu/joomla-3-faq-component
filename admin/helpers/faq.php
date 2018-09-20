<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_faq
 *
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */
defined('_JEXEC') or die;
/**
 * FAQ component helper.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_faq
 */
class FAQHelpersFAQ
{
	public static $extension = 'com_faq';

	/**
	 * @return  JObject
	 */
	public static function getActions()
	{
		$user = JFactory::getUser();
		$result = new JObject;
		$assetName = 'com_faq';
		$level = 'component';
		$actions = JAccess::getActions('com_faq', $level);

		foreach ($actions as $action)
		{
			$result->set($action->name, $user->authorise($action->name, $assetName));
		}

		return $result;
	}
}