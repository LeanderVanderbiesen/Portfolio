<?php

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
    function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}
//EMPLOYMENT WIDGET

class My_Employment_Widget extends WP_Widget {
   
    public function __construct() {
        $options = array(
        'classname' => 'Current state of Employment',
        'description' => 'Select your current state of employment.',
         );
        parent::__construct(
        'state_of_employment', 'Current state of employment', $options);
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
        <select name="<?php echo $this->get_field_name( 'posttype' ); ?>"class="widefat">
            <option value="Unemployed" name="posttype"<?php selected( $instance[ 'posttype' ], 'Unemployed') ?>> Unemployed</option>
            <option value="Jobseeking" name="posttype"<?php selected( $instance[ 'posttype' ], 'Jobseeking') ?>> Job seeking</option>
            <option value="Employed" name="posttype"<?php selected( $instance[ 'posttype' ], 'Employed') ?>> Employed</option>
        </select>
        <p></p>
      <?php 
    }

    public function update( $new_instance, $old_instance ) 
    {
          $instance = $old_instance;
          $instance[ 'posttype' ] = strip_tags( $new_instance[ 'posttype' ] );
          return $instance;
    }
}

    function load_employment() {
        register_widget( 'My_Employment_Widget' );
    }
    add_action( 'widgets_init', 'load_employment' );

?>