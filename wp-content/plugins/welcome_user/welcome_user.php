<?php 
/**
	Plugin Name: Welcome the user!
	Plugin URI: https://www.sitepoint.com/
	Description: Simple plugin to welcome your visitor depending on the time!
	Version: 1.0
	Author: Leander
	Author URI: https://www.sitepoint.com/
	License: GPL2
*/
	class My_GreetUser_Widget extends WP_Widget
	{


		public function __construct()
		{
			$options = array(
	        'classname' => 'Welcome',
	        'description' => 'Welcome your user.',
    		);
    		set_cookie();

	    	parent::__construct( 'welcome_user', 'Welcome the visitor', $options );
		}

		 public function widget( $args, $instance ) 
		 {


		 	$Hour = date('G');
			if ( $Hour >= 5 && $Hour <= 11 ) {
			   $instance['message'] = "Good Morning";
			} else if ( $Hour >= 12 && $Hour <= 18 ) {
			  $instance['message'] = "Good Afternoon";
			} else if ( $Hour >= 19 || $Hour <= 4 ) {
			   $instance['message'] ="Good Evening";
			}
       		
       		if ( !$_COOKIE[ 'visited' ]) 
       		{
       			 echo $args['before_widget'];

			    echo $args['before_title'] . $instance['message'] . apply_filters( 'widget_title', ', Welcome!' ) . $args['after_title'];
			  
			    echo $args['after_widget'];
       		}
       		else
       		{
       			 echo $args['before_widget'];

		   		 echo $args['before_title'] . $instance['message'] . apply_filters( 'widget_title', ', Welcome back!' ) . $args['after_title'];
		    	 
		   		 echo $args['after_widget'];
       		}
	    }
	}

	 function set_cookie()
	{
		if ( !isset( $_COOKIE[ 'visited'] ) ) 
		{
			setcookie( 'visited', TRUE, time() + 3600, "/");
		}
		
	}	
	/* function message_func($atts)
	 {
		 return "test";
	 }  
	add_shortcode( 'welcome_user', 'message_func');*/

	function my_register_custom_widget() 
	{
	    register_widget( 'My_GreetUser_Widget' );
	}
	add_action( 'widgets_init', 'my_register_custom_widget' );	
?>