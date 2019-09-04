<?php  
require('common-config.php');  


global $wpdb;
$tableName = plan_db_info();
$result = $wpdb->get_results ( "
   SELECT * FROM `$tableName`
");
$tableName = plan_type_db_info();
$result_type = $wpdb->get_results ( "
   SELECT * FROM `$tableName`
");

$rowcount = $wpdb->get_var("SELECT COUNT(*) FROM ".plan_db_info()." ");
      
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Set Pricing</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../resources/css/sidebar.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

     <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">    

    <link rel="stylesheet" href="../resources/css/colors.php">
    <link rel="stylesheet" href="../resources/css/dashboard.php">
    <link rel="stylesheet" href="../resources/css/flaticon/flaticon.css">
    
    

     
</head>
<style>
    
</style>
<body>
        
    <?php
        require('navbar-mobile.php');
    ?>

    <div class="wrapper">
        <?php
            require('sidebar.php');
        ?>


        <!-- Page Content  -->
        <div id="content" style="padding-top:0px;">

            
            
                <div class="row">
                
                    
                    <div class="col-xl-8 module-card-div" style="padding-top:20px;"> <!-- padding top 20px more for shadow -->
                        
                        <?php
                            require('navbar-top.php');
                        ?>   
                       
                       <div class="padding-15px" style="margin-bottom:20px;display:inline-block;">
                           <h1 class="dashboard-title primary-color1" style="margin-bottom:5px;"><a href="set_pricing.php"><i class="flt flaticon-back primary-color1" style="margin-right:20px;vertical-align:top;"></i></a>set pricing</h1>
                           <p class="small-text dashboard-title3-bold secondary-color1" style="margin-left:60px;">Add upto three payment options</p>
                       </div>
                        

                        
                        <div class="row  no-margin  d-none d-xl-flex" style="margin-bottom:10px;">
                            
                             <?php foreach($result as $val): ?>  
                            
                                <div class="col-sm-6 col-12">
                                    
                                    <div class="row no-margin drop-shadow primary-color1-background primary-color1-border secondary-color1-border-hover" style="padding:15px;justify-content: center;margin-bottom:30px;height:300px;align-items:flex-end;">
            
                                        
                                        <div>
                                            <h6 class="dashboard-title3-bold white" style="margin-bottom:100px;"><?php echo $val->plan_title; ?></h6>
                                            <div class="text-center edit-icons white">
                                                
                                                <a href="<?php echo site_url().'/admin/set_pricing_settings_edit.php?edit_id='.$val->Id ?>" class="course-page-link" >
                                                <i class="flt flaticon-writing" ></i>
                                                </a>
                                                <i class="flaticon-rubbish-bin flt " style="padding-left:10px;" id="deleteButton" data-id = '<?php echo $val->Id ?>'></i>
                                            </div>
                                        </div>
            
                                    </div>
                                    
                                </div>
                            <?php endforeach ?>  
                            <!--
                                <div class="col-sm-6 col-12">
                                    
                                    <div class="row no-margin drop-shadow white-background grey-border secondary-color1-border-hover" style="justify-content: center;align-items:center;cursor:pointer;margin-bottom:30px;height:300px;">
                                        <i class="flaticon-add module-add-plus secondary-color1" style="margin-right:10px;font-size: 30px;"></i>
                                        <h6 class="dashboard-title3-bold module-name secondary-color1">add plan</h6>
                                    </div>
                                    
                                </div>
-->
                                

    
   

                        </div>

                            

                    </div>

                    <div class="col-xl-4 col-xl-4-right-sidebar" style="">
                        <div class="drop-shadow-left white-background padding-15px scrollbar-change secondary-color1-scrollbar mobile-overlapping-sidebar" style="padding-top:20px;height:100vh;overflow:auto;"> <!-- padding top 20px more for shadow -->
                            <div class="row vertical-middle" style="margin:0 auto 20px;max-width:500px;">
                                <div class="col-12 no-padding">
                                    <p class="small-text dashboard-title3-bold primary-color1" style="margin-bottom:0px;">Plan type</p>
                                    <select class="input-lg form-control" style="margin-bottom:0px;" id="plan_type">
                                        
                                        <?php foreach($result_type as $val): 
                                          
                                        ?>  
                                        
                                            <option value="<?php echo $val->plane_type; ?>"><?php echo $val->plane_name; ?></option>
                                            
                                         <?php 
                                           
                                         endforeach 
                                         ?>  
                                       
                                     
                                    </select>
                                    <i class="flaticon-move-to-the-next-page-symbol flt primary-color1" style="margin-top:-30px;transform: rotate(90deg);"></i> 
                                </div>
                            </div>
 
                        <form action="javascript:void(0)" id="membership_option_set" method="post">
                            <div id="ALL_PAYMENT">
                                              
                            </div>
                            <div class="row vertical-middle " style="max-width:500px;margin:25px auto;">  <!-- bottom-buttons-->
                                  <div class="col-6 no-padding text-center">
                                        <a href="<?php echo site_url().'/admin/set_pricing.php'?>">
                                            <button class="horizontal-middle drop-shadow btn theme-rounded-button white-hover secondary-color1-background-hover secondary-color1-border secondary-color1-border-hover secondary-color1 
                                             transparent-background margin-bottom-10px-mobile" type="button" id="ActionButton2" >CANCEL</button> 
                                        </a>
                                 </div>
                                 <div class="col-6 no-padding text-center">
                                      <button class="horizontal-middle drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover 
                                       transparent-background-hover margin-bottom-10px-mobile" type="submit" id="ActionButton" >SAVE</button>
                                </div>
                            </div>
                            
                        </form>
 
 
                        </div>
                        
                        
                
                    </div>  
                    
                </div>
            
        </div>
    </div>
    

    
    <script src="../resources/js/dashboard.js"></script>

</body>


<script>
       

    $(document).ready(function(){
           
            
           $('#ALL_PAYMENT').html("");
            $('#ALL_PAYMENT').load("<?php echo site_url().'/admin/ajax_call/one_time_member_form.php'?>");
           
    });

    $(document).on('change', "#plan_type", function(e) {
      
                var value = $(this).val();
                if(value == 'ONE_TIME_PAYMENT'){
                    $('#ALL_PAYMENT').html("");
                     $('#ALL_PAYMENT').load("<?php echo site_url().'/admin/ajax_call/one_time_member_form.php'?>");
                }
                else if(value == 'MONTHLY'){
                      $('#ALL_PAYMENT').html("");
                      $('#ALL_PAYMENT').load("<?php echo site_url().'/admin/ajax_call/monthly_member_form.php'?>");
                }
                else if(value == 'INSTALMENT'){
                    $('#ALL_PAYMENT').html("");
                    $('#ALL_PAYMENT').load("<?php echo site_url().'/admin/ajax_call/instalment_member_form.php'?>");
                }
                else if(value == 'FREE'){
                     $('#ALL_PAYMENT').html("");
                     $('#ALL_PAYMENT').load("<?php echo site_url().'/admin/ajax_call/free_member_form.php'?>");
                }
    });
    
    
    $(document).on('submit', "#membership_option_set", function(e) {
                var row = <?php echo $rowcount ?> ;
                
                if(row < 6){
                    var postvalue =  jQuery("#membership_option_set").serialize();
                    var url = "<?php echo FITPRO_THEME_BTX_fun_new_plan_add_admin_url();?>";
                    console.log(postvalue);
                  
                    $.ajax({
                        url: url,
                        data: postvalue,
                        type: 'POST',
                        beforeSend : function()
                        {
                            jQuery("#ActionButton").prop("disabled",true);
                            jQuery("#ActionButton2").prop("disabled",true);
                        },
                        success: function(result){
                            console.log(result);
                           jQuery("#ActionButton").prop("disabled",false);
                           jQuery("#ActionButton2").prop("disabled",false);
                           window.location.href ="";
                        },
                        error: function(e) 
                        {
                           window.location.href = "";
                        }   
                        
                    });
                }else{
                    alert(" You are not allow to add new plan because maximum plan number is 6 ");
                }
                
    });
    
    
    
     $(document).on('click', "#deleteButton", function(e) {
      
                var postvalue =  jQuery(this).data('id');
                var url = "<?php echo FITPRO_THEME_BTX_fun_new_plan_delete_admin_url().'/';?>"+postvalue;
                console.log(postvalue);
              
                $.ajax({
                    url: url,
                    data: postvalue,
                    type: 'POST',
                    beforeSend : function()
                    {
                        jQuery("#ActionButton").prop("disabled",true);
                        jQuery("#ActionButton2").prop("disabled",true);
                    },
                    success: function(result){
                        console.log(result);
                       jQuery("#ActionButton").prop("disabled",false);
                       jQuery("#ActionButton2").prop("disabled",false);
                       window.location.href ="";
                    },
                    error: function(e) 
                    {
                       window.location.href = "";
                    }   
                });
                
    });
    
</script>   

</html>