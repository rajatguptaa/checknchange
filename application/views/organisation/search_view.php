 <?php 
  $edit = access_check("employee","edit");
  $delete = access_check("employee","delete");
  $view = access_check("employee","view");
 
 foreach ($user_detail as $user_val) { if(getLoginUser()!=$user_val['user_id']) { ?>
                                    <div class="col-md-4 col-sm-4 col-xs-12 animated fadeInDown">
                                        <div class="well profile_view">
                                            <div class="col-sm-12">
                                                <div class="left col-xs-7">
                                                    <h2><?php echo  $user_val['amc_name'] ?></h2>
                                                   <p><strong> Amc Code: </strong><?php   echo $user_val['amc_code']; ?></p>
                                                   <p><strong> Amc Duration: </strong><?php   echo $user_val['amc_duration']; ?></p>
                                                    <ul class="list-unstyled">

                                                        <li> Amc Visit: <?= ($user_val['amc_visit']); ?></li>
                                                    </ul>
                                                </div>
                                                <div class="right col-xs-5 text-center">
                                                    <img src="<?php echo base_url(getAmcImage($user_val['id']),'small'); ?>" alt="" class="img-circle img-responsive">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 bottom text-right">
                                                <div class="col-xs-12 col-sm-12 emphasis">

                                                </div>
                                                <div class="col-xs-12 col-sm-12 emphasis">
                                                    <?php  if($view):?>
                                                    <a href="<?php echo base_url() . 'employee/show/' . $user_val['user_id']; ?>" data-toggle="tooltip" data-placement="bottom" title="View employee" type="button" class="btn btn-info btn-xs"> <i class="fa fa-user">
                                                        </i> View</a>
                                                    <?php endif;
                                                    
                                                    if($edit): ?>
                                                    <a href="<?php echo base_url() . 'amc/edit/' . $user_val['id']; ?>" type="button" data-toggle="tooltip" data-placement="bottom" title="Edit employee" class="btn btn-success btn-xs"> <i class="fa fa-edit"></i> Edit</a><?php  endif; 
                                                    
                                                  
                                                    if($delete):?>
                                                    <a href="javascript:void(0)" id="<?= $user_val['id']; ?>" type="button" data-toggle="tooltip" data-placement="bottom" title="Delete Amc" class="btn btn-danger btn-xs delete"> <i class="fa fa-trash-o">
                                                        </i> Delete </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
 <?php } } ?>
<input type='hidden' id='count' value='<?php  echo $count;?>'> 
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
}); 

    
</script>