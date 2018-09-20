<h2><?php echo JText::_('COM_FAQ_CATEGORIES'); ?></h2>
<div>
	<?php for($i=0, $n = count($this->categories);$i<$n;$i++) {
		$this->_profileListView->profile = $this->profiles[$i];
		echo $this->_profileListView->render();
	} ?>
	<?php foreach ($this->categories as $category) {
		$this->_categoryListView->category = $category;
		echo $this->_categoryListView->render();
	}?>
</div>