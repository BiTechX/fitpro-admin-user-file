<?php require('../wp-content/plugins/fit-pro-plugin/lib/api-call.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Add a Course</title>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">    
    <link rel="stylesheet" href="../resources/css/flaticon/flaticon.css">
    <link rel="stylesheet" href="../resources/css/colors.css">
    <link rel="stylesheet" href="../resources/css/dashboard.css">
    
    

     
</head>

<script>
    
    $(document).ready(function(){
        $('#input-file-now-custom-1').change(function(){
            var total_file=document.getElementById("input-file-now-custom-1");
            
            $('#file-preview').html("<div style='text-align:right;'><i class='fas fa-times' id='cross-button'></i></div><img src="+URL.createObjectURL(event.target.files[0]) + "> </img>");
            $('#file-preview').addClass(" drop-shadow card-holder");
        });
        
        $(document).on ("click", "#cross-button" ,function(){
            
            document.getElementById("input-file-now-custom-1").value = "";
            $('#file-preview').html("");
            $('#file-preview').removeClass(" drop-shadow card-holder");
        });
        
    });
    
</script>

<script>
       
    $(document).on('submit', "#AddCourse", function(e) {
        var formData = new FormData();
        var total_files=document.getElementById("input-file-now-custom-1").files;
        console.log(total_files);
        var link;
        formData.append('image',total_files[0]); 
        $.ajax({
                        url: 'imageuploadaction.php',
                        data: formData,
                        async: true,
                        contentType: false,
                        processData: false,
                        cache: false,
                        type: 'POST',
                        beforeSend : function()
                        {
                            console.log("SENDING"+total_files[0].name);//can add animation before send
                        },
                        success: function(data)
                        {
                            link = data;
                            //console.log(data);
                            jQuery("#FeaturedImageLink").val(link);
                            var postvalue =  jQuery("#AddCourse").serialize();
                            var url = "<?php echo FITPRO_THEME_BTX_fun_course_add_api_url();?>";
                            console.log(postvalue);
                            $.post(url,postvalue,function(response){
                                //console.log(response);
                                var jsonData = jQuery.parseJSON(response);
                                console.log(jsonData);
                            });
                        },
                        error: function(e) 
                        {
                            $("#err").html(e).fadeIn();
                        }         
                    });
        
    });
        
    </script>   

<style>

    
</style>
<body>

    <div class="wrapper">
        <?php
            require('sidebar.php');
        ?>

        <!-- Page Content  -->
        <div id="content">
            <?php
                require('navbar-top.php');
            ?>
        

            <h1 class="dashboard-title primary-color1 padding-15px"><i class="flaticon-back"></i>  add a course</h1>
            
            <form action="javascript:void(0)" id="AddCourse" method=POST enctype=multipart/form-data >
                
                <div class="row no-margin">
                    <div class="col-xl-4 col-lg-5">
                        <div class="drop-shadow card-holder" style="padding:0px;margin-bottom:50px;">
                                <div class="form-group" style="margin-bottom:0px;">
                                  <div class="file-upload-wrapper">
                                    <label for="input-file-now-custom-1" class="file-upload-label">
                                        <i class="flaticon-photo file-icon primary-color1"></i>
                                        <h6 class="dashboard-title3 primary-color1">Drag and drop to display a picture</h6>
                                        <p class="primary-color1">OR</p>
                                        <p class="primary-color1-background white dashboard-title3" style="padding:15px;margin-bottom:0px;">Browse files</p>
                                    </label>
                                    <input type="file" id="input-file-now-custom-1" name = "courseImage" class="file-upload"/>
                                    
                                    </div>
                                </div>
                                
                        </div>
                        
                        <div id="file-preview" class="file-preview">
                            
                        </div>
    
    
                   
                        
                            <div class="drop-shadow card-holder">
                                <div class="collapsible-div-button" type="button" data-toggle="collapse" data-target="#general-info">
                                    <h6 class="dashboard-title3-bold primary-color1">General information</h6>
                                    <i class="flaticon-move-to-the-next-page-symbol flt"></i>
                                </div>
                                <div id="general-info" class="collapse collapsible-div" >
                                    <div class="form-group">
                                        <h6 class="dashboard-title3 primary-color1">course title</h6>
                                        <input type="text" class="form-control" name = "title">
                                    </div>
                                    <div class="form-group">
                                        <h6 class="dashboard-title3 primary-color1">course description</h6>
                                        <textarea  class="form-control" cols="5" name = "content"></textarea>
                                    
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
                                    <select class="input-lg form-control" name = "category">
                                        <option value = "Mustard">Mustard</option>
                                        <option value = "Ketchup">Ketchup</option>
                                        <option value = "Barbecue">Barbecue</option>
                                    </select>
                                    <i class="flt flaticon-back rotated-90 grey"></i>
                                    <h6 class="dashboard-title3 primary-color1">Tags</h6>
                                    <input type="text" data-role="tagsinput" class="form-control" id="tag" placeholder="" name="tags">
                                    <input type="hidden" id="FeaturedImageLink" name="featuredImage" value = 'abcd'>
                                </div>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio1" name="userLevel" class="custom-control-input" value = "free" checked>
                                <label class="custom-control-label" for="customRadio1">Free Course</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio2" name="userLevel" class="custom-control-input" value = "premium">
                                <label class="custom-control-label" for="customRadio2">Premium Course</label>
                            </div>
                    </div>
                </div>
                <button class="delete-button drop-shadow btn theme-rounded-button white-hover secondary-color1-background-hover secondary-color1-border secondary-color1-border-hover secondary-color1 transparent-background" type="submit">DELETE</button>
                <button class="save-button drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover transparent-background-hover" type="submit">SAVE</button>
            </form>
        </div>
    </div>

    
    <script src="../resources/js/dashboard.js"></script>
    

</body>

</html>