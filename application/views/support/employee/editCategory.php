<div role="main">
    <div class="container" >
        <div class="page-title">
            <div class="title_left">
                <h3>
                    <?= $mainHeading ?>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>


        <div class="col-md-12 col-sm-12 col-xs-12" >
            <div class="x_panel">
                <div class="x_title">
                    <h2><?= $mainHeading ?> <small><?= $subHeading ?></small></h2>
                     <a class="btn btn-success btn-sm pull-right" href="javascript:void(0);" onclick="window.history.back()"><i class="fa fa-chevron-circle-left"></i> Back</a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form data-parsley-validate  class="form-horizontal form-label-left"  data-parsley-validate action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-9 col-sm-8 col-xs-12" style="border-right: 15px solid white;">
                                <div class="item form-group">
                                    <h2 class="col-md-12 col-sm-12 col-xs-12" for="support_category">Category Name *
                                    </h2>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="hidden" name="support_category_id" id="" value="<?php echo $category_name[0]['forum_category_id']; ?>"/>
                                        <input  required="required" id="support_category" placeholder="Enter category name" name="edit_support_category" data-parsley-error-message="The category name field is required." value="<?php echo ( $method == "post") ? set_value('edit_support_category') : $category_name[0]['forum_category_name']; ?>" type="text" class="form-control col-md-7 col-xs-12"><?php echo form_error('edit_support_category'); ?>
                                    </div>     
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                <?php if (access_check("organisation", "view")) { ?>
                                    <div class="item form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12" for="phone">Orginasation <span class="required">*</span>
                                        </label>
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                            <select disabled="true" data-parsley-error-message="The Organisation field is required."  required="required" id="orginasation_type" name="orginasation_type" tabindex="-1" class="select_organisation form-control col-md-7 col-xs-12 <?= (strlen(form_error('orginasation_type')) > 0) ? 'parsley-error' : '' ?>" value="<?php echo set_value('orginasation_type'); ?>">                                             <?php foreach ($organisation as $org) { ?>
                                                    <option <?php if ($category_name[0]['organisation_id'] == $org['organisation_id']) echo 'selected="true"' ?> value=<?php echo $org['organisation_id']; ?>><?= $org['organisation_name'] ?></option>
                                                <?php } ?>
                                            </select>   
                                            <?php echo form_error('orginasation_type'); ?>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <input  type="hidden" name="orginasation_type" id="orginasation_type" value="<?php
                                    $org = getUserOrginasationDetails(getLoginUser());
                                    echo $org['organisation_id'];
                                    ?>"/>
                                            <?php
                                        }
                                        ?>
                                <div class="clearfix">&nbsp;</div>
                                <div class="item form-group">
                                    <label class=" col-md-3 col-sm-3 col-xs-12" for="support_category_desc">Description *
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <textarea rows="4" required="required" id="category_description" placeholder="Enter category description" name="edit_category_description" class="form-control col-md-7 col-xs-12" data-parsley-error-message="The category description field is required."><?= ( $method == "post") ? set_value('edit_category_description') : $category_name[0]['forum_category_description']; ?>
                                        </textarea>
                                        <?php echo form_error('edit_category_description'); ?>
                                    </div>
                                    <div class="form-group col-md-3 col-sm-3 col-xs-12"></div>
                                    <div class="form-group col-md-9 col-sm-9 col-xs-12">A brief description of this category. Basic HTML allowed.</div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">&nbsp;</div>
                                <div class="clearfix"></div>
                                <div class="ln_solid"></div>
                                <div class="form-group  pull-right">
                                    <div class="links_delete">
                                        <?php if (access_check("support portal", "delete")) { ?>
                                            <a id="<?= $category_name[0]['forum_category_id']; ?>"  href="javascript:void(0)" class="delete">Delete</a>&nbsp;or&nbsp;
                                        <?php } ?>
                                        <button id="send" type="submit" class="btn btn-success btn-xs">Update category</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12 pull-right" style="background-color: #F6F6F6">
                                <div class="side-box-content"><h3>Setting up a Category</h3>
                                    <p>Fields marked with an asterisk (*) are mandatory</p><p>
                                        You'll be notified when our staff answers your request.</p>
                                    <div style="clear:left; height:8px;"></div></div>
                            </div>
                            <input type="hidden" value="<?php echo base_url(); ?>" id="base_url" class="base_url"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    div#moderator_box div.links a:hover {
    background-color: #b65151 !important;
    color: #ffffff !important;
}
div#moderator_box div.links a {
    color: #b65151 !important;
}
</style>
<script>
    $(document).ready(function () {

        var base_url = $("#base_url").val();
        $(".select_organisation").chosen({width: "100%"
        });
        $(".group").chosen({width: "100%",
            no_results_text: "No result found."
        });

        $("body").on("click", ".delete", function () {
            var id = $(this).attr("id");
            bootbox.confirm({
                size: 'small',
                message: "Are you sure?",
                callback: function (result) {
                    if (result) {
                        var url = base_url + 'support/deletecateogry';
                        window.location.href = url + "/" + id;
                    }
                }
            });


        });


    });
</script>


<!-- footer content -->

