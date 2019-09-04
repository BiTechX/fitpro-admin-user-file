<?php
require("common-config.php");
require_once('../wp-content/plugins/fit-pro-plugin/lib/api-call.php');
include_once "../wp-config.php";

global $wpdb;
global $post;

$categories = wp_remote_get( get_site_url().'/wp-json/wc/v3/products/categories', array(
     	'headers' => array(
    		'Authorization' => 'Basic ' . base64_encode( 'ck_6d9ccb7c073d847e292d60be042cb445e78640a8:cs_2e7128f3e2248fb3d93dd2800bda1c1c279132e9' )
    	),
    ) );

$categories = json_decode($categories['body']);

$table = collection_db_name();
$collections = $wpdb->get_results("SELECT * FROM $table", ARRAY_A);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Add Product</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../resources/css/sidebar.css">
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.3.1/dist/multiple-select.min.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">    

    <link rel="stylesheet" href="../resources/css/flaticon/flaticon.css">
    <link rel="stylesheet" href="../resources/css/colors.php">
    <link rel="stylesheet" href="../resources/css/dashboard.php">
    
    <!-- Datepicker -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

     
</head>

<style>
.module-image-show img
{
    height: 85px;
}
    
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
        <div id="content">
            <?php
                require('navbar-top.php');
            ?>
        

          <h1 class="dashboard-title primary-color1 padding-15px"><a href="homepage.php"><i class="flaticon-back"></i></a>  ADD PRODUCT</h1>
            
            
                <div class="row no-margin">
                    
                    <div class="col-xl-6 col-lg-6  scrollbar-change ">
                    <form action="woocommerce_api/add_new_product.php" method=POST enctype=multipart/form-data id="product">
                        <div class="backend-course-image" >
                                
                        </div>
                        <div class="drop-shadow card-holder row no-margin no-padding">
                            <div class="col-7">
                                <h6 class="dashboard-title3-bold primary-color1" style="margin-top:5px;">Display picture</h6>
                            
                            </div>
                            <div class="col-5 display-picture-iconsholder">
                                <label class="flt flaticon-upload primary-color1" for="input-file-display-picture" ></label>
                                <input type="file" id="input-file-display-picture" class="file-upload-hidden" name = "mainImage"/>
                                
                            </div>
                            
                        </div>    

                        <div class="drop-shadow card-holder row no-margin no-padding" style="margin-bottom:0px;">
                            <div class="col-7">
                                <h6 class="dashboard-title3-bold primary-color1" style="margin-top:5px;">ADD MORE PICTURES</h6>
                            
                            </div>
                            <div class="col-5 display-picture-iconsholder">
                                <label class="flt flaticon-upload primary-color1" for="secondary-file-display-picture" ></label>
                                <input type="file" id="secondary-file-display-picture" class="file-upload-hidden" name = "secondaryImage[]" multiple/>
                                
                            </div>
                            
                        </div>    
                        
                        <div class="drop-shadow card-holder row no-margin no-padding" id = "secondary-image">
                               
                        </div>
               
                        
                        <div class="drop-shadow card-holder">
                            <div class="collapsible-div-button" type="button" data-toggle="collapse" data-target="#general-info">
                                <h6 class="dashboard-title3-bold primary-color1">General information</h6>
                                <i class="flaticon-move-to-the-next-page-symbol flt"></i>
                            </div>
                            <div id="general-info" class="collapse collapsible-div" >
                                <div class="form-group">
                                    <h6 class="dashboard-title3 primary-color1">Product title</h6>
                                    <input type="text" value = "<?php echo $results[0]["post_title"]; ?>" class="form-control" name = "name" >
                                </div>
                                <div class="form-group">
                                    
                                    <h6 class="dashboard-title3 primary-color1">Product description</h6>
                                    <div class="dashboard-title3-bold" style="margin-bottom:20px;text-transform:none;" id = "product-description"></div>
                                    <input class="form-control" cols="5" style="margin-bottom:0px" name = "description" id = "product-description-hidden" type = "hidden">
                                    <!--<textarea  class="form-control" name = "description" cols="5"></textarea>-->
                                </div>        
                            </div>
                        </div>
                        <div class="drop-shadow card-holder">
                            <div class="collapsible-div-button" type="button" data-toggle="collapse" data-target="#pricing-info">
                                <h6 class="dashboard-title3-bold primary-color1">Pricing</h6>
                                <i class="flaticon-move-to-the-next-page-symbol flt"></i>
                            </div>
                            <div id="pricing-info" class="collapse collapsible-div" >
                                <div class="form-group">
                                    <h6 class="dashboard-title3 primary-color1">Price</h6>
                                    <input type="number" class="form-control" name = "regular_price" >
                                </div>
                                <div class="form-group">
                                    <h6 class="dashboard-title3 primary-color1">Compare at price</h6>
                                    <input type="number" class="form-control" name = "sale_price" >
                                </div>
                            </div>
                        </div>
                        
                        <div class="drop-shadow card-holder">
                            <div class="collapsible-div-button" type="button" data-toggle="collapse" data-target="#organization">
                                <h6 class="dashboard-title3-bold primary-color1">organization</h6>
                                <i class="flaticon-move-to-the-next-page-symbol flt"></i>
                            </div>
                            
                            <div id="organization" class="collapse collapsible-div" >
                              <div class="form-group">
                                    <h6 class="dashboard-title3 primary-color1">Collections</h6>
                                    <input type="hidden" name = "collection" id = "collection">
                                    <select name = "collections" class="input-lg form-control" id="select" multiple="multiple">
                                        <?php foreach($collections as $collection):?>
                                            <option value = "<?php echo $collection['collection_name'] ;?>"><?php echo $collection['collection_name'] ;?></option>
                                        <?endforeach;?>  
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="drop-shadow card-holder">
                            <div class="collapsible-div-button" type="button" data-toggle="collapse" data-target="#inventory">
                                <h6 class="dashboard-title3-bold primary-color1">Inventory</h6>
                                <i class="flaticon-move-to-the-next-page-symbol flt"></i>
                            </div>
                            
                            <div id="inventory" class="collapse collapsible-div" >
                              <div class="form-group">
                                    <h6 class="dashboard-title3 primary-color1">SKU(stock Keeping Unit)</h6>
                                    <input type="text" class="form-control" name = "sku" >
                                </div>
                                <div class="form-group">
                                    <h6 class="dashboard-title3 primary-color1">Quantity</h6>
                                    <input type="number" value = "0" class="form-control" name = "stock_quantity" >
                                </div>
                            </div>
                        </div>

                        <div class="drop-shadow card-holder">
                            <div class="collapsible-div-button" type="button" data-toggle="collapse" data-target="#category">
                                <h6 class="dashboard-title3-bold primary-color1">category</h6>
                                <i class="flaticon-move-to-the-next-page-symbol flt"></i>
                            </div>
                            
                            <div id="category" class="collapse collapsible-div" >
                                <h6 class="dashboard-title3 primary-color1">category</h6>
                                <select name = "category" class="input-lg form-control">
                                    <?php foreach($categories as $category):?>
                                        <option value = "<?php echo $category->id ;?>"><?php echo $category->name ;?></option>
                                    <?endforeach;?>  
                                </select>
                                <i class="flt flaticon-back rotated-90 grey"></i>
                                <h6 class="dashboard-title3 primary-color1">Tags</h6>
                                <input type="text" data-role="tagsinput" class="form-control" id="tag" name="tags">
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-6 col-lg-6">
                      <div class="drop-shadow card-holder">
                            <div class="collapsible-div-button" type="button" >
                                <h6 class="dashboard-title3-bold primary-color1">Date</h6>
                                <p class="primary-color1 dashboard-title3 ">Start Date: </p><input id="startDate" style="width:80%;max-width:300px;margin-bottom:10px;" placeholder="MM/DD/YY" class="primary-color1"/>
                                <p class="primary-color1 dashboard-title3 ">End Date: </p><input id="endDate" style="width:80%;max-width:300px;margin-bottom:10px;" placeholder="MM/DD/YY" class="primary-color1"/>
                               
                            </div>
                            

                        </div>
                      <div class="drop-shadow card-holder">
                            <div class="collapsible-div-button" type="button" >
                                <h6 class="dashboard-title3-bold primary-color1">Weight</h6>
                                
                            </div>
                            
                            <div id="category" class="" style="padding:15px">
                                <h6 class="dashboard-title3 primary-color1">Weight(in lb)</h6>
                                <p class="primary-color1">Used to calculate shipping rates at checkout and label prices during fulfilment</p>
                                 <div class="form-group">
                                    
                                    <input type="number" value = "0" class="form-control" name = "weight" >
                                </div>
                               
                            </div>
                        </div>
                        <div class="drop-shadow card-holder">
                            <div class="collapsible-div-button" type="button" >
                                <h6 class="dashboard-title3-bold primary-color1">Variants</h6>
                                
                            </div>
                            
                            <div id="category" class="" style="padding:15px">
                                 <div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input" id="customCheck1" name="notification">
                                      <label class="custom-control-label dashboard-title3 " style="text-transform:none;" for="customCheck1" value="yes">This product has multiple options, like different sizes and colors</label>
                           </div>
                               
                            </div>
                        </div>
                         <div class="drop-shadow card-holder">
                            <div class="collapsible-div-button" type="button" >
                                <h6 class="dashboard-title3-bold primary-color1">Search engine listing preview</h6>
                               
                                
                            </div>
                            
                            <div id="category" class="" style="padding:15px">

                                
                               <div class="form-group" style="margin-top:15px;">
                                   <h6>Add a title and description to see how this product might appear in search engine listing </h6>
                                    <textarea  class="form-control" name = "seo" cols="5"></textarea>
                                </div>   
                               
                            </div>
                        </div>
                        
                    </div>

                </div>

                <button class="delete-button drop-shadow btn theme-rounded-button white-hover secondary-color1-background-hover secondary-color1-border secondary-color1-border-hover secondary-color1 white-background" id = "deleteButton" style="z-index:2;" >DELETE</button>
                <button class="save-button drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover white-background-hover" id="saveButton" style="z-index:2;">SAVE</button>
                <div class="d-none d-xl-block drop-shadow" style="background-color: rgba(255,255,255,0.85);position: fixed;right: 19px;top: 108px;height: 80px;width: 250px;z-index: 1;"></div>
            </form>
            
            <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
            <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
            <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
            <script>
                var quill = new Quill('#product-description', {
                  modules: {
                    toolbar: [
                      ['bold', 'italic','underline','color','align'],
                      [{ list: 'ordered' }, { list: 'bullet' }],
                      ['link', 'blockquote']
                    ]
                  },
                  theme: 'snow'
                });
            </script>
            
            <script>
                $(document).ready(function(){
                    $(document).on("submit" , "#product" , function()
                    {
                        console.log("here");
                        $("#product-description-hidden").val(quill.root.innerHTML); 
                        var product_description = document.querySelector("input[id=product-description-hidden]");
                        product_description.value = quill.root.innerHTML;
                    });
                });
            </script>
            
            <script>
            $(document).ready(function(){
                $('#input-file-display-picture').change(function(){
                    var total_file=document.getElementById("input-file-display-picture");
                    
                    $('.backend-course-image').html("<img src="+URL.createObjectURL(event.target.files[0]) + ">");
                    
                });
                /*
                $(document).on ("click", "#cross-button" ,function(){
                    
                    document.getElementById("input-file-now-custom-1").value = "";
                    $('#file-preview').html("");
                    $('#file-preview').removeClass(" drop-shadow card-holder");
                });
                */
            });
            </script>
            
            <script type="text/javascript">
            $(document).ready(function() {
              if (window.File && window.FileList && window.FileReader) {
                $("#secondary-file-display-picture").on("change", function(e) {
                  var files = e.target.files,
                    filesLength = files.length;
                  for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                      var file = e.target;
                      $("#secondary-image").append('<div class="col-xl-6 col-12 backend-course-image pip">'+
                                '<img src="'+e.target.result+'">'+
                                '<h6 class="dashboard-title3-bold secondary-color1 text-center remove" style="margin-top:5px;">REMOVE<i class="flaticon-rubbish-bin flt secondary-color1" style="padding-left:10px;padding-right:10px;margin-bottom:10px;cursor:pointer;" ></i></h6>'+
                            '</div>');
                      $(".remove").click(function(){
                        $(this).parent(".pip").remove();
                      });
                      
                      // Old code here
                      /*$("<img></img>", {
                        class: "imageThumb",
                        src: e.target.result,
                        title: file.name + " | Click to remove"
                      }).insertAfter("#files").click(function(){$(this).remove();});*/
                      
                    });
                    fileReader.readAsDataURL(f);
                  }
                });
              } else {
                alert("Your browser doesn't support to File API")
              }
            });
            
            </script>
            <script>
                var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
                $('#startDate').datepicker({
                    uiLibrary: 'bootstrap4',
                    iconsLibrary: 'fontawesome',
                    minDate: today,
                    maxDate: function () {
                        return $('#endDate').val();
                    }
                });
                $('#endDate').datepicker({
                    uiLibrary: 'bootstrap4',
                    iconsLibrary: 'fontawesome',
                    minDate: function () {
                        return $('#startDate').val();
                    }
                });
            </script>           
        </div> 
    </div>
    
    <script> var all_cat = ""; </script>
    <?php foreach($categories as $category):?>
    <script>all_cat += '<?php echo $category->name."," ;?>' </script>
    <?endforeach;?>
    
    <script src="../resources/js/dashboard.js"></script>
    <script src="https://unpkg.com/multiple-select@1.3.1/dist/multiple-select.min.js"></script>
    <script>
    var array_1 = all_cat.split(",");
    //console.log(select);
     $(function () {
        $('#select').multipleSelect({
          styler: function (value) {
            
          },
          displayValues: true
          
        });
        $('#select').multipleSelect('setSelects', array_1);
      })
    </script>
    
    <script>
        $(document).on ("change", "#select" ,function(){
            $('#collection').val($('#select').multipleSelect('getSelects'));
            console.log($('#select').multipleSelect('getSelects'));
        });
    </script>
</body>

</html>