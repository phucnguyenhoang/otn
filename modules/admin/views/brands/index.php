<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong><?php echo $lang_list_title; ?></strong>
            </div>
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover data-tables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo $lang_name; ?></th>
                                <th><?php echo $lang_description; ?></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($brands)): ?>
                                <?php foreach ($brands as $order => $brand) : ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo($order + 1); ?></td>
                                        <td><?php echo $brand->name; ?></td>
                                        <td><?php echo $brand->description; ?></td>
                                        <td class="center">4</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>