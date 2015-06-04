        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url('resources/js/jquery-2.1.3.min.js'); ?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('modules/admin/resources/bower_components/metisMenu/dist/metisMenu.min.js'); ?>"></script>
<?php if (!empty($js)): ?>
    <?php foreach ($js as $jsPath): ?>
        <script src="<?php echo base_url('modules/admin/resources/'.$jsPath); ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
<script src="<?php echo base_url('modules/admin/resources/js/sb-admin-2.js'); ?>"></script>
<script src="<?php echo base_url('modules/admin/resources/js/main.js'); ?>"></script>
</body>
</html>