<?php
/*
Plugin Name: Widget Master
Description: Plugin allows user to to make all widgets hidden or visible per session on the website. Also you can track your widgets benefits as you can see how many times each widget has been cloosed by your visitors. Please set widget title to make it work with Widgets-Master.
Author: Tigran Hovhannisyan
Version: 1.2
Plugin URI: #
Author URI: #
Donate link: #
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/



include 'includes/wp-session-manager.php';


$wp_session = WP_Session::get_instance();
$WM_session_expiration = get_option('WidgetMaster_Session_Expiration');
add_filter( 'wp_session_expiration', function() { return $WM_session_expiration * 360; } ); // Set expiration to 

function WidgetMaster()
{    
    $show_hide_feature_status = get_option('WidgetMaster_Turn_On_Off_Features');
    if($show_hide_feature_status == "ON"){include 'features/hide-display-widgets.php';}
    
    $Open_Close_Main_Feature_status = get_option('WidgetMaster_Open_Close_Main_Feature');
    if($Open_Close_Main_Feature_status == "OFF"){return;}
    
    if (  is_admin() ) return; 
    
    
    function widget_params( $params ) {
        global $wp_session;
        //var_dump($wp_session);
        //var_dump($params);
        if(is_home() && get_option('WidgetMaster_On_Homepage') == 'NO') {return $params; }
	if(is_single() && get_option('WidgetMaster_On_Posts') == 'NO') {return $params;	}
	if(is_page() && get_option('WidgetMaster_On_Pages') == 'NO') {return $params;}
	if(is_archive() && get_option('WidgetMaster_On_Archives') == 'NO') {return $params;}
	if(is_search() && get_option('WidgetMaster_On_Search') == 'NO') {return $params;}
        
        
        // IF BEFORE AND AFTER WIDGET THERE AREN'T ANY TAGS ADDING WITH ID AND CLASS
        if(empty($params['0']['before_widget']) && empty($params['0']['after_widget'])){
            $params['0']['before_widget'] = "<span id='".$params['0']['widget_id']."' class='WM_WP_widget'>";
            $params['0']['after_widget'] = "</span>";
        }

        // IF BEFORE AND AFTER WIDGET-TITLE THERE AREN'T ANY TAGS ADDING WITH ID AND CLASS
        if(empty($params['0']['before_title']) && empty($params['0']['after_title'])){
            $params['0']['before_title'] = "<span  class='WM_widgettitle'>";
            $params['0']['after_title'] = "</span>";
        }

        // IF BEFORE AND AFTER WIDGET EXISTS BUT NO ID ATTRIBUTE ADDING ID
        if( strpos($params['0']['before_widget'], 'id=') === false ) {
            $params['0']['before_widget'] = preg_replace('/\bclass\b/', 'id="'.$params['0']['widget_id'].'"  class', $params['0']['before_widget'],1);
        }

        // IF BEFORE WIDGET TITLE HASEN'T CLASS ADDING
        if( strpos($params['0']['before_title'], 'class') === false ) {
            $params['0']['before_title'] = str_replace('>', ' class="widgettitle2" >', $params['0']['before_title']);
        }

        // CHECKING IF THE WIDGET IS CLOSED, ADDING WM_widgetclosed CLASS, ELSE ADDING WM_widgetopened CLASS
        if(isset($wp_session[$params['0']['widget_id']]) && $wp_session[$params['0']['widget_id']] == 'closed')
        {	
            $params['0']['before_widget'] = preg_replace('/\bclass="\b/', 'class=" WM_widget WM_widgetclosed ', $params['0']['before_widget'],1);
            $params['0']['before_widget'] = preg_replace("/\bclass='\b/", "class=' WM_widget WM_widgetclosed ", $params['0']['before_widget'],1);
        }
        else{

            $params['0']['before_widget'] = preg_replace('/\bclass="\b/', 'class=" WM_widget WM_widgetopened ', $params['0']['before_widget'],1);
            $params['0']['before_widget'] = preg_replace("/\bclass='\b/", "class=' WM_widget WM_widgetopened ", $params['0']['before_widget'],1);
        }
        
        $params['0']['before_widget'] = preg_replace('/\bclass\b/', 'name="'.$params['0']['widget_name'].'"  class', $params['0']['before_widget'],1);

        // ADDING OPEN/CLOSE ARROW/SYMBOL TO THE WIDGET TITLE
        $params['0']['after_title']  = "<span class='WMarrow'></span>".$params['0']['after_title'];

        // EXPLODE WIDGET TITLE STRING TO FIND WIDGET TITLE CLASS
        $searchForWidgetTitleClasses = explode("class=",$params['0']['before_title']);

        // IF THERE ARE MORE THAN 1 CLASSES GETTING THE FIRST WIDGET TITLE CLASS
        $searchForWidgetTitleClass = explode(' ',$searchForWidgetTitleClasses[1]);
        $searchForWidgetTitleClass = $searchForWidgetTitleClass[0];
        // REMOVE ADDITIONAL SYMBOLS AND WE HAVE WIDGET TITLE CLASS
        $searchForWidgetTitleClass = str_replace('"', '', $searchForWidgetTitleClass);
        $searchForWidgetTitleClass = str_replace('>', '', $searchForWidgetTitleClass);
        $searchForWidgetTitleClass = str_replace("'", '', $searchForWidgetTitleClass);

        // IF THE WIDGET TITLE IS INSIDE IN MORE THAN 1 TAGS F.X. DIV > SPAN > H2 -> TEXT, THEN THE TITLE ELEMENT WILL BE THE PARENT
        if( strpos($searchForWidgetTitleClass, '<') != false ) {
            $searchForWidgetTitleClass = explode('<',$searchForWidgetTitleClasses[1]);
            $searchForWidgetTitleClass = $searchForWidgetTitleClass[0];
            $searchForWidgetTitleClass = str_replace('"', '', $searchForWidgetTitleClass);
            $searchForWidgetTitleClass = str_replace('>', '', $searchForWidgetTitleClass);
            $searchForWidgetTitleClass = str_replace("'", '', $searchForWidgetTitleClass);
        }

        if(!isset($GLOBALS['WidgetTitleClass'][$searchForWidgetTitleClass])){
        $GLOBALS['WidgetTitleClass'][$searchForWidgetTitleClass] = $searchForWidgetTitleClass;
        $searchForWidgetTitleClass = ".".$searchForWidgetTitleClass; 
        
        $optionWidgetMaster_Border_Color = get_option('WidgetMaster_Border_Color');
        if(!empty($optionWidgetMaster_Border_Color)) {$WidgetMaster_Border_Color = "1px solid #".$optionWidgetMaster_Border_Color;}
        else{$WidgetMaster_Border_Color = 'none';}
        
        $optionWidgetMaster_Icon_Bg_color = get_option('WidgetMaster_Icon_Bg_color');
        if(!empty($optionWidgetMaster_Icon_Bg_color)) {$WidgetMaster_Icon_Bg_color = "#".$optionWidgetMaster_Icon_Bg_color;}
        else{$WidgetMaster_Icon_Bg_color = 'none';}
        
        $optionWidgetMaster_Icon_color = get_option('WidgetMaster_Icon_color');
        if(!empty($optionWidgetMaster_Icon_color)) {$WidgetMaster_Icon_color = "#".$optionWidgetMaster_Icon_color;}
        else{$WidgetMaster_Icon_color = 'inherit';}
            
            
        echo '
                <style>
                      .WM_widget '.$searchForWidgetTitleClass.' .WMarrow{
                        border: '.$WidgetMaster_Border_Color.';
                        border-radius:'.get_option('WidgetMaster_Border_Radius').'px;
                        color: '.$WidgetMaster_Icon_color.';
                        cursor: pointer;
                        display: inline-block;
                        font-size: '.get_option('WidgetMaster_Icon_size').'px;
                        background: '.$WidgetMaster_Icon_Bg_color.';
                        font-weight: bold;
                        line-height: '.get_option('WidgetMaster_Icon_size').'px;
                        padding: 0 7px;
                        position: absolute;
                        '.get_option('WidgetMaster_Icon_Align').': '.get_option('WidgetMaster_Icon_padding').'px;
                        text-align: center;
                        text-decoration: none !important;
                        vertical-align: bottom;
                      }
                    .WM_widgetopened '.$searchForWidgetTitleClass.' .WMarrow:after{
                        content: "'.get_option('WidgetMaster_Icon_Close').'";
                    }
                    .WM_widgetopened '.$searchForWidgetTitleClass.', .WM_widgetclosed '.$searchForWidgetTitleClass.'{
                        position:relative;
                        padding-'.get_option('WidgetMaster_Icon_Align').': 40px !important;
                    }
                    .WM_widgetclosed '.$searchForWidgetTitleClass.' .WMarrow:after {
                        content: "'.get_option('WidgetMaster_Icon_Open').'";
                    }
                    .WM_widgetclosed '.$searchForWidgetTitleClass.' ~ *{
                        display:none;
                    }
                </style>
            ';
            echo '
             <script>
                document.addEventListener("DOMContentLoaded",function(){
                    jQuery( ".WM_widgetclosed '.$searchForWidgetTitleClass.'" ).nextAll().css( "display", "none" );

                    jQuery(".WM_widgetopened '.$searchForWidgetTitleClass.', .WM_widgetclosed '.$searchForWidgetTitleClass.' .WMarrow").click(function(){
                        var widgetId = jQuery(this).parents(".WM_widget").attr("id");
                        var widgetName = jQuery(this).parents(".WM_widget").attr("name");
                        jQuery.ajax({
                                 url: "'.home_url().'?widgetid="+widgetId+"&widgetname="+encodeURIComponent(widgetName),
                                 timeout: 30000, 
                                 data: { "widgetid": widgetId }
                        });

                        var aside = jQuery(this).parents(".WM_widget");

                        if(aside.hasClass("WM_widgetclosed")){
                            aside.find( "'.$searchForWidgetTitleClass.'" ).nextAll().slideDown(1,function(){aside.removeClass("WM_widgetclosed");aside.addClass("WM_widgetopened"); });
                        }
                        else{
                            aside.find( "'.$searchForWidgetTitleClass.'" ).nextAll().slideUp(1,function(){aside.removeClass("WM_widgetopened");aside.addClass("WM_widgetclosed"); });
                        }
                    });
                })
                </script>   
            ';
        }
        return $params;
    }
    add_filter( 'dynamic_sidebar_params', 'widget_params' );

       
    if(isset($_GET['widgetid'])){
        $return = 'true';
        $widgetId = $_GET['widgetid'];
        if ( !is_active_widget( false,  $widgetId, true ) ) {
                $return = 'false';
        }
        global $wp_session;
        if(!isset($wp_session[$_GET['widgetid']])){
                $wp_session[$_GET['widgetid']] = 'closed';
                
                if( !get_option( "WM_widget_name_".sanitize_text_field(urldecode($_GET['widgetname'])) ) ) {
                    add_option("WM_widget_name_".sanitize_text_field(urldecode($_GET['widgetname'])), "1");
                } else {
                    $plusOne = get_option("WM_widget_name_".sanitize_text_field(urldecode($_GET['widgetname']))) + 1;
                    update_option("WM_widget_name_".sanitize_text_field(urldecode($_GET['widgetname'])), $plusOne );
                }
                
        }
        else{
                unset($wp_session[$_GET['widgetid']]);
        }

        exit($return);
    }
        


    if(!wp_script_is('jquery')) {
        function WM_load_my_script() {
             wp_enqueue_script( 'widget-master-jquery', get_option('siteurl') . '/wp-content/plugins/widget-master/jquery-1.11.3.min.js', array('jquery'), '1.0.1' );
        }

        add_action( 'wp_enqueue_scripts', 'WM_load_my_script' );


    }

}

function WidgetMaster_install() 
{
	global $wpdb, $wp_version;
	add_option('WidgetMaster_fromemail', "admin@contactform.com");
        
	add_option('WidgetMaster_On_Homepage', "YES");
	add_option('WidgetMaster_On_Posts', "YES");
	add_option('WidgetMaster_On_Pages', "YES");
	add_option('WidgetMaster_On_Archives', "YES");
	add_option('WidgetMaster_On_Search', "YES");
        
        add_option('WidgetMaster_Session_Expiration', "14400");
        
        add_option('WidgetMaster_Turn_On_Off_Features', "ON");
        add_option('WidgetMaster_Open_Close_Main_Feature', "ON");
        
	add_option('WidgetMaster_Icon_Open', "+");
        add_option('WidgetMaster_Icon_Close', "-");
        add_option('WidgetMaster_Icon_Align', "right");
	add_option('WidgetMaster_Border_Color', "b4b9be");
	add_option('WidgetMaster_Icon_color', "b4b9be");
        add_option('WidgetMaster_Icon_padding', "7");
        add_option('WidgetMaster_Icon_Bg_color', "");
        add_option('WidgetMaster_Icon_size', "10");
        add_option('WidgetMaster_Border_Radius', "0");
	
}

function WidgetMaster_control() 
{
	echo '<p>';
	_e('Check official website for more information', 'widget-master');
	?> <a target="_blank" href="https://awmcteam.wordpress.com/2015/06/29/widget-master/"><?php _e('click here', 'widget-master'); ?></a></p><?php
}

function WidgetMaster_deactivation() 
{
	// No action required.
}

function WidgetMaster_admin()
{
	global $wpdb;
	include('content-setting.php');
}

function WidgetMaster_add_to_menu() 
{
	add_options_page( __('Widget Master', 'widget-master'), __('Widget Master', 'widget-master'), 'manage_options', __FILE__, 'WidgetMaster_admin' );
        
}

if (is_admin()) 
{
	add_action('admin_menu', 'WidgetMaster_add_to_menu');
}

function WidgetMaster_textdomain() 
{
	  load_plugin_textdomain( 'widget-master', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

function WidgetMaster_plugin_query_vars($vars) 
{
	$vars[] = 'widgetmaster';
	return $vars;
}


add_filter('query_vars', 'WidgetMaster_plugin_query_vars');
add_action('plugins_loaded', 'WidgetMaster_textdomain');
register_activation_hook(__FILE__, 'WidgetMaster_install');
register_deactivation_hook(__FILE__, 'WidgetMaster_deactivation');
add_action('init', 'WidgetMaster');

?>