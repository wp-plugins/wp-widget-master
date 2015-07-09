<?php
    wp_enqueue_style( 'optionscss', plugin_dir_url( __FILE__ ) .'style.css' );
    global $wpdb;
    $table_name = $wpdb->base_prefix . 'options';
    $querystr = "
        SELECT * 
        FROM ".$table_name."
        WHERE option_name LIKE 'WM_widget_name%'
        ORDER BY `".$table_name."`.`option_value` DESC
     ";

     $widgets = $wpdb->get_results($querystr, OBJECT);
     //var_dump($widgets);
?>

<div class="wrap">
    
    <div class="form-wrap">
      <div id="icon-plugins" class="icon32 icon32-posts-post"><br></div>
          <h2><?php _e('Widget Master', 'widget-master'); ?></h2>
          <ul class="settings-nav">
              <li><a href="<?php echo esc_url( get_admin_url(null, 'options-general.php?page=widget-master/widget-master.php') );?>">General</a></li>
              <li class="active"><a href="<?php echo esc_url( get_admin_url(null, 'options-general.php?page=widget-master/widget-master.php&report') );?>">Report</a></li>
          </ul>
          <h3><?php _e('Widget Master report', 'widget-master'); ?></h3>
          <?php
            if(empty($widgets)) echo "<h4 class='no-results'>No tracking registered yet :(</h4>";
          ?>
          <table class="wp-list-table widefat">
                <thead>
                <tr>
                    <th scope="col" class="manage-column"><strong>Widget name</strong></th>
                    <th scope="col" class="manage-column"><strong>How many times have been closed</strong></th>	
                </tr>
                </thead>
                <tbody id="the-list">
                    
                        <?php
                            foreach ($widgets as $widget){ ?>
                                <tr  class="iedit author-self  type-post status-publish format-standard hentry ">
                                    <td><strong><?php echo substr($widget->option_name, 15);?></strong></td>
                                    <td><strong><?php echo $widget->option_value;?></strong></td>
                                </tr>
                        <?php }?>
                        
                    
                </tbody>
          </table>
          
          
          
          
    </div>
    <p><br /><br /><br /></p>

    
</div>

