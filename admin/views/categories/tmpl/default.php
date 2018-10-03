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
		<?php
		if (!empty($this->sidebar)) { ?>
        <div id="j-sidebar-container" class="span2">
			<?php echo $this->sidebar; ?>
        </div>
        <div id="j-main-container" class="span10">
			<?php } else { ?>
            <div id="j-main-container" class="span12">
				<?php } ?>
                <div class="table-responsive-wrap">
                    <div class="table-responsive">
                        <form action="index.php?option=com_faq&view=categories" method="post" id="adminForm" name="adminForm">
                            <table class="adminlist table table-striped" id="FAQCategoriesList">
                                <thead>
                                <tr>
                                    <th width="1%" class="center hidden-phone">
										<?php echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'c.ordering', @$this->lists['order_Dir'], @$this->lists['order'], null, 'asc', 'FAQ_ORDER'); ?>
                                    </th>
                                    <th width="1%">
                                        <input id="jToggler" type="checkbox" name="toggle" value=""/>
                                    </th>
                                    <th>
										<?php echo JHTML::_('grid.sort', 'FAQ_TITLE', 'c.name', @$this->lists['order_Dir'], @$this->lists['order']); ?>
                                    </th>
                                    <th>
										<?php echo JHTML::_('grid.sort', 'FAQ_ORDER', 'c.ordering', $this->sortDirection, $this->sortColumn); ?><?php echo $this->ordering ? JHTML::_('grid.order', $this->rows, 'filesave.png') : ''; ?>
                                    </th>
                                    <th class="">
										<?php echo JHTML::_('grid.sort', 'FAQ_PUBLISHED', 'c.published', @$this->lists['order_Dir'], @$this->lists['order']); ?>
                                    </th>
                                    <th class="">
										<?php echo JHTML::_('grid.sort', 'FAQ_FEATURED', 'c.featured', @$this->lists['order_Dir'], @$this->lists['order']); ?>
                                    </th>
                                    <th class="hidden-phone"> <?php echo JHTML::_('grid.sort', 'FAQ_LANGUAGE', 'c.language', @$this->lists['order_Dir'], @$this->lists['order']); ?> </th>
                                    <th class="hidden-phone center">
										<?php echo JHTML::_('grid.sort', 'FAQ_ID', 'c.id', @$this->lists['order_Dir'], @$this->lists['order']); ?>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
								<?php foreach (@$this->categories as $key => $category) { ?>
                                    <tr>
                                        <td>
                                            <span class="sortable-handler   rel="tooltip"><i class="icon-menu"></i></span>
                                            <input type="text" style="display:none"  name="order[]" size="5" value="<?php echo $category->ordering;?>" class="width-20 text-area-order " />
                                        </td>
                                        <td>
											<?php echo @JHTML::_('grid.checkedout', $category, $key );?>
                                        </td>
                                        <td>
                                            <a href="<?php echo JRoute::_('index.php?option=com_faq&view=category&task=category.edit&cid='.$category->id); ?>">
                                                <?php echo $category->name; ?>
                                            </a>

                                        </td>
                                        <td>
											<?php echo $category->ordering; ?>
                                        </td>
                                        <td>
											<?php echo $category->published; ?>
                                        </td>
                                        <td>
											<?php echo $category->featured; ?>
                                        </td>
                                        <td>
											<?php echo $category->language; ?>
                                        </td>
                                        <td>
											<?php echo $category->id; ?>
                                        </td>
                                    </tr>
								<?php } ?>

                                </tbody>
                            </table>
                            <input type="hidden" name="task" value=""/>
                            <input type="hidden" name="boxchecked" value="0"/>
							<?php echo JHtml::_('form.token'); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>