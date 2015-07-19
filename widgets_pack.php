<?php
    wp_enqueue_style( 'optionscss', plugin_dir_url( __FILE__ ) .'style.css' );
    
    $WidgetMaster_Turn_On_Off_Features = get_option('WidgetMaster_Turn_On_Off_Features');
    $WidgetMaster_Open_Close_Main_Feature = get_option('WidgetMaster_Open_Close_Main_Feature');
    
    
    if (isset($_POST['WidgetMaster_features_submit']) && $_POST['WidgetMaster_features_submit'] == 'yes')
    {
        $WidgetMaster_Turn_On_Off_Features = sanitize_text_field($_POST['WidgetMaster_Turn_On_Off_Features']);
        $WidgetMaster_Open_Close_Main_Feature = sanitize_text_field($_POST['WidgetMaster_Open_Close_Main_Feature']);
        
        update_option('WidgetMaster_Turn_On_Off_Features', $WidgetMaster_Turn_On_Off_Features );
        update_option('WidgetMaster_Open_Close_Main_Feature', $WidgetMaster_Open_Close_Main_Feature );
    }
    
     //var_dump($widgets);
?>

<div class="wrap">
    
    <div class="form-wrap">
      <div id="icon-plugins" class="icon32 icon32-posts-post"><br></div>
          <div class="clouds-sm">
                <h2><?php _e('Widget Master', 'widget-master'); ?></h2>
          </div>
          <ul class="settings-nav">
              <li><a href="<?php echo esc_url( get_admin_url(null, 'options-general.php?page=wp-widget-master/widget-master.php') );?>">General</a></li>
              <li><a href="<?php echo esc_url( get_admin_url(null, 'options-general.php?page=wp-widget-master/widget-master.php&report&nomainpage') );?>">Report</a></li>
              <li><a href="<?php echo esc_url( get_admin_url(null, 'options-general.php?page=wp-widget-master/widget-master.php&turn_on_off_features&nomainpage') );?>">Turn On/Off features</a></li>
              <li class="active"><a href="<?php echo esc_url( get_admin_url(null, 'options-general.php?page=wp-widget-master/widget-master.php&widgets_pack&nomainpage') );?>">Widgets Pack</a></li>
          </ul>
          <h3>Widgets Pack</h3>
          
          <form name="sdp_form" method="post" action="">
                <h4>An great, amazing widgets pack for wordpress based websites.</h4>
		<h4>Widgets are available in the Appearance->Widgets page, by php function and by shortcode.</h4>
		<div id="widgetsPackSection">
                    
                    <h2>Coming Soon</h2>
                    
                </div>
                
                
                <?php wp_nonce_field('WidgetMaster_form_setting'); ?>
	</form>
          
          
          
    </div>
    <p><br /><br /><br /><br /><br /><br /><br /></p>

    
</div>

