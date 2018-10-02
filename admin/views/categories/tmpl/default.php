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
                                <th class="hidden-phone"> <?php echo JHTML::_('grid.sort', 'FAQ_LANGUAGE', 'c.language', @$this->lists['order_Dir'], @$this->lists['order']); ?> </th>
                                <th class="hidden-phone center">
									<?php echo JHTML::_('grid.sort', 'FAQ_ID', 'c.id', @$this->lists['order_Dir'], @$this->lists['order']); ?>
                                </th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <td colspan="12">
                                    <!--					--><?php //if(K2_JVERSION == '30'): ?>
                                    <!--                        <div class="k2LimitBox">-->
                                    <!--							--><?php //echo $this->page->getLimitBox(); ?>
                                    <!--                        </div>-->
                                    <!--					--><?php //endif; ?>
                                    <!--					--><?php //echo $this->page->getListFooter(); ?>
                                </td>
                            </tr>
                            </tfoot>
                            <tbody>
							<?php //var_dump(@$this->categories); ?>
                            <!--			--><?php //foreach ($this->rows as $key => $row) :	?>
                            <!--                <tr class="row--><?php //echo ($key%2); ?><!--" sortable-group-id="-->
							<?php //echo $row->parent; ?><!--">-->
                            <!---->
                            <!--					--><?php //if(K2_JVERSION == '30'): ?>
                            <!--                        <td class="order center hidden-phone">-->
                            <!--							--><?php //if($row->canChange): ?>
                            <!--                                <span class="sortable-handler -->
							<?php //echo ($this->ordering) ? '' : 'inactive tip-top' ;?><!--" title="-->
							<?php //echo ($this->ordering) ? '' :JText::_('JORDERINGDISABLED');?><!--" rel="tooltip"><i class="icon-menu"></i></span>-->
                            <!--                                <input type="text" style="display:none"  name="order[]" size="5" value="-->
							<?php //echo $row->ordering;?><!--" class="width-20 text-area-order " />-->
                            <!--							--><?php //else: ?>
                            <!--                                <span class="sortable-handler inactive" ><i class="icon-menu"></i></span>-->
                            <!--							--><?php //endif; ?>
                            <!--                        </td>-->
                            <!--					--><?php //else: ?>
                            <!--                        <td>--><?php //echo $key+1; ?><!--</td>-->
                            <!--					--><?php //endif; ?>
                            <!--                    <td class="k2Center center">-->
                            <!--						--><?php //if(!$this->filter_trash || $row->trash) { $row->checked_out = 0; echo @JHTML::_('grid.checkedout', $row, $key );}?>
                            <!--                    </td>-->
                            <!--                    <td>-->
                            <!--						--><?php //if ($this->filter_trash): ?>
                            <!--							--><?php //if ($row->trash): ?>
                            <!--                                <strong>--><?php //echo $row->treename; ?><!-- (-->
							<?php //echo $row->numOfTrashedItems; ?><!--)</strong>-->
                            <!--							--><?php //else: ?>
                            <!--								--><?php //echo $row->treename; ?><!-- (-->
							<?php //echo $row->numOfItems.' '.JText::_('K2_ACTIVE'); ?><!-- / -->
							<?php //echo $row->numOfTrashedItems.' '.JText::_('K2_TRASHED'); ?><!--)-->
                            <!--							--><?php //endif; ?>
                            <!--						--><?php //else: ?>
                            <!--                            <a href="-->
							<?php //echo JRoute::_('index.php?option=com_k2&view=category&cid='.$row->id); ?><!--">--><?php //echo $row->treename; ?>
                            <!--								--><?php //if($this->params->get('showItemsCounterAdmin')): ?>
                            <!--                                    <span class="small">-->
                            <!--							(-->
							<?php //echo $row->numOfItems.' '.JText::_('K2_ACTIVE'); ?><!-- / -->
							<?php //echo $row->numOfTrashedItems.' '.JText::_('K2_TRASHED'); ?><!--)-->
                            <!--							</span>-->
                            <!--								--><?php //endif; ?>
                            <!--                            </a>-->
                            <!--						--><?php //endif; ?>
                            <!--                    </td>-->
                            <!--					--><?php //if(K2_JVERSION != '30'): ?>
                            <!--                        <td class="order k2Order">-->
                            <!--                            <span>-->
							<?php //echo $this->page->orderUpIcon( $key, $row->parent == 0 || $row->parent == @$this->rows[$key-1]->parent, 'orderup', 'K2_MOVE_UP', $this->ordering); ?><!--</span> <span>-->
							<?php //echo $this->page->orderDownIcon( $key, count($this->rows), $row->parent == 0 || $row->parent == @$this->rows[$key+1]->parent, 'orderdown', 'K2_MOVE_DOWN', $this->ordering ); ?><!--</span>-->
                            <!--                            <input type="text" name="order[]" size="5" value="-->
							<?php //echo $row->ordering; ?><!--" -->
							<?php //echo ($this->ordering)?'':'disabled="disabled"'; ?><!-- class="text_area k2OrderBox" />-->
                            <!--                        </td>-->
                            <!--					--><?php //endif; ?>
                            <!--                    <td class="k2Center center hidden-phone">-->
                            <!--						--><?php //echo $row->inheritFrom; ?>
                            <!--                    </td>-->
                            <!--                    <td class="k2Center center hidden-phone">-->
                            <!--						--><?php //echo $row->extra_fields_group; ?>
                            <!--                    </td>-->
                            <!--                    <td class="k2Center center hidden-phone">-->
                            <!--						--><?php //echo $row->template; ?>
                            <!--                    </td>-->
                            <!--                    <td class="k2Center hidden-phone center">-->
                            <!--						--><?php //echo ($this->filter_trash || K2_JVERSION != '15')? $row->groupname:JHTML::_('grid.access', $row, $key ); ?>
                            <!--                    </td>-->
                            <!--                    <td class="k2Center center">-->
                            <!--						--><?php //echo $row->status; ?>
                            <!--                    </td>-->
                            <!--                    <td class="k2Center center hidden-phone">-->
                            <!--						--><?php //if($row->image): ?>
                            <!--                            <a href="-->
							<?php //echo JURI::root().'media/k2/categories/'.$row->image; ?><!--" class="modal">-->
                            <!--								--><?php //if (K2_JVERSION == '30') : ?>
                            <!--									--><?php //echo JText::_('K2_PREVIEW_IMAGE'); ?>
                            <!--								--><?php //else: ?>
                            <!--                                    <img src="templates/-->
							<?php //echo $this->template; ?><!--/images/menu/icon-16-media.png" alt="-->
							<?php //echo JText::_('K2_PREVIEW_IMAGE'); ?><!--" />-->
                            <!--								--><?php //endif; ?>
                            <!--                            </a>-->
                            <!--						--><?php //endif; ?>
                            <!--                    </td>-->
                            <!--					--><?php //if(isset($this->lists['language'])): ?>
                            <!--                        <td class="center hidden-phone">-->
							<?php //echo $row->language; ?><!--</td>-->
                            <!--					--><?php //endif; ?>
                            <!--                    <td class="k2Center center hidden-phone">-->
                            <!--						--><?php //echo $row->id; ?>
                            <!--                    </td>-->
                            <!--                </tr>-->
                            <!--			--><?php //endforeach; ?>
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