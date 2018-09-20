<a href="/<?php echo JRoute::_('index.php?option=com_faq&view=category&layout=list'); ?>"><i></i> <?php echo JText::_('COM_FAQ_BACK'); ?></a>
<h2><?php echo $this->category->name; ?></h2>
<div>
	<div>
		<dl>
			<dt><?php echo JText::_('COM_FAQ_CATEGORY_NAME'); ?></dt>
			<dd><?php echo $this->category->name; ?></dd>
		</dl>
	</div>
</div>
<br />
<!--<div>-->
<!--	<div>-->
<!--		<ul>-->
<!--			<li><a href="#libraryTab" data-toggle="tab">--><?php //echo JText::_('COM_LENDR_LIBRARY'); ?><!--</a></li>-->
<!--			<li><a href="#wishlistTab" data-toggle="tab">--><?php //echo JText::_('COM_LENDR_WISHLIST'); ?><!--</a></li>-->
<!--			<li><a href="#waitlistTab" data-toggle="tab">--><?php //echo JText::_('COM_LENDR_WAITLIST'); ?><!--</a></li>-->
<!--		</ul>-->
<!--		<div>-->
<!--			<div id="libraryTab">-->
<!--				--><?php //if($this->profile->isMine) { ?>
<!--					<a href="#newBookModal" role="button" data-toggle="modal"><i></i> --><?php //echo JText::_('COM_LENDR_ADD_BOOK'); ?><!--</a>-->
<!--				--><?php //} ?>
<!--				<h2>--><?php //echo JText::_('COM_LENDR_LIBRARY'); ?><!--</h2>-->
<!--				--><?php //echo $this->_libraryView->render(); ?>
<!--			</div>-->
<!--			<div id="wishlistTab">-->
<!--				<h2>--><?php //echo JText::_('COM_LENDR_WISHLIST'); ?><!--</h2>-->
<!--			</div>-->
<!--			<div id="waitlistTab">-->
<!--				<h2>--><?php //echo JText::_('COM_LENDR_WAITLIST'); ?><!--</h2>-->
<!--				--><?php //echo $this->_waitlistView->render(); ?>
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->

<?php echo $this->_addCategoryView->render(); ?>