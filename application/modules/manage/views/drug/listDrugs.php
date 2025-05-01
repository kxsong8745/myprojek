<?php 
    //$ENABLE_ADD     = has_permission('menu.Add');
    //$ENABLE_MANAGE  = has_permission('menu.Manage');
    //$ENABLE_DELETE  = has_permission('menu.Delete');
    $ENABLE_ADD  = TRUE;
    $ENABLE_MANAGE  = TRUE;
    $ENABLE_DELETE  = TRUE;

?>

<?= form_open($this->uri->uri_string(),array('id'=>'frm_menu','name'=>'frm_menu')) ?>	
<a class = "btn btn-primary" href="<?php echo module_url("drug/form_add")?>"> Add New Drug</a>
<div class="card">
	
    <div class="card-header">Drug List</div>
	
	<div class="card-body ">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th width="50">No.</th>
                    <th>Drug ID</th>
                    <th>Trade Name</th>
                    <th>Tenderer</th>
                    <th>Package Quantity</th>
                    <th>Total Price Package Quantity</th>
                    <th>Unit Per Package</th>
                    <th>Total Units</th>
                    <th>P/O No.</th>
                    <th>Price Per Unit</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php $i=0; foreach($data->result() as $row)  {?>

                <tr>
                    <td><?php echo ++$i?></td>
                    <td><?php echo $row->T01_DRUG_ID ?></td>
                    <td><?php echo $row->T01_DRUGNAME ?></td>
                    <td><?php echo $row->T01_BRAND ?></td>
                    <td><?php echo $row->T01_PRICEPERUNIT ?></td>
                    <td><?php echo $row->T01_QUANTITY ?></td>
                    <td><?php echo $row->T01_MFGDATE ?></td>
                    <td><?php echo $row->T01_EXPDATE ?></td>
                    <td><a class="btn btn-flat btn-warning" href="<?php echo site_url("manage/drug/form_edit/".$row->T01_DRUGID)?>">Edit</a></td>
                    <td><a class="btn btn-flat btn-danger" href="<?php echo site_url("manage/drug/delete/".$row->T01_DRUGID)?>">Delete</a></td>
                </tr>

            <?php } ?>                   
            </tbody>
        </table>

        <?php if(!$ENABLE_DELETE) { ?>
        <input type="button" name="delete1" class="btn btn-danger" id="delete-me" value="Delete" onclick="confirm_delete(this.form) ">
        <input type="hidden" name="delete" id="isdelete">
        <?php } ?>

    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
        <?php
        // echo $this->pagination->create_links(); 
        ?>
    </div>

</div><!-- /.box --> <?php form_close(); ?>

<script>
function confirm_delete(myform)
{
    if (confirm('<?= (lang('ccc_delete_confirm')); ?>'))
    {
        $("#isdelete").val(1);
        myform.submit();
    }

    return false;
}
</script>