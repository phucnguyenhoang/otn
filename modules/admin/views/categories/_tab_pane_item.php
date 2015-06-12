<div role="tabpanel" class="tab-pane <?php echo $key == 1 ? "active" : ""; ?>" id="<?php echo $alias ?>-lang">
	<?php echo modules::load('admin/categories')->render_general_form($alias); ?>
</div>