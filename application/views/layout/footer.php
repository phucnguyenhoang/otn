</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url('resources/js/jquery-2.1.3.min.js'); ?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>

<?php if (!empty($this->template->getJS())) : ?>
    <?php foreach ($this->template->getJS() as $js) : ?>
        <script src="<?php echo $js; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>