<?php 
	wp_enqueue_style('custom_plugin_css',plugins_url('/assets/style.css', __FILE__ ));
	wp_enqueue_script("jquery");
	wp_register_script('custom_plugin_js',plugins_url('/assets/script.js', __FILE__ ));
	wp_enqueue_script('custom_plugin_js',plugins_url('/assets/script.js', __FILE__ ));

?>