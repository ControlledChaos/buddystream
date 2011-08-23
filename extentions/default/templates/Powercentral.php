<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<link rel="stylesheet" href="<?php echo plugins_url() . '/buddystream/extentions/default/style.css';?>" type="text/css" />
<link rel="stylesheet" href="<?php echo plugins_url() . '/buddystream/extentions/default/slickswitch.css';?>" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script src="<?php echo plugins_url();?>/buddystream/extentions/default/jquery.slickswitch.js" type="text/javascript"></script>

<?php include "AdminMenu.php"; ?>

<form id="settings_form" action="" method="post">

<?php
    global $bp;
    if ($_POST) { echo '<div class="buddystream_info_box_green">' . __('Settings saved.', 'buddystream') . '</div>';  }
?>
    
    <div class="buddystream_info_box">
        <?php _e('powercentral description','buddystream_lang'); ?>       
    </div>
    
    <div id="dashboard-widgets-wrap">
        <div class="metabox-holder">    
            <?php
            //loop throught extentions directory and get all extentions
            foreach (buddystreamGetExtentions() as $extention) {

                if(is_array($extention)){
                    if($_POST){
                       update_site_option('buddystream_'.$extention['name'].'_power', trim(strip_tags($_POST['buddystream_'.$extention['name'].'_power'])));
                    }

                    echo '
                       <div class="postbox" style="float:left; width:200px; margin-right:20px;">
                            <div><h3 style="cursor:default;"><img src="'.plugins_url().'/buddystream/extentions/'.$extention['name'].'/'.$extention['icon'].'"> '.__(ucfirst($extention['name']), 'buddystream').'</h3>
                                <div class="inside" style="padding:10px;">
                                    <input id="buddystream_'.$extention['name'].'" class="switch icons" type="checkbox" name="buddystream_'.$extention['name'].'_power">
                                </div>
                            </div>
                        </div>
                    ';
                }
            }
            ?>
            </div>
        <script type="text/javascript">
            $(".switch").slickswitch();
       </script>
    </div>
    
 <?php
//flip switches
foreach (buddystreamGetExtentions() as $extention) {
     if(get_site_option('buddystream_'.$extention['name'].'_power')){
        echo'
        <script>
            $("#buddystream_'.$extention['name'].'").slickswitch("toggleOn"); 
        </script>
        ';
     }else{
        echo'
        <script>
            $("#buddystream_'.$extention['name'].'").slickswitch("toggleOff"); 
        </script>
        ';
     }
}
?>

<p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>