<?php 
/*
	Plugin Name: State of employment
	Plugin URI: https://www.sitepoint.com/
	Description: Select current state of employment
	Version: 1.0
	Author: Leander
	Author URI: https://www.sitepoint.com/
	License: GPL2
*/

class My_Custom_Widget extends WP_Widget {

    public function __construct() {
    	$options = array(
        'classname' => 'Current state of Employment',
        'description' => 'Select your current state of employment.',
    );
    	parent::__construct(
        'state_of_employment', 'Current state of employment', $options
    );
    }

    public function widget( $args, $instance ) {
       
	    echo $args['before_widget'];

	    echo $args['before_title'] . apply_filters( 'widget_title', 'Current state of employment:' ) . $args['after_title'];
	    echo $instance['posttype'];

	  
	    echo $args['after_widget'];
    }

    public function form( $instance )
     {
		 ?>
		 <p></p>
		<select name="<?php echo $this->get_field_name('posttype' ); ?>"class="widefat">
			<option value="Unemployed" name="posttype"<?php selected( $instance[ 'posttype' ], 'Unemployed') ?>> Unemployed</option>
			<option value="Jobseeking" name="posttype"<?php selected( $instance[ 'posttype' ], 'Jobseeking') ?>> Job seeking</option>
			<option value="Employed" name="posttype"<?php selected( $instance[ 'posttype' ], 'Employed') ?>> Employed</option>
		</select>
		<p></p>
	  <?php 
	}

		public function update( $new_instance, $old_instance ) {
		  $instance = $old_instance;
		  $instance[ 'posttype' ] = strip_tags( $new_instance[ 'posttype' ] );
		  return $instance;
}
}

	/*function my_register_custom_widget() {
	    register_widget( 'My_Custom_Widget' );
	}
	add_action( 'widgets_init', 'my_register_custom_widget' );*/
	function load_employment() {
	    register_widget( 'My_Custom_Widget' );
	}
	add_action( 'widgets_init', 'load_employment' );

 ?>