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
              <li class="active"><a href="<?php echo esc_url( get_admin_url(null, 'options-general.php?page=wp-widget-master/widget-master.php&turn_on_off_features&nomainpage') );?>">Turn On/Off features</a></li>
              <li style="border-bottom:1px solid #81a844;"><a href="<?php echo esc_url( get_admin_url(null, 'options-general.php?page=wp-widget-master/widget-master.php&widgets_pack&nomainpage') );?>">Widgets Pack</a></li>
          </ul>
          <h3><?php _e('Widget Master features', 'widget-master'); ?></h3>
          
          <form name="sdp_form" method="post" action="">
		<div style="height:5px;"></div>
		<h4>Choose what features of Widget Master you want to use</h4>
		
                <p> <h2 style="display:inline;">1. (Base feature)</h2> Open/Close widgets ability for visitors.</p>
		
		<label for="tag-title">Open/Close widgets</label>
		<select name="WidgetMaster_Open_Close_Main_Feature" id="WidgetMaster_Open_Close_Main_Feature">
			<option value='ON' <?php if($WidgetMaster_Open_Close_Main_Feature == 'ON') { echo 'selected' ; } ?>>ON</option>
			<option value='OFF' <?php if($WidgetMaster_Open_Close_Main_Feature == 'OFF') { echo 'selected' ; } ?>>OFF</option>
		</select>
                
                <br /><br />
                
		<p> <h2 style="display:inline;">2.</h2>Hide or show widgets on specified pages. When you add some widget to some sidebar at the bottom you will see new options. There you can show/hide widget on every site page.</p>
		
		<label for="tag-title">Hide/Show widgets</label>
		<select name="WidgetMaster_Turn_On_Off_Features" id="WidgetMaster_Turn_On_Off_Features">
			<option value='ON' <?php if($WidgetMaster_Turn_On_Off_Features == 'ON') { echo 'selected' ; } ?>>ON</option>
			<option value='OFF' <?php if($WidgetMaster_Turn_On_Off_Features == 'OFF') { echo 'selected' ; } ?>>OFF</option>
		</select>
                
                <br /><br />
                <!--
		<p> <h2 style="display:inline;">2.</h2> xxx</p>
		
		<label for="tag-title">xxx</label>
		<select name="WidgetMaster_On_Archives" id="WidgetMaster_On_Archives">
			<option value='ON' <?php  ?>>ON</option>
			<option value='OFF' <?php  ?>>OFF</option>
		</select>
		<p></p>
		-->
		
		<br />	
                <?php wp_nonce_field('WidgetMaster_form_setting'); ?>
		<input type="hidden" name="WidgetMaster_features_submit" value="yes"/>
		<input name="WidgetMaster_submit" id="WidgetMaster_submit" class="button add-new-h2" value="Update Features" type="submit" />
		<input name="Help" lang="publish" class="button add-new-h2" onclick="window.open('https://awmcteam.wordpress.com/2015/06/29/widget-master/');" value="<?php _e('Help', 'widget-master'); ?>" type="button" />
		
	</form>
          
          
          
    </div>
    <p><br /><br /><br /><br /><br /><br /><br /></p>

    
</div>

