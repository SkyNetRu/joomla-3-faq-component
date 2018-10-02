<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_faq
 *
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<div class="container-fluid">
    <div class="row-fluid">
        <form action="index.php" enctype="multipart/form-data" method="post" name="adminForm" id="adminForm" >
            <div class="form-horizontal">
                <fieldset class="adminform">
                    <legend><?php echo JText::_('FAQ_TITLE'); ?></legend>
                    <div class="row-fluid">
                        <div class="span6">
			                <?php foreach ($this->form->getFieldset() as $field): ?>
                                <div class="control-group">
                                    <div class="control-label"><?php echo $field->label; ?></div>
                                    <div class="controls"><?php echo $field->input; ?></div>
                                </div>
			                <?php endforeach; ?>
                        </div>
                    </div>
                </fieldset>
            </div>
            <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
            <input type="hidden" name="option" value="com_faq" />
            <input type="hidden" name="view" value="category" />
            <input type="hidden" name="task" value="<?php echo JRequest::getVar('task'); ?>" />
	        <?php echo JHTML::_('form.token'); ?>
        </form>
    </div>
</div>