<?php 
/*
Plugin Name:Add Order 
Description:This Plugin is Used to add the Order in Your Post Types
Plugin URI:https://web.facebook.com/osama.somy
Author:Osama Somy
Author URI:https://web.facebook.com/osama.somy
*/

defined('ABSPATH') or die('Hey You Can\t Access this File...!');

class addOrderColumnPlugin{
	//===TRIGGER OTHER FUNCTIONS=====
	function __construct(){
		add_action( 'admin_menu', array($this,'plugin_settings_page') );
		add_action('admin_enqueue_scripts', array( $this, 'enqueue'));
		add_action( 'init', array($this,'save_form'));
		add_action( 'current_screen', array($this,'this_screen' ));
		add_action( 'pre_get_posts', array($this, 'closing_column_orderby' ));

	}
	//====ADD MENU====
	function plugin_settings_page(){
		add_menu_page(
            'Add Order Column Plugin',
            'Order Column Plugin Settings',
            'administrator',
            'add-order-page',
            array($this ,'plugin_settings_page_body'),
            'dashicons-plus',
            '90'
        );
	}
	//===CHECK POST TYPES====
	function this_screen(){
		$screen = get_current_screen();
		$post_type   = $screen ->post_type;
	 	$all_options = unserialize(get_option('osama_order_column_plugin'));
	 	if($post_type == 'page'){
	 		if(in_array($post_type, $all_options)){
				add_filter('manage_pages_columns',array($this,'columns_add'));
				add_action('manage_pages_custom_column',array($this,'columns_content'), 10, 2);
				add_filter('manage_edit-page_sortable_columns',array($this,'set_sortable_columns'));

			}
		}else if($post_type == 'post'){
			if(in_array($post_type, $all_options)){
				add_filter('manage_posts_columns',array($this,'columns_add'));
				add_action('manage_posts_custom_column',array($this,'columns_content'), 10, 2);
				
			}
		}else{
			if(in_array($post_type, $all_options)){
				add_filter('manage_'.$post_type.'_posts_columns',array($this,'columns_add'));
				add_action('manage_'.$post_type.'_posts_custom_column',array($this,'columns_content'), 10, 2);
				add_filter( 'manage_edit-'.$post_type.'_sortable_columns',array($this,'set_sortable_columns'));
			}
		}
	}
	//====SET CUSTOM QUERY FOR ORDRING========
	function closing_column_orderby( $query ) {  
	    if( ! is_admin() )  
	        return;  
		 $orderby = $query->get( 'orderby');  

	    if( 'Order' == $orderby ) {  
	        $query->set('orderby','menu_order');  
	    }  
	} 
	//====CONTENT OF COLUMNS==========
	function columns_content($column_name, $post_ID) {
			    if ($column_name == 'order') {
			    	$thispost   = get_post($post_ID);
					$menu_order = $thispost->menu_order;
					echo $menu_order;
			        
			    }
			}
	//=======ADD COLUMNS ============				
	function columns_add($coloums) {
			$coloums['order']="Order";
		    return $coloums;
	}
	//======SORTING =========
	function set_sortable_columns($coloums) {
			$coloums['order']="Order";
		    return $coloums;		
			
	}
	// ===BACK END BODY========
	function plugin_settings_page_body(){
		
		$args     = array( 'public' => true);
		$output   = 'names'; //'names'; // names or objects, note names is the default
		$operator = 'and'; // 'and' or 'or'
		$posts    = get_post_types( $args, $output, $operator );

		$all_options = unserialize(get_option('osama_order_column_plugin'));
			if(!$all_options ){
				$all_options=array();
			}
		 include("template-parts/checkform.php"); 
	}
	//AFTER FORM SUBMITION STORING CHECKED INPUTS IN DATABASE
	function save_form(){
		if($_GET['page']=='add-order-page' && $_POST){
			update_option('osama_order_column_plugin',  serialize($_POST['posts']));
		}
	}
	///////// SCRIPTS AND STYLESHEET  ////////////
	function enqueue(){
		// wp_enqueue_style('custom_plugin_css', plugins_url('/assets/style.css', __FILE__ ));
		// wp_enqueue_script("jquery");
		// wp_register_script('custom_plugin_js', plugins_url('/assets/script.js', __FILE__ ));
		wp_enqueue_script('custom_plugin_js', plugins_url('/assets/script.js', __FILE__ ));
	}
}

if(class_exists('addOrderColumnPlugin')){
	new addOrderColumnPlugin();
	// $addOrderPlugin->register();
}

?>