<?php
$edit = access_check("customer", "edit");
$delete = access_check("customer", "delete");
$view = access_check("customer", "view");

foreach ($user_detail as $user_val) {
    ?>
    <div class="col-md-4 col-sm-4 col-xs-12 animated fadeInDown">
         
        <div class="well profile_view <?php echo ($customer_type != 1)?"unapproved":"";?>" data-id="<?php echo $user_val['user_id']?>">
            <div class="col-sm-12">
                <div class="left col-xs-7">
                    <h2><?= getUserName($user_val['user_id']); ?></h2>
                    <p><strong><i class="fa fa-group"></i>  Organisation: </strong><?php $org = getUserOrginasationDetails($user_val['user_id']);
    echo $org['organisation_name']; ?></p>
                    <ul class="list-unstyled">

                        <li><i class="fa fa-envelope"></i> Email: <?= ($user_val['user_email']); ?></li>


                        <?php if ($user_val['user_phone'] != '') { ?>
                            <li><i class="fa fa-phone"></i> Phone: <?= ucfirst($user_val['user_phone']); ?></li>
    <?php } ?>

                    </ul>
                </div>
                <div class="right col-xs-5 text-center">
                    <img src="<?php echo base_url() . getUserImage($user_val['user_id'], 'small'); ?>" alt="" class="img-circle img-responsive">
                </div>
            </div>
            <div class="col-xs-12 bottom text-right">
                <div class="col-xs-12 col-sm-12 emphasis">

                </div>
                <div class="col-xs-12 col-sm-12 emphasis">
                    <?php
                    if ($view) {
                        if ($customer_type == 1) {
                            ?>
                            <a href="<?php echo base_url() . 'customer/show/' . $user_val['user_id']; ?>" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="View customer"> <i class="fa fa-user">
                                </i>&nbsp; View</a>
                        <?php } 
                        
                        else { ?>
                    <a href="javascript:void(0)" id="<?= $user_val['user_id']; ?>" type="button" class="btn btn-success btn-xs approve" data-toggle="tooltip" data-placement="left" title="Approve customer"><i class="glyphicon glyphicon-ok"></i>&nbsp; Approve</a>
                            <?php
                        }
                    }



                    if ($edit):
                        if ($customer_type == 1) {
                            ?>
                            <a href="<?php echo base_url() . 'customer/edit/' . $user_val['user_id']; ?>" type="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="bottom" title="Edit customer"> <i class="fa fa-edit"></i>&nbsp; Edit</a><?php 
                            
                        } endif;


        if ($delete):
                        ?>
                        <a href="javascript:void(0)" id="<?= $user_val['user_id']; ?>" type="button" class="btn btn-danger btn-xs delete" data-toggle="tooltip" data-placement="bottom" title="Delete customer"> <i class="fa fa-trash-o">
                            </i>&nbsp; Delete </a>
    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<input type='hidden' id='count' value='<?php echo $count; ?>'> 

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
}); 

    
</script>
