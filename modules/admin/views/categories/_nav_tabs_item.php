<li role="presentation" class="<?php echo $key == 1 ? "active" : ""; ?>">
	<a href="#<?php echo $alias; ?>-lang" aria-controls="<?php echo $alias; ?>-lang" role="tab" data-toggle="tab">
		<img src="<?php echo $this->language->getFlag($alias); ?>" title="<?php echo $name; ?>">
		<?php echo $name; ?>
	</a>
</li>