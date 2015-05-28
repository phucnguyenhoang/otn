<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url('resources/js/jquery-2.1.3.min.js'); ?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>

<script src="<?php echo base_url('resources/js/main.js'); ?>"></script>
<?php if (!empty($res_js)) : ?>
    <?php foreach ($res_js as $js) : ?>
        <script src="<?php echo base_url('resources/js/'.$js.'.js'); ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>