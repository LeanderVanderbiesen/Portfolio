<?php 

//EMPLOYMENT WIDGET

class My_Employment_Widget extends WP_Widget {
   
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


//COUNTER WIDGET

    class My_Counter_Widget extends WP_Widget
    {
        
        function __construct()
        {   
            if ( isset( $_COOKIE[ 'count' ] ) ) 
            {
                $counter = ++$_COOKIE[ 'count' ];
                setcookie('count', $counter, time() +3600);
            }
            else{
                setcookie('count', 0 , time()+3600);
            }
            
            $options = array('classname' => 'Number of visits',
                'description' => 'Displays the total number of visits you have made to this site.'
            );
            parent::__construct('visits', 'Number of visits', $options);
        }

        public function widget($args, $instance)
        {
          
            $instance[ 'nrOfVisits' ] = $_COOKIE[ 'count' ];
            
            echo $args[ 'before_widget' ];
            if ( !$instance[ 'nrOfVisits' ] == 0) {
               echo $args[ 'before_title' ] . apply_filters( 'widget_title', 'Number of visits: ') . $instance[ 'nrOfVisits' ] . $args[ 'after_title' ];

            }
            
            echo $args[ 'after_widget' ];
        }
        public function update($new_instance, $old_instance)
        {
              $instance = $old_instance;
              $instance[ 'nrOfVisits' ] = strip_tags( $new_instance[ 'nrOfVisits' ] );
              return $instance;
        }
    }

     function load_visits() {
        register_widget( 'My_Counter_Widget' );
    }
    add_action( 'widgets_init', 'load_visits' );

    add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
 
    function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

 ?>




