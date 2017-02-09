<?php
$loginuser = $this->session->userdata('logged_in');
?>
<div class="right_col" role="main">
    <div class="container" >
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3><?php echo $mainHeading; ?></h3>
                </div>
                
            </div>
            <div class="clearfix"></div>
           
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                             
                        <div class="x_content">

                            <div class="row">
                                <div class="col-md-9">
                                    <form method="post" id="report_form" action="">     
                               <ul class="list-group">
                                        <li>
                                            <div class="block" >
                                                <div class="block_content">
                                                    <h2 class="title">
                                                     <i class="glyphicon glyphicon-list-alt report-icon" type="1" ></i><a class="report" type="1115">All Unassigned tickets</a>
                                        </h2>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="block" >
                                                <div class="block_content">
                                                    <h2 class="title">
                                           <i class="glyphicon glyphicon-list-alt report-icon"></i> <a class="report" type="1116">All Pending tickets</a>
                                        </h2>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="block" >
                                                <div class="block_content">
                                                    <h2 class="title">
                                                  <i class="glyphicon glyphicon-list-alt report-icon"></i>  <a class="report" type="1117">All Open Assigned tickets </a>
                                        </h2>
                                                    
                                                    
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="block" >
                                                <div class="block_content">
                                                    <h2 class="title" >
                                           <i class="glyphicon glyphicon-list-alt report-icon"></i> <a class="report" type="1118">Bad tickets</a>
                                        </h2>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="block" >
                                                <div class="block_content">
                                                    <h2 class="title" >
                                           <i class="glyphicon glyphicon-list-alt report-icon"></i> <a type="1119" class="report">Good tickets</a>
                                        </h2>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="block" >
                                                <div class="block_content">
                                                    <h2 class="title" >
                                           <i class="glyphicon glyphicon-list-alt report-icon"></i> <a class="report" type="1120">Employee open/pending tickets</a>
                                        </h2>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="block" >
                                                <div class="block_content">
                                                    <h2 class="title">
                                           <i class="glyphicon glyphicon-list-alt report-icon"></i> <a class="report" type="1121">Solved tickets</a>
                                        </h2>
                                                </div>
                                            </div>
                                        </li>
                               </ul>
                             <input type="hidden" name="organisation_id" id="organisation_id">       
                             <input type="hidden" name="type" id="report_type">       
                             <input type="hidden" name="report_heading" id="report_heading">       
                                    
                             </form>
                            </div>
                                <div class="col-md-3">
                                     <div class="panel panel-default">
                                         <div class="panel-heading"><h4>Reporting</h4></div>
                                        <div class="panel-body">Click any report title to display its corresponding chart and data table. Administrators can reconfigure reports and add new reports.</div>
                                      </div>
                                </div>
                            </div>
                                 

                        </div>
               
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="clearfix"></div>

<div class="clearfix"></div>
 <style>
.top_search .search_button {
 color:#ffffff !important;
}
.list-group{
    list-style: none;
}
.list-group li{
    padding: 0px 10px;
    background: #fafafa;
    border-bottom: solid 1px #eee
}
.list-group li a{
    font-size: 16px;
    cursor: pointer
}
.list-group li a:hover{
    text-decoration: none;
    color: #000
}
.report-icon {
    background: #73879c none repeat scroll 0 0;
    border-radius: 100%;
    color: #fff;
    height: 40px;
    line-height: 40px;
    margin-bottom: 10px;
    margin-right: 10px;
    text-align: center;
    width: 40px;
}
     
 </style>
 