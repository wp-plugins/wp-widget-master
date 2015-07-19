<?php
    
    if(isset($_GET['report'])){
        
        include "report.php";
        
    }
    if(isset($_GET['turn_on_off_features'])){
        
        include "turn_on_off_features.php";
        
    }
    if(isset($_GET['widgets_pack'])){
        
        include "widgets_pack.php";
        
    }
    
    wp_enqueue_style( 'optionscss', plugin_dir_url( __FILE__ ) .'style.css' );
    wp_enqueue_script( 'colorpickerjs', plugin_dir_url( __FILE__ ) .'colorpicker/colorpicker.js');
    wp_enqueue_style( 'colorpickercss', plugin_dir_url( __FILE__ ) .'colorpicker/colorpicker.css' );

    
    //add_action( 'admin_enqueue_scripts', 'sh_load_my_script' );
?>
<?php if(!isset($_GET['nomainpage'])):?>
<div class="wrap">
    
    <div class="form-wrap">
        <div id="icon-plugins" class="icon32 icon32-posts-post"><br>
        </div>
        <div class="clouds-sm">
            <h2><?php _e('Widget Master', 'widget-master'); ?></h2>
        </div>
        
    
    <ul class="settings-nav">
        <li class="active"><a href="<?php echo esc_url( get_admin_url(null, 'options-general.php?page=wp-widget-master/widget-master.php') );?>">General</a></li>
        <li><a href="<?php echo esc_url( get_admin_url(null, 'options-general.php?page=wp-widget-master/widget-master.php&report&nomainpage') );?>">Report</a></li>
        <li><a href="<?php echo esc_url( get_admin_url(null, 'options-general.php?page=wp-widget-master/widget-master.php&turn_on_off_features&nomainpage') );?>">Turn On/Off features</a></li>
        <li style="border-bottom:1px solid #81a844;"><a href="<?php echo esc_url( get_admin_url(null, 'options-general.php?page=wp-widget-master/widget-master.php&widgets_pack&nomainpage') );?>">Widgets Pack</a></li>
    </ul>
    <?php
	$WidgetMaster_On_Homepage = get_option('WidgetMaster_On_Homepage');
	$WidgetMaster_On_Posts = get_option('WidgetMaster_On_Posts');
	$WidgetMaster_On_Pages = get_option('WidgetMaster_On_Pages');
	$WidgetMaster_On_Search = get_option('WidgetMaster_On_Search');
	$WidgetMaster_On_Archives = get_option('WidgetMaster_On_Archives');
	$WidgetMaster_Icon_Align = get_option('WidgetMaster_Icon_Align');
	$WidgetMaster_Border_Color = get_option('WidgetMaster_Border_Color');
        $WidgetMaster_Icon_padding = get_option('WidgetMaster_Icon_padding');
        $WidgetMaster_Icon_size = get_option('WidgetMaster_Icon_size');
        $WidgetMaster_Icon_Open = get_option('WidgetMaster_Icon_Open');
        $WidgetMaster_Icon_Close = get_option('WidgetMaster_Icon_Close');
        $WidgetMaster_Icon_color = get_option('WidgetMaster_Icon_color');
        $WidgetMaster_Icon_Bg_color = get_option('WidgetMaster_Icon_Bg_color');
	$WidgetMaster_Border_Radius = get_option('WidgetMaster_Border_Radius');
        
        $WidgetMaster_Session_Expiration = get_option('WidgetMaster_Session_Expiration');
        if(strlen($WidgetMaster_Session_Expiration) < 1){$WidgetMaster_Session_Expiration = 14400;}
	
	if (isset($_POST['WidgetMaster_form_submit']) && $_POST['WidgetMaster_form_submit'] == 'yes')
	{
		//	Just security thingy that wordpress offers us
		check_admin_referer('WidgetMaster_form_setting');
			
		$WidgetMaster_On_Homepage = sanitize_text_field($_POST['WidgetMaster_On_Homepage']);
		$WidgetMaster_On_Posts = sanitize_text_field($_POST['WidgetMaster_On_Posts']);
		$WidgetMaster_On_Pages = sanitize_text_field($_POST['WidgetMaster_On_Pages']);
		$WidgetMaster_On_Search = sanitize_text_field($_POST['WidgetMaster_On_Search']);
		$WidgetMaster_On_Archives = sanitize_text_field($_POST['WidgetMaster_On_Archives']);
		$WidgetMaster_Icon_Align = sanitize_text_field($_POST['WidgetMaster_Icon_Align']);
		$WidgetMaster_Border_Color = sanitize_text_field($_POST['WidgetMaster_Border_Color']); if(strlen($WidgetMaster_Border_Color) > 6)$WidgetMaster_Border_Color = substr( $WidgetMaster_Border_Color, 0, 6 );
                $WidgetMaster_Icon_padding = sanitize_text_field($_POST['WidgetMaster_Icon_padding']);
                $WidgetMaster_Icon_size = intval($_POST['WidgetMaster_Icon_size']);
                $WidgetMaster_Icon_Open = sanitize_text_field(stripslashes($_POST['WidgetMaster_Icon_Open']));
                $WidgetMaster_Icon_Close = sanitize_text_field(stripslashes($_POST['WidgetMaster_Icon_Close']));
                $WidgetMaster_Icon_color = sanitize_text_field($_POST['WidgetMaster_Icon_color']);if(strlen($WidgetMaster_Icon_color) > 6)$WidgetMaster_Icon_color = substr( $WidgetMaster_Icon_color, 0, 6 );
                $WidgetMaster_Icon_Bg_color = sanitize_text_field($_POST['WidgetMaster_Icon_Bg_color']);if(strlen($WidgetMaster_Icon_Bg_color) > 6)$WidgetMaster_Icon_Bg_color = substr( $WidgetMaster_Icon_Bg_color, 0, 6 );
		$WidgetMaster_Border_Radius = intval($_POST['WidgetMaster_Border_Radius']);
                
                $WidgetMaster_Session_Expiration = intval($_POST['WidgetMaster_Session_Expiration']);
		
		update_option('WidgetMaster_On_Homepage', $WidgetMaster_On_Homepage );
		update_option('WidgetMaster_On_Posts', $WidgetMaster_On_Posts );
		update_option('WidgetMaster_On_Pages', $WidgetMaster_On_Pages );
		update_option('WidgetMaster_On_Search', $WidgetMaster_On_Search );
		update_option('WidgetMaster_On_Archives', $WidgetMaster_On_Archives );
		update_option('WidgetMaster_Icon_Align', $WidgetMaster_Icon_Align );
                update_option('WidgetMaster_Icon_size', $WidgetMaster_Icon_size);
                update_option('WidgetMaster_Border_Color', $WidgetMaster_Border_Color);
                update_option('WidgetMaster_Icon_padding', $WidgetMaster_Icon_padding);
                update_option('WidgetMaster_Icon_Close', $WidgetMaster_Icon_Close);
                update_option('WidgetMaster_Icon_Open', $WidgetMaster_Icon_Open);
		update_option('WidgetMaster_Icon_color', $WidgetMaster_Icon_color );
                update_option('WidgetMaster_Icon_Bg_color', $WidgetMaster_Icon_Bg_color );
		update_option('WidgetMaster_Border_Radius', $WidgetMaster_Border_Radius );
                update_option('WidgetMaster_Session_Expiration', $WidgetMaster_Session_Expiration );
		
		?>
		<div class="updated fade">
			<p><strong><?php _e('Details successfully updated.', 'widget-master'); ?></strong></p>
		</div>
		<?php
	}
	?>
	<h3><?php _e('Widget Master Icon styles', 'widget-master'); ?></h3>
        
        
        
        



        
        
        
	<form name="sdp_form" method="post" action="">
                
                <label ><?php _e('The maximize icon symbol or text', 'widget-master'); ?></label>
		<input name="WidgetMaster_Icon_Open" type="text" id="WidgetMaster_Icon_Open" value="<?php echo $WidgetMaster_Icon_Open; ?>" size="5"  />
                <p>You can use CSS Escapes of html entities, f.x. \2193 (Narrow down)</p>
                <p></p>
                
                <label ><?php _e('The minimize icon symbol or text', 'widget-master'); ?></label>
		<input name="WidgetMaster_Icon_Close" type="text" id="WidgetMaster_Icon_Close" value="<?php echo $WidgetMaster_Icon_Close; ?>" size="5"  />
                <p>You can use CSS Escapes of html entities, f.x. \2191 (Narrow up)</p>
                <p></p>
                
                <label ><?php _e('The zise of the symbols or text', 'widget-master'); ?></label>
		<input name="WidgetMaster_Icon_size" type="text" id="WidgetMaster_Icon_size" value="<?php echo $WidgetMaster_Icon_size; ?>" size="5"  />px
                <p></p>
                <p></p>
                
		<label for="tag-image"><?php _e('Align the open/close button to the left or right of the title AND set the padding from side choosen. This can be also negative value, f.x. -15px.', 'widget-master'); ?></label>
                <select name="WidgetMaster_Icon_Align" id="WidgetMaster_Icon_Align">
			<option value='left' <?php if($WidgetMaster_Icon_Align == 'left') { echo 'selected' ; } ?>>Left</option>
			<option value='right' <?php if($WidgetMaster_Icon_Align == 'right') { echo 'selected' ; } ?>>Right</option>
		</select>
                &nbsp; <input name="WidgetMaster_Icon_padding" type="text" id="WidgetMaster_Icon_padding" value="<?php echo $WidgetMaster_Icon_padding; ?>" size="5"  />px
                <p></p>
		
                
                
		<label ><?php _e('Choose the open/close icon border color or leave empty if you want to use border.', 'widget-master'); ?></label>
		<input name="WidgetMaster_Border_Color" type="text" id="WidgetMaster_Border_Color" value="<?php echo $WidgetMaster_Border_Color; ?>" size="10"  />
                <p></p>
                
                <label ><?php _e('Choose the open/close icon color', 'widget-master'); ?></label>
		<input name="WidgetMaster_Icon_color" type="text" id="WidgetMaster_Icon_color" value="<?php echo $WidgetMaster_Icon_color; ?>" size="10"  />
		<p></p>
                
                <label ><?php _e('Choose the open/close icon background color', 'widget-master'); ?></label>
		<input name="WidgetMaster_Icon_Bg_color" type="text" id="WidgetMaster_Icon_Bg_color" value="<?php echo $WidgetMaster_Icon_Bg_color; ?>" size="10"  />
		<p></p>
		
		<label for="tag-image"><?php _e('Set the open/close icon border-radius in pixels', 'widget-master'); ?></label>
		<input name="WidgetMaster_Border_Radius" type="text" id="WidgetMaster_Border_Radius" value="<?php echo $WidgetMaster_Border_Radius; ?>" size="5"  />px
		<p><?php _e('This box is to add the contact us Image Button or Text, Entered value will display in the front end.', 'widget-master'); ?></p>
	
		<div style="height:5px;"></div>
		<h3><?php _e('Choose on what pages you want to turn on Widget Master', 'widget-master'); ?></h3>
				
		<label for="tag-title"><?php _e('On home page display', 'widget-master'); ?></label>
		<select name="WidgetMaster_On_Homepage" id="WidgetMaster_On_Homepage">
			<option value='YES' <?php if($WidgetMaster_On_Homepage == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($WidgetMaster_On_Homepage == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p><?php _e('Select YES if you need to display on home page.', 'widget-master'); ?></p>
		
		<label for="tag-title"><?php _e('On posts display', 'widget-master'); ?></label>
		<select name="WidgetMaster_On_Posts" id="WidgetMaster_On_Posts">
			<option value='YES' <?php if($WidgetMaster_On_Posts == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($WidgetMaster_On_Posts == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p><?php _e('Select YES if you need to display on posts.', 'widget-master'); ?></p>
		
		<label for="tag-title"><?php _e('On pages display', 'widget-master'); ?></label>
		<select name="WidgetMaster_On_Pages" id="WidgetMaster_On_Pages">
			<option value='YES' <?php if($WidgetMaster_On_Pages == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($WidgetMaster_On_Pages == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p><?php _e('Select YES if you need to display on wordpress pages.', 'widget-master'); ?></p>
		
		<label for="tag-title"><?php _e('On search page display', 'widget-master'); ?></label>
		<select name="WidgetMaster_On_Search" id="WidgetMaster_On_Search">
			<option value='YES' <?php if($WidgetMaster_On_Search == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($WidgetMaster_On_Search == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p><?php _e('Select YES if you need to display on search pages.', 'widget-master'); ?></p>
		
		<label for="tag-title"><?php _e('On archive page display', 'widget-master'); ?></label>
		<select name="WidgetMaster_On_Archives" id="WidgetMaster_On_Archives">
			<option value='YES' <?php if($WidgetMaster_On_Archives == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($WidgetMaster_On_Archives == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p><?php _e('Select YES if you need to display on archive pages.', 'widget-master'); ?></p>
		
                <label for="tag-title">Session expiration time</label>
		<input name="WidgetMaster_Session_Expiration" type="text" id="WidgetMaster_Session_Expiration" value="<?php echo $WidgetMaster_Session_Expiration; ?>" size="5"  />
		<p>Set how long do you want to save opened/closed widgets, then reset. Default is 14400 minutes(10 days)</p>
		
                
		<br />	
                <?php wp_nonce_field('WidgetMaster_form_setting'); ?>
		<input type="hidden" name="WidgetMaster_form_submit" value="yes"/>
		<input name="WidgetMaster_submit" id="WidgetMaster_submit" class="button add-new-h2" value="<?php _e('Update All Details', 'widget-master'); ?>" type="submit" />
		<input name="Help" lang="publish" class="button add-new-h2" onclick="window.open('https://awmcteam.wordpress.com/2015/06/29/widget-master/');" value="<?php _e('Help', 'widget-master'); ?>" type="button" />
		
	</form>
  </div>
  <h3><?php _e('Plugin configuration option', 'widget-master'); ?></h3>
	<ol>
		<li><?php _e('Drag and drop the plugin widget to your sidebar.', 'widget-master'); ?></li>
		<li><?php _e('Add plugin in the posts or pages using short code.', 'widget-master'); ?></li>
		<li><?php _e('Add directly in to the theme using PHP code.', 'widget-master'); ?></li>
	</ol>
  <p class="description"><?php _e('Check official website for more information', 'widget-master'); ?> 
  <a target="_blank" href="https://awmcteam.wordpress.com/2015/06/29/widget-master/"><?php _e('click here', 'widget-master'); ?></a></p>
</div>
<script type="text/javascript">
    
document.addEventListener("DOMContentLoaded",function(){
    
    jQuery('#WidgetMaster_Border_Color, #WidgetMaster_Icon_color, #WidgetMaster_Icon_Bg_color').ColorPicker({
            onSubmit: function(hsb, hex, rgb, el) {
                    jQuery(el).val(hex);
                    jQuery(el).ColorPickerHide();
            },
            onBeforeShow: function () {
                    jQuery(this).ColorPickerSetColor(this.value);
            }
    })
    .bind('keyup', function(){
            jQuery(this).ColorPickerSetColor(this.value);
    });
    
});
</script>

<?php endif; ?>