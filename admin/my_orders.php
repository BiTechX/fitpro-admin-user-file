<?php

require('common-config.php');

$total_price = 0;
$total_shipping_price = 0;
$customer_orders = wc_get_orders(array(
    'post_status' => 'any',
    'post_type' => wc_get_order_types(),
    'order' => 'ASC'
));
//echo "<pre>";
//print_r($customer_orders);
//echo "</pre>";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>My Orders</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../resources/css/sidebar.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
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

        

        
            
            <form>
            
        

                <div class="row">
                
                    
                    <div class="col-xl-8 module-card-div" style="padding-top:20px;"> <!-- padding top 20px more for shadow -->
                        
                        <?php
                            require('navbar-top.php');
                        ?>       
                    
                        <div class=" text-center text-xl-left">
                            <h1 class="dashboard-title primary-color1">my orders</h1>
                            
                        </div>
                        
                        <?php if(count($customer_orders) >= 1): 
                                    foreach($customer_orders as $order):
                                         $total_shipping_price += $order->shipping_total ;
                                         $total_price += $order->total;
                                        $customer_id = $order->customer_id;
                                        $customer = get_userdata( $customer_id );
                                        foreach($order->get_items() as $item_id => $item):
                                               $product = wc_get_product($item['product_id']);
                                            
                                               $price = get_woocommerce_currency_symbol()."".number_format((float) $item['total'] , 2, '.', '');
                                               $status = "none";
                                               if($product){
                                                    $status = $order->status;
                                               }
                                             
                        ?>
                        <div class="drop-shadow white-background grey-border secondary-color1-border-hover" style="margin-bottom:10px;">
                            <div class="row">
                                <div class="col-4 vertical-middle">
                                    <?php
                                      $val = get_user_meta( $user_ID, 'profile_photo', true );
                                      if($val){
                                          $url_profile = get_site_url()."/wp-content/uploads/ultimatemember/".$user_ID."/".$val.'?'.rand(15587000000,1568712237);
                                      } 
                                      else{
                                          $url_profile = get_avatar_url($user_ID) ;
                                      }
                                    
                                    ?>
                                    <img src="<?php echo $url_profile; ?>" class="primary-color1-border profile-image-small margin-15px">
                                    <p class="small-text primary-color1 dashboard-title3-bold" style="margin-bottom:0px;"><?php echo $customer->display_name ; ?></p>
                                    
                                </div>
                                
                                <div class="col-4 no-padding">
                                    <div class="row no-margin no-padding vertical-middle">
                                        <div class="col-5 no-padding">
                                            <img src="<?php echo get_the_post_thumbnail_url($product->id); ?>" class="course-image">
                                        </div>
                                        <div class="col-7 ">
                                            <p class="small-text dashboard-title3-bold primary-color1"><?php echo $item['name']; ?></p>
                                            <p class="small-text primary-color1" style="margin-bottom:0px;"><?php echo $status; ?></p>
                                        </div>
                                    </div>
                                    
                                </div>
    
                                <div class="col-1 vertical-middle horizontal-middle-flex text-left">
                                    <h1 class="dashboard-title3-bold" style="display:inline-block;"><?php echo $item['quantity']."x"; ?></p>
                                </div>
                                <div class="col-3 vertical-middle horizontal-middle-flex">
                                    <h1 class="dashboard-title3-bold secondary-color1"><?php echo $price; ?></h1>
                                </div> 
                            </div>    

                        </div>
                        <?php 
                                endforeach;
                            endforeach;
                            else:
                                ?>
                                NO ORDER FOUND
                       <?php endif; ?>
                       

                        <!-- Subtotal total and stuff -->
                        
                        
                        <div  style="margin-bottom:10px;margin-top:30px;">
                            <div class="row">
                                <div class="col-7 vertical-middle">

                                    
                                </div>
    
                                <div class="col-2 text-right vertical-bottom horizontal-right-flex">
                                    
                                    <h6 class=" primary-color1 dashboard-title3-bold" style="margin-bottom:10px;">SUBTOTAL:</h6>

                                    
                                </div>
                                <div class="col-3 text-center">
                                    <h1 class="dashboard-title3-bold primary-color1">
                                    <?php echo  get_woocommerce_currency_symbol()."".number_format((float) $total_price , 2, '.', '');
            ?></h1>

                                </div> 
                            </div> 
                        </div>

                        <div  style="margin-bottom:10px;">
                            <div class="row">
                                <div class="col-7 vertical-middle">

                                    
                                </div>
    
                                <div class="col-2 text-right vertical-bottom horizontal-right-flex">

                                    <h6 class=" primary-color1 dashboard-title3-bold" style="margin-bottom:10px;">SHIPPING:</h6>

                                    
                                </div>
                                <div class="col-3 text-center">

                                    <h1 class="dashboard-title3-bold primary-color1"><?php  echo  get_woocommerce_currency_symbol()."".number_format((float) $total_shipping_price , 2, '.', ''); ?></h1>

                                </div> 
                            </div> 
                        </div>
                        
                        <div  style="margin-bottom:10px;">
                            <div class="row">
                                <div class="col-7 vertical-middle">

                                    
                                </div>
    
                                <div class="col-2 text-right vertical-bottom horizontal-right-flex">
                                    <h6 class=" primary-color1 dashboard-title3-bold" style="margin-bottom:10px;">TOTAL:</h6>
                                    
                                </div>
                                <div class="col-3 text-center">
                                    <h1 class="dashboard-title3-bold secondary-color1"><?php  echo  get_woocommerce_currency_symbol()."".number_format((float) $total_price + $total_shipping_price , 2, '.', ''); ; ?></h1>
                                </div> 
                            </div> 
                        </div>
                    </div>
<!--
                    <div class="col-xl-4" >
                        <div class="drop-shadow-left white-background padding-15px" style="padding-top:70px;padding-bottom:50px;margin-bottom:20px;"> 
                            

                            <div class="row no-margin vertical-middle" style="margin-bottom:50px;">

                                <div class="col-4 no-padding">
                                    <img src="../resources/images/profile.png" class="primary-color1-border profile-image-big margin-15px">
                                </div>
                                <div class="col-8">
                                    <p class="small-text dashboard-title3-bold primary-color1">Big Shaq</p>
                                    <p class="small-text primary-color1" style="margin-bottom:0px;">8 Streeet Avenue, New York</p>
                                    <a href="tel:222724055"><p class="small-text primary-color1" style="margin-bottom:0px;">222724055</p></a>
                                    <i class="flt flaticon-telephone secondary-color1" style="margin-right:10px;"></i>
                                    <i class="flt flaticon-comment secondary-color1"></i>
                                </div>
                                    
                                    
                            </div>
                            
                            <div class="drop-shadow white-background grey-border" style="margin-bottom:15px;">
                                <div class="row">
                                    <div class="col-4 vertical-middle">
                                        <img src="http://bitechx.com/fitprotest/wp-content/uploads/2019/03/Layer-8.jpg" class="course-image">
                                        
                                        
                                    </div>
                                    
                                    <div class="col-4 no-padding vertical-middle">
                                        <div class="">
                                            <p class="small-text dashboard-title3-bold primary-color1">Six Pack Build Up</p>
                                            <p class="small-text primary-color1" style="margin-bottom:0px;">Modules: 06</p>
                                        </div>                                    
                                    </div>
    
                                    <div class="col-4 vertical-middle horizontal-middle-flex">
                                        <div class="text-right">
                                            <h4 class="dashboard-title3-bold" style="display:inline-block;">1</h4><p style="display:inline-block;margin-bottom: -14px;">x</p>
                                            <h4 class="dashboard-title3-bold secondary-color1" >$10.<sup>99</sup></h4>
                                        </div>
                                    </div> 
                                </div>  
                            </div>
                            
                            
                            <div class="drop-shadow white-background grey-border" style="margin-bottom:15px;">
                                <div class="row">
                                    <div class="col-4 vertical-middle">
                                        <img src="http://bitechx.com/fitprotest/wp-content/uploads/2019/03/Layer-8.jpg" class="course-image">
                                        
                                        
                                    </div>
                                    
                                    <div class="col-4 no-padding vertical-middle">
                                        <div class="">
                                            <p class="small-text dashboard-title3-bold primary-color1">Six Pack Build Up</p>
                                            <p class="small-text primary-color1" style="margin-bottom:0px;">Modules: 06</p>
                                        </div>                                    
                                    </div>
    
                                    <div class="col-4 vertical-middle horizontal-middle-flex">
                                        <div class="text-right">
                                            <h4 class="dashboard-title3-bold" style="display:inline-block;">1</h4><p style="display:inline-block;margin-bottom: -14px;">x</p>
                                            <h4 class="dashboard-title3-bold secondary-color1" >$10.<sup>99</sup></h4>
                                        </div>
                                    </div> 
                                </div>  
                            </div>

                            <p style="margin-top:60px;" class="secondary-color1 small-text dashboard-title3-bold" >ADDITIONAL NOTE</p></a>
                            <p style="margin-right:30px;" class="primary-color1" >Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

                            <div class="row no-margin vertical-middle" style="margin-bottom:50px;">

                                <div class="col-7 no-padding">
                                    <select class="input-lg form-control" style="margin-bottom:0px;">
                                        <option>dollars</option>
                                        <option>Ketchup</option>
                                        <option>Barbecue</option>
                                    </select>
                                    <i class="flaticon-move-to-the-next-page-symbol flt primary-color1" style="margin-top:-30px;transform: rotate(90deg);"></i> 
                                </div>
                                <div class="col-5 no-padding">
                            <button class="horizontal-middle drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover 
                            transparent-background-hover margin-bottom-10px-mobile" type="submit" style="margin-left:10px;">UPDATE</button>
                            
                                


                    
                        </div>
 

                    </div>
                    
                </div>
                

                            
    
                         
            </form>
        </div>
        
        -->
    </div>

    
    <script src="../resources/js/dashboard.js"></script>

</body>

</html>