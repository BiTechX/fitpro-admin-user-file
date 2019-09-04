<!-- Sidebar  -->

<style>
    #sidebar .sidebar-bottom-item
    {
        margin-top: calc( 100vh - 525px);    
    }

    #sidebar.active .sidebar-bottom-item
    {
        margin-top: calc( 100vh - 565px);    
    }    
    
    
    .profile-image-very-small
    {
        width: 25px;
        height: 25px;
        border-radius: 100px;
    }
    
</style>
<?php $url = site_url('/admin/','https'); ?>
<nav id="sidebar" class="primary-color1-background">
    <div class="inner-div" style="position:fixed;">
        <button type="button" id="sidebarCollapse" class="btn collpase-button">
            <i class="fas fa-grip-lines"></i>
            
        </button>
    
        <ul class="list-unstyled components">
            <li class="active">
                <a href="<?php echo $url.'homepage.php'; ?>">
                    <i class="flaticon-homepage flt"></i>
                    <p class="menu-name">Dashboard</p>
                </a>
    
            </li>
            <li>
                <a href="<?php echo $url.'course_list.php'; ?>">
                    <i class="flaticon-write-board flt"></i>
                    <p class="menu-name">My Courses</p>
                </a>
            </li>  
            <li>
                <a href="<?php echo $url.'notifications_inbox.php'; ?>">
                    <i class="flaticon-comment flt"></i>
                    <p class="menu-name">Notifications <span class="secondary-color1-background white" style="padding:0px 5px;margin-left:3px;"><?php $comments_count = wp_count_comments(); echo $comments_count->moderated; ?></span></p>
                </a>
            </li>
            <li>
                <a href='<?php echo $url.'inbox_messages.php'; ?>'>
                    <i class="flaticon-chat flt"></i>
                    <p class="menu-name">Messages <span class="secondary-color1-background white" style="padding:0px 5px;margin-left:3px;"><?php 
                    $results_count = $wpdb->get_results ("
    SELECT * FROM `".chat_message_db_name()."` WHERE  `recever_id` = $user_ID  AND `is_view_reciver` = 0  GROUP BY  `sender_id`
");
if(count($results_count) >= 1){
    echo count($results_count);
}

                   
                    
                    ?></p>
                </a>
            </li>
            <li>
                <a href="<?php echo $url.'set_pricing.php'; ?>">
                    <i class="flaticon-money-1 flt"></i>
                    <p class="menu-name">Pricing</p>
                </a>
            </li>
            
            <li>
                <a href="<?php echo $url.'blog-upload.php'; ?>">
                    <i class="flaticon-order flt"></i>
                    <p class="menu-name">Blogs</p>
                </a>
            </li>
            <li>
                <a href='<?php echo site_url();?>/wp-admin'>
                    <i class="flaticon-wordpress flt"></i>
                    <p class="menu-name">Wordpress</p>
                </a>
            </li>

            <li class="sidebar-bottom-item">
                <a href="<?php echo $url.'settings_1_profile.php'; ?>">
    
                   <?php 
                               
                          $vals = get_user_meta( $user_ID, 'profile_photo', true );
                          if($vals){
                              $url_profile = get_site_url()."/wp-content/uploads/ultimatemember/".$user_ID."/".$vals.'?'.rand(15587000000,1568712237);
                          } 
                          else{
                              $url_profile = get_avatar_url($user_ID) ;
                          }
                            
                        ?>
                       <img src="<?php echo $url_profile; ?>" class="primary-color2-border profile-image-very-small">  
                    <p class="menu-name">Hi <?php echo $user_Info->first_name ;?>!</p>
                    <i class="flaticon-settings flt"></i>
                </a>
            </li>
            <li >
                <a href="https://fitprobizlaunch.com/logout">
    
                   
                    
                    <i class="flaticon-exit-to-app-button flt"></i>
                    <p class="menu-name">Signout</p>
                </a>
            </li>        
            
            
            <!-- Commented code of dropdown element
            <li>
                <a href="#">
                    <i class="fas fa-briefcase"></i>
                    <p class="menu-name">About</p>
                </a>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-copy"></i>
                    <p class="menu-name">Pages</p>
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a class="primary-color1-background" href="#">Page 1</a>
                    </li>
                    <li>
                        <a class="primary-color1-background" href="#">Page 2</a>
                    </li>
                    <li>
                        <a class="primary-color1-background" href="#">Page 3</a>
                    </li>
                </ul>
            </li>
            -->
        </ul>
    </div>
</nav>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>