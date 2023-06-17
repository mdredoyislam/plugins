<?php 
/**
* Widget API: Class Widget class
* By : Radius Theme
*/
Class GymatTheme_Class_Widget extends WP_Widget {
	public function __construct() {
        
		$widget_ops = array(
			'classname' => 'rt-class-post',
			'description' => esc_html__( 'Other class display widget.It should be used only class sidebar.' , 'gymat-core' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'rt-class-post', esc_html__( 'Gymat : Class Display' , 'gymat-core' ), $widget_ops );
	}
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		if(is_post_type_archive( 'gymat_class' ) || is_singular('gymat_class')){
            $post_id = get_the_id();	
		    $current_post = array( $post_id );
        }
        else{
            $current_post=array();
            $post_id ='';
        }
		$title          = ( !empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Other Classes', 'gymat-core');
		$title          = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number         = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 6;
		$schedule_limit = ( ! empty( $instance['schedule_limit'] ) ) ? absint( $instance['schedule_limit'] ) : 1;
		if ( ! $number )
			$number = 6;
        $weeknames = array(
            'mon' => esc_html__( 'Monday', 'gymat-core' ),
            'tue' => esc_html__( 'Tuesday', 'gymat-core' ),
            'wed' => esc_html__( 'Wednesday', 'gymat-core' ),
            'thu' => esc_html__( 'Thursday', 'gymat-core' ),
            'fri' => esc_html__( 'Friday', 'gymat-core' ),
            'sat' => esc_html__( 'Saturday', 'gymat-core' ),
            'sun' => esc_html__( 'Sunday', 'gymat-core' ),
        );
        $result_query = new WP_Query( apply_filters( 'widget_posts_args', array(
            'post_type'           =>'gymat_class',
            'posts_per_page'      => $number,
            'post__not_in'        => $current_post,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true
        ) ) );			
		
		if ($result_query->have_posts()) :
            
		?>
		<?php echo wp_kses_post($args['before_widget']); ?>
		<?php if ( $title ) {
			echo wp_kses_post($args['before_title']) . $title . wp_kses_post($args['after_title']);
		} ?>
		<div class="class-schedule-widget">
		<?php while ( $result_query->have_posts() ) {
				$result_query->the_post(); 
                $schedule 			= get_post_meta( get_the_id(), 'gymat_class_schedule', true );
                $schedule 			= ( $schedule != '' ) ? $schedule : array();
                if ( $schedule_limit ) {
                    $schedule = array_slice( $schedule, 0, $schedule_limit );
                }
                
                ?>
			
			<div class="class-item">
				<div class="media">
                    <?php if ( has_post_thumbnail() ){ ?>
                        <a class="post-img-holder img-opacity-hover" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
                                if ( has_post_thumbnail() ){
                                    the_post_thumbnail( 'thumbnail', ['class' => 'media-object'] );
                                } else {
                                    if ( $show_no_preview_img == 'view' ) { ?>
                                        <img class="rt-lazy" src="<?php echo esc_url( GYMAT_IMG_URL ); ?>noimage_400X400.jpg" alt="<?php the_title_attribute(); ?>">
                                <?php }
                                }
                            ?></a>
                    <?php } ?>
					
				</div>
				<div class="media-body">
					<h3 class="entry-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a>
					</h3>
					<ul class="schedule-meta">
                        <?php foreach ( $schedule as $schedule_info ): ?>
                            <?php if ( !empty( $schedule_info['week'] ) && !empty( $schedule_info['start_time'] ) ): ?>
                                <?php
                                $start_time = !empty( $schedule_info['start_time'] ) ? strtotime( $schedule_info['start_time'] ) : false;
                                $type = !empty( $schedule_info['trainer'] ) ? get_post_type( $schedule_info['trainer'] ) : '';
                                if ( $type == 'gymat_trainer' ) {
                                    $trainer_name= get_the_title( $schedule_info['trainer'] );
                                }
                                if ( GymatTheme::$options['class_time_format'] == '24' ) {
                                    $start_time = $start_time ? date( "H:i", $start_time ) : '';
                                }
                                else {
                                    $start_time = $start_time ? date( "g:i a", $start_time ) : '';
                                }
                                ?>
                                <li>
                                    <span class="day"><?php echo esc_html( $weeknames[$schedule_info['week']] );?>:</span>
                                    <span class="time"><?php echo esc_html( $start_time );?></span>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
				    </ul>
				</div>
			</div>
			<?php } ?>
		      
		</div>
		<?php echo wp_kses_post($args['after_widget']); ?>
		<?php
		wp_reset_postdata();
		endif;
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance 				          = $old_instance;
		$instance['title'] 		          = sanitize_text_field( $new_instance['title'] );
		$instance['number'] 	          = (int) $new_instance['number'];
		$instance['schedule_limit'] 	  = (int) $new_instance['schedule_limit'];
		return $instance;
	}
	
	public function form( $instance ) {
		$title              = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number             = isset( $instance['number'] ) ? absint( $instance['number'] ) : 6;
		$schedule_limit     = isset( $instance['schedule_limit'] ) ? absint( $instance['schedule_limit'] ) : 1;
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:' , 'gymat-core' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title); ?>" /></p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of posts to show:', 'gymat-core' ); ?></label>
			<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number); ?>" size="3" /></p>
            <p><label for="<?php echo esc_attr( $this->get_field_id( 'schedule_limit' )); ?>"><?php esc_html_e( 'Number of schedule to show:', 'gymat-core' ); ?></label>
			<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'schedule_limit' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'schedule_limit' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $schedule_limit); ?>" size="3" /></p>

		<?php
	}	
}