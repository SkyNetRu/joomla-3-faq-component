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
                    <legend><?php echo $this->section_id ? JText::_('FAQ_EDIT_SECTION'): JText::_('FAQ_ADD_SECTION'); ?></legend>
                    <div class="row-fluid">
                        <div class="span12">
			                <?php foreach ($this->form->getFieldset() as $field): ?>
				                <?php if ($field->name !== 'description'){ ?>
                                    <div class="control-group">
                                        <div class="control-label"><?php echo $field->label; ?></div>
                                        <div class="controls"><?php echo $field->input; ?></div>
                                    </div>
				                <?php } ?>
	                        <?php endforeach; ?>
                            <div class="control-group">
                                <div class="control-label">
                                    <label for="category_id"><?php echo JText::_('FAQ_CATEGORY'); ?></label>
                                </div>
                                <div class="controls">
                                    <?php echo $this->categories; ?>
                                </div>
                            </div>
                            <div class="FAQLabel">
                                <label for="published"><?php echo JText::_('FAQ_PUBLISHED'); ?></label>
                            </div>
                            <div class="FAQValue">
	                            <?php echo $this->published; ?>
                            </div>
                            <div class="FAQLabel">
                                <label for="featured"><?php echo JText::_('FAQ_FEATURED'); ?></label>
                            </div>
                            <div class="FAQValue">
		                        <?php echo $this->featured; ?>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><?php echo $this->form->getField('description')->label; ?></div>
                                <div class="controls"><?php echo $this->form->getField('description')->input; ?></div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <input type="hidden" name="id" value="<?php echo $this->section_id; ?>" />
            <input type="hidden" name="option" value="com_faq" />
            <input type="hidden" name="view" value="section" />
            <input type="hidden" name="task" value="<?php echo $this->task; ?>" />
	        <?php echo JHTML::_('form.token'); ?>
        </form>
    </div>
</div>