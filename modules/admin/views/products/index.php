<div class="row" id="brand_scope">
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
                                <th><?php echo $lang_image; ?></th>
                                <th><?php echo $lang_product_name; ?></th>
                                <th><?php echo $lang_price; ?></th>
                                <th><?php echo $lang_quantity; ?></th>
                                <th><?php echo $lang_status; ?></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($products)): ?>
                                <?php foreach ($products as $order => $product) : ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo($order + 1); ?></td>
                                        <td><?php echo $product->name; ?></td>
                                        <td><?php echo $product->description; ?></td>
                                        <td class="center">
                                            <a class="btn btn-xs btn-success" href="<?php echo base_url("admin/brands/edit/$product->_id"); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                                            <button class="btn btn-xs btn-danger btn-brand-del-record-model" 
                                                data-brand-name="<?php echo $product->name; ?>"
                                                data-brand-id="<?php echo $product->_id; ?>"
                                            ><i class="glyphicon glyphicon-trash"></i></button>
                                        </td>
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