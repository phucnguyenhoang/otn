<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $this->lang->line('add_title'); ?></h3>
    </div>
    <div class="panel-body">
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
                <li role="presentation"><a href="#data" aria-controls="data" role="tab" data-toggle="tab">Data</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- general -->
                <div role="tabpanel" class="tab-pane active" id="general">
                    <?php echo modules::load('admin/categories')->render_tab(array()); ?>
                </div>
                <!-- data -->
                <div role="tabpanel" class="tab-pane" id="data">
                    <?php // var_dump($this->language->getLang()); ?>
                </div>
            </div>
        </div>
    </div>
</div>