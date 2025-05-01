<?php 
    $ENABLE_ADD  = TRUE;
    $ENABLE_MANAGE  = TRUE;
    $ENABLE_DELETE  = TRUE;
?>
<?= form_open($this->uri->uri_string(), array('id' => 'frm_menu', 'name' => 'frm_menu')) ?>
<a class="btn btn-primary" href="<?php echo module_url("drug/listDrugs") ?>">Back to Drug List</a>

<div class="card">
    <div class="card-header">
        Batch Details for Drug: <?php echo $data['drug']->T01_DRUGS ?> (<?php echo $data['drug']->T01_TRADE_NAME ?>)
    </div>
    
    <div class="card-body">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th width="50">No.</th>
                    <th>Batch Id</th>
                    <th>Tenderer</th>
                    <th>Package Quantity</th>
                    <th>Original Total Price (RM)</th>
                    <th>Unit per Package</th>
                    <th>Units Left</th>
                    <th>PO Number</th>
                    <th>Price per Unit (RM)</th>
                    <th>Manufactured Date</th>
                    <th>Expiry Date</th>
                    <th>Barcode</th>
                    <th>Actions</th> 
                </tr>
            </thead>
            <tbody>
            <?php $i = 0; foreach ($data['batches'] as $batch) { ?>
                <tr>
                    <td><?php echo ++$i ?></td>
                    <td><?php echo $batch->T02_BATCH_ID ?></td>
                    <td><?php echo $batch->T02_TENDERER ?></td>
                    <td><?php echo $batch->T02_PACKAGE_QUANTITY ?></td>
                    <td><?php echo $batch->T02_TP_PACKAGE_QUANTITY ?></td>
                    <td><?php echo $batch->T02_UNIT_PER_PACKAGE ?></td>
                    <td><?php echo $batch->T02_TOTAL_UNITS ?></td>
                    <td><?php echo $batch->T02_PO_NO ?></td>
                    <td><?php echo $batch->T02_PRICE_PER_UNIT ?></td>
                    <td><?php echo $batch->T02_MFD_DATE ?></td>
                    <td><?php echo $batch->T02_EXP_DATE ?></td>
                    <td><?php echo $batch->T02_BARCODE_NUM?></td>
                    <td>
                        <a class="btn btn-warning d-inline-block" href="<?php echo module_url('drug/formUpdateBatch/'.$batch->T02_BATCH_ID) ?>">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a class="btn btn-danger d-inline-block" href="<?php echo module_url('drug/deleteBatch/'.$batch->T02_BATCH_ID) ?>" onclick="return confirm('Are you sure you want to delete this batch?');">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>                   
            </tbody>
        </table>
    </div>

    <div class="box-footer clearfix">
        <?php // echo $this->pagination->create_links(); ?>
    </div>
</div>

<?php form_close(); ?>


