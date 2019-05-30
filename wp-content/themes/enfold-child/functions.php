<?php 
/* FEATURED BLOGSPOTS */

//checkbox

 function sm_custom_meta() {
    add_meta_box( 'sm_meta', __( 'Featured Posts', 'sm-textdomain' ), 'sm_meta_callback', 'post' );
}
function sm_meta_callback( $post ) {
    $featured = get_post_meta( $post->ID );
    ?>
 
	<p>
    <div class="sm-row-content">
        <label for="meta-checkbox">
            <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
            <?php _e( 'Featured this post', 'sm-textdomain' )?>
        </label>
        
    </div>
</p>
 
    <?php
}
add_action( 'add_meta_boxes', 'sm_custom_meta' );

//save meta data input

function sm_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
 // Checks for input and saves
if( isset( $_POST[ 'meta-checkbox' ] ) ) {
    update_post_meta( $post_id, 'meta-checkbox', 'yes' );
} else {
    update_post_meta( $post_id, 'meta-checkbox', '' );
}
 
}
add_action( 'save_post', 'sm_meta_save' );



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

    function counter(){

         if ( isset( $_COOKIE[ 'count' ] ) ) {
                ++$_COOKIE[ 'count' ];
             
               setcookie('count', $_COOKIE[ 'count' ], time() +3600);
        }
    }

     function load_visits() {
        register_widget( 'My_Counter_Widget' );
    }
    add_action( 'widgets_init', 'load_visits' );

 ?>




