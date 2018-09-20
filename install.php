<?php

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */


defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.installer.installer');
jimport('joomla.installer.helper');

/**
 * Method to install the component
 *
 * @param mixed $parent The class calling this method
 * @return void
 */
function install($parent)
{
	echo JText::_('COM_FAQ_INSTALL_SUCCESSFULL');
}

/**
 * Method to update the component
 *
 * @param mixed $parent The class calling this method
 * @return void
 */
function update($parent)
{
	echo JText::_('COM_FAQ_UPDATE_SUCCESSFULL');
}