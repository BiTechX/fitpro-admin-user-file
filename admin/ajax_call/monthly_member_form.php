<?php if(!isset($_GET['edit_id'])  ):  ?> 
                            <div class="row vertical-middle" style="margin:0 auto 20px;max-width:500px;">
                                <div class="col-12 no-padding">
                                    <!--
                                    <p class="small-text dashboard-title3-bold primary-color1" style="margin-bottom:0px;">Plan type</p>
                                     <h6 class="dashboard-title3-bold module-name secondary-color1" style="margin-bottom:100px;">INSTALMENT</h6> 
                                      -->
                                        <input type="hidden" value="MONTHLY" name="plan_type">
                                </div>
                            </div>
                            
                            <div class="row vertical-middle" style="margin:0 auto 20px;max-width:500px;">
                                <div class="col-12 no-padding">
                                    <p class="small-text dashboard-title3-bold primary-color1" > monthly payment amount  </p>
                                    <input type="number" name="plan_total_amount" class=" form-control" step="0.01" required style="margin-bottom:0px;">
                                </div>
                            </div>
                            
                            <div class="row vertical-middle" style="margin:0 auto 20px;max-width:500px;">
                                <div class="col-12 no-padding">
                                    <p class="small-text dashboard-title3-bold primary-color1" > setup fee  </p>
                                    <input type="number" class=" form-control" name="plan_setup_fee" step="0.01" required style="margin-bottom:0px;">
                                </div>
                            </div>
                          
                            <div class="row vertical-middle" style="margin:0 auto 20px;max-width:500px;">
                                <div class="col-12 no-padding">
                                    <p class="small-text dashboard-title3-bold primary-color1" > Plan Title </p>
                                    <input type="text" class=" form-control" name="plan_title" required style="margin-bottom:0px;">
                                </div>
                            </div>
                            
                            <div class="row vertical-middle" style="margin:0 auto 20px;max-width:500px;">
                                <div class="col-12 no-padding">
                                    <p class="small-text dashboard-title3-bold primary-color1" >custom phrase to describe the plan</p>
                                    <textarea class="form-control" cols="5" name="plan_description"  style="margin-bottom:0px;height:100px;" required></textarea>
                                </div>
                            </div>   
                            <div class="row vertical-middle" style="margin:0 auto 20px;max-width:500px;">
                                <div class="col-12 no-padding">
                                    <p class="small-text dashboard-title3-bold primary-color1" > Status  </p>
                                   <!-- <input type="text" class=" form-control" name="plan_number_of_payment" required style="margin-bottom:0px;"> -->
                                    <select class="input-lg form-control" style="margin-bottom:0px;" name="plan_status" >
                                        <option value="publish">Published</option>
                                        <option value="unpublished">Unpublished</option>
                                    </select>
                                    <i class="flaticon-move-to-the-next-page-symbol flt primary-color1" style="margin-top:-30px;transform: rotate(90deg);"></i> 
                                </div>
                            </div>
<?php elseif(isset($_GET['edit_id'])  ):  
        require('../../wp-load.php');
        $id = (int) $_GET['edit_id'];
        $result = $wpdb->get_results ( "
            SELECT * FROM `d43_fitPro_all_plan_info` 
            INNER JOIN `d43_fitPro_all_plan_type_info` 
            ON `d43_fitPro_all_plan_info`.`plan_type` = `d43_fitPro_all_plan_type_info`.`ID` 
            WHERE `d43_fitPro_all_plan_info`.`Id` = $id
        ");
        $val = $result[0];
        
        
        
?>                                      
                    
                    
                    
                    
                    <div class="row vertical-middle" style="margin:0 auto 20px;max-width:500px;">
                                <div class="col-12 no-padding">
                                    <!--
                                    <p class="small-text dashboard-title3-bold primary-color1" style="margin-bottom:0px;">Plan type</p>
                                     <h6 class="dashboard-title3-bold module-name secondary-color1" style="margin-bottom:100px;">INSTALMENT</h6> 
                                      -->
                                        <input type="hidden" value="MONTHLY" name="plan_type">
                                        <input type="hidden" value="<?php echo $_GET['edit_id'] ?>"  name="EDIT_ID">
                                </div>
                            </div>
                            
                            <div class="row vertical-middle" style="margin:0 auto 20px;max-width:500px;">
                                <div class="col-12 no-padding">
                                    <p class="small-text dashboard-title3-bold primary-color1" > monthly payment amount  </p>
                                    <input type="number" name="plan_total_amount" class=" form-control" step="0.01" value="<?php echo $val->plan_total_cost ?>" required style="margin-bottom:0px;">
                                </div>
                            </div>
                            
                            <div class="row vertical-middle" style="margin:0 auto 20px;max-width:500px;">
                                <div class="col-12 no-padding">
                                    <p class="small-text dashboard-title3-bold primary-color1" > setup fee  </p>
                                    <input type="number" class=" form-control" name="plan_setup_fee" step="0.01" value="<?php echo $val->plan_setup_fee ?>" required style="margin-bottom:0px;">
                                </div>
                            </div>
                          
                            <div class="row vertical-middle" style="margin:0 auto 20px;max-width:500px;">
                                <div class="col-12 no-padding">
                                    <p class="small-text dashboard-title3-bold primary-color1" > Plan Title </p>
                                    <input type="text" class=" form-control" name="plan_title" value="<?php echo $val->plan_title ?>" required style="margin-bottom:0px;">
                                </div>
                            </div>
                            
                            <div class="row vertical-middle" style="margin:0 auto 20px;max-width:500px;">
                                <div class="col-12 no-padding">
                                    <p class="small-text dashboard-title3-bold primary-color1" >custom phrase to describe the plan</p>
                                    <textarea class="form-control" cols="5" name="plan_description"  style="margin-bottom:0px;height:100px;" required><?php echo $val->plan_description ?></textarea>
                                </div>
                            </div>   
                            
                            <div class="row vertical-middle" style="margin:0 auto 20px;max-width:500px;">
                                <div class="col-12 no-padding">
                                    <p class="small-text dashboard-title3-bold primary-color1" > Status </p>
                                   <!-- <input type="text" class=" form-control" name="plan_number_of_payment" required style="margin-bottom:0px;"> -->
                                    <select class="input-lg form-control" style="margin-bottom:0px;" name="plan_status" >
                                        <option value="publish">Published</option>
                                        <option value="unpublished">Unpublished</option>
                                    </select>
                                    <i class="flaticon-move-to-the-next-page-symbol flt primary-color1" style="margin-top:-30px;transform: rotate(90deg);"></i> 
                                </div>
                            </div>
                            
                            <script>
                                 var value = '<?php echo $val->plan_status ;?>';
                                $('option[value='+value+']').attr('selected', 'selected');
                            </script>
                            
                    
                    
                    
                    
                    
                    
                    
                    
 <?php endif;  ?>                           