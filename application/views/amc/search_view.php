 <?php 
  $edit = access_check("employee","edit");
  $delete = access_check("employee","delete");
  $view = access_check("employee","view");
 
 foreach ($user_detail as $user_val) { ?>
                                    <div class="col-md-4 col-sm-4 col-xs-12 animated fadeInDown">
                                        <div class="well profile_view">
                                            <div class="col-sm-12">
                                                <div class="left col-xs-7">
                                                    <h2><?php echo  strtoupper($user_val['amc_name']); ?></h2>
                                                   <p><strong> AMC CODE: </strong><?php   echo $user_val['amc_code']; ?></p>
                                                   <p><strong> AMC DURATION: </strong><?php   echo $user_val['amc_duration']; ?></p>
                                                    <ul class="list-unstyled">

                                                        <li> AMC VISIT: <?= ($user_val['amc_visit']); ?></li>
                                                    </ul>
                                                </div>
                                                <div class="right col-xs-5 text-center">
                                                    <?php // echo $user_val['id'].base_url(getAmcImage($user_val['id'])); ?>
                                                    <img src="<?php echo base_url(getAmcImage($user_val['id'])); ?>" alt="" class="img-circle img-responsive">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 bottom text-right">
                                                <div class="col-xs-12 col-sm-12 emphasis">

                                                </div>
                                                <div class="col-xs-12 col-sm-12 emphasis">
                                                    <?php  if($view):?>
                                                    <a href="<?php echo base_url() . 'amc/show/' . $user_val['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="View AMC" type="button" class="btn btn-info btn-xs"> <i class="fa fa-user">
                                                        </i> View</a>
                                                    <?php endif;
                                                    
                                                    if($edit): ?>
                                                    <a href="<?php echo base_url() . 'amc/edit/' . $user_val['id']; ?>" type="button" data-toggle="tooltip" data-placement="bottom" title="Edit AMC" class="btn btn-success btn-xs"> <i class="fa fa-edit"></i> Edit</a><?php  endif; 
                                                    
                                                  
                                                    if($delete):?>
                                                    <a href="javascript:void(0)" id="<?= $user_val['id']; ?>" type="button" data-toggle="tooltip" data-placement="bottom" title="Delete AMC" class="btn btn-danger btn-xs delete"> <i class="fa fa-trash-o">
                                                        </i> Delete </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
 <?php }  ?>
<input type='hidden' id='count' value='<?php  echo $count;?>'> 
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
}); 

    
</script>