<?php 
/*
Plugin Name:Add Order 
Description:This Plugin is Used to add the Order in Your All Pages
Plugin URI:https://web.facebook.com/osama.somy
Author:Osama Somy
Author URI:https://web.facebook.com/osama.somy
*/
//$order_slug =
// add_action( 'current_screen', 'this_screen' );

// function this_screen(){
// 	$screen = get_current_screen();
// 	$post_type   = $screen ->post_type;
//  	$all_options = unserialize(get_option('osama_order_column_plugin'));
//  	if($post_type == 'page'){
//  		if(in_array($post_type, $all_options)){
// 			add_filter('manage_pages_columns','columns_add');
// 			add_action('manage_pages_custom_column', 'columns_content', 10, 2);
// 			add_filter('manage_edit-page_sortable_columns', 'set_sortable_columns');

// 		}
// 	}else if($post_type == 'post'){
// 		if(in_array($post_type, $all_options)){
// 			add_filter('manage_posts_columns','columns_add');
// 			add_action('manage_posts_custom_column', 'columns_content', 10, 2);
			
// 		}
// 	}else{
// 		if(in_array($post_type, $all_options)){
// 			add_filter('manage_'.$post_type.'_posts_columns','columns_add');
// 			add_action('manage_'.$post_type.'_posts_custom_column', 'columns_content', 10, 2);
// 			add_filter( 'manage_edit-'.$post_type.'_sortable_columns', 'set_sortable_columns');
// 		}
// 	}
// }
// if (isset($_GET['post_type']) || true) {
// 	//$post_type   = $screen->parent_base;
	
//  } 
//add_filter('manage_posts_columns','columns_add');

 if($_GET['page']=='add-order-page'){
	if($_POST){
 		
		update_option('osama_order_column_plugin',  serialize($_POST['posts']));

	// $args     	 = array( 'public' => true );
	// $output    	 = 'names'; //'names'; // names or objects, note names is the default
	// $operator 	 = 'and'; // 'and' or 'or'
	// $posts    	 = get_post_types( $args, $output, $operator );

	// $diff      = array_diff($posts,$_POST['posts']);
	
	// foreach ($diff as $key => $value) {
	// 	if($value[0] == 'page'){
	// 		add_filter('manage_pages_columns','columns_remove');
	// 	}else if($value[0] == 'post'){
	// 		add_filter('manage_posts_columns','columns_remove');
	// 	}else{
			
	// 		add_filter('manage_'.$value[0].'_posts_columns','columns_remove');
	// 	}
	// }
	// foreach ($_POST['posts'] as $key => $value) {
	// 	if($value[0] == 'page'){
	// 		add_filter('manage_pages_columns','columns_add');
	// 	}else if($value[0] == 'post'){
	// 		add_filter('manage_posts_columns','columns_add');
	// 	}else{
	// 		add_filter('manage_'.$value[0].'_posts_columns','columns_add');
	// 	}
	// }
	

	}
}

	

defined('ABSPATH') or die('Hey You Can\t Access this File...!');
	class addOrderPlugin{
		
		function __construct(){
			add_action('admin_menu',array($this,'my_plugin_settings'));
			add_action( 'current_screen',array($this,'this_screen' ));
			add_action( 'pre_get_posts',array($this, 'closing_column_orderby' ));

		}
		function register(){
			add_action('admin_enqueue_scripts',array( $this, 'enqueue'));
			add_action('wp_enqueue_scripts',array( $this, 'enqueue'));
		}
		function test(){

			add_filter('manage_products_posts_columns',array($this, 'columns_head'));
			//add_action('manage_posts_custom_column', 'ST4_columns_content', 10, 2);

			// add_action('manage_posts_custom_column', 'ST4_columns_content', 10, 2);
		}
		function activate(){
			echo "the plugin was activated";
		}
		function deactivate(){
			echo "the plugin was activated";
		}
		function uninstall(){

		}
		function columns_head($coloums) {
			
			$coloums['order']="Order";
		    return $coloums;
		}
		function my_plugin_settings(){
			add_menu_page(
	            'Add Order Plugin',
	            'Order Pages',
	            'administrator',
	            'add-order-page',
	            array($this ,'my_plugin_settings_page'),
	            'dashicons-plus',
	            '90'
	        );
		}
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
		function closing_column_orderby( $query ) {  
		    if( ! is_admin() )  
		        return;  

		    $orderby = $query->get( 'orderby');  

		    if( 'Order' == $orderby ) {  
		        $query->set('orderby','menu_order');  
		    }  
		} 
		function columns_content($column_name, $post_ID) {
				    if ($column_name == 'order') {
				    	$thispost = get_post($post_ID);
						$menu_order = $thispost->menu_order;
						echo $menu_order;
				        
				    }
				}
		function columns_add($coloums) {
				$coloums['order']="Order";
			    return $coloums;
		}
		function set_sortable_columns($coloums) {
				$coloums['order']="Order";
			    return $coloums;		
				
		}
		function my_plugin_settings_page(){
			
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
		/////////////////////
		function enqueue(){
			wp_enqueue_style('custom_plugin_css',plugins_url('/assets/style.css', __FILE__ ));
			wp_enqueue_script("jquery");
			wp_register_script('custom_plugin_js',plugins_url('/assets/script.js', __FILE__ ));
			wp_enqueue_script('custom_plugin_js',plugins_url('/assets/script.js', __FILE__ ));
		}


	}

	if(class_exists('addOrderPlugin')){
		$addOrderPlugin=new addOrderPlugin();
		$addOrderPlugin->register();
	}

	// activation
	register_activation_hook(__FILE__,array($addOrderPlugin,'activate'));
	// Deactivation
	register_deactivation_hook(__FILE__,array($addOrderPlugin,'deactivate'));
	// uninstall
	// register_activation_hook(__FILE__,array($addOrderPlugin,'uninstall'));

?>