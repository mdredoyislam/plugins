<?php
/**
* Widget API: Specific Opening Hour Widget class
* By : Radius Theme
*/
class GymatTheme_Working_Hours extends WP_Widget {
	public $weekdays;
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget-wroking-hours',
			'description' => esc_html__( 'Display working hours' , 'gymat-core' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'rt-working-hours', esc_html__( 'Gymat : Working Hours' , 'gymat-core' ), $widget_ops );	
		
	}
	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		
		echo wp_kses_post( $args['before_widget'] );
		if ( ! empty( $title ) ) {
			echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
		} ?>		
		<ul class="working-time-list">
			<?php if($instance['day1']){ ?>
				<li class="day"><?php echo wp_kses_post($instance['day1']); ?></li>
			<?php } if($instance['day1_time']){ ?>
				<li class="time"><?php echo wp_kses_post($instance['day1_time']); ?></li>
			<?php } ?>
			<?php if($instance['day2']){ ?>
				<li class="day"><?php echo wp_kses_post($instance['day2']); ?></li>
			<?php } if($instance['day2_time']){ ?>
				<li class="time"><?php echo wp_kses_post($instance['day2_time']); ?></li>
			<?php } if($instance['holiday']){ ?>
				<li class="day"><?php echo wp_kses_post($instance['holiday']." "); ?><span><?php esc_html_e('Close','gymat-core'); ?></span></li>
			<?php } ?>		
		</ul>
		<?php
		echo wp_kses_post( $args['after_widget'] );
	}
	public function update( $new_instance, $old_instance ) {
		$instance                  = array();
		$instance['title']         = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['day1']          = ( ! empty( $new_instance['day1'] ) ) ? sanitize_text_field( $new_instance['day1'] ) : '';
		$instance['day2']          = ( ! empty( $new_instance['day2'] ) ) ? sanitize_text_field( $new_instance['day2'] ) : '';
		$instance['day1_time']     = ( ! empty( $new_instance['day1_time'] ) ) ? sanitize_text_field( $new_instance['day1_time'] ) : '';
		$instance['day2_time']     = ( ! empty( $new_instance['day2_time'] ) ) ? sanitize_text_field( $new_instance['day2_time'] ) : '';
		$instance['holiday']       = ( ! empty( $new_instance['holiday'] ) ) ? sanitize_text_field( $new_instance['holiday'] ) : '';

		return $instance;
	}
	// the form
	public function form( $instance ) {		
		//default data
		$instance = wp_parse_args( (array) $instance, array( 
			'title' => '',		
			'day1' => '',
			'day2' => '',
			'day1_time' => '',
			'day2_time' => '',
			'holiday' => '',
		) );

		$title      = sanitize_text_field( $instance['title'] );
		$day1       = sanitize_text_field( $instance['day1'] );
		$day2       = sanitize_text_field( $instance['day2'] );
		$holiday    = sanitize_text_field( $instance['holiday'] );
		$day1_time  = sanitize_text_field( $instance['day1_time'] );
		$day2_time  = sanitize_text_field( $instance['day2_time'] );
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'gymat-core' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

        <p><label for="<?php echo esc_attr( $this->get_field_id( 'day1' ) ); ?>"><?php esc_html_e( 'Week Day:', 'gymat-core' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'day1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'day1' ) ); ?>" type="text" value="<?php echo esc_attr( $day1 ); ?>" /></p>

        <p><label for="<?php echo esc_attr( $this->get_field_id( 'day1_time' ) ); ?>"><?php esc_html_e( 'Working Time:', 'gymat-core' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'day1_time' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'day1_time' ) ); ?>" type="text" value="<?php echo esc_attr( $day1_time ); ?>" /></p>

        <p><label for="<?php echo esc_attr( $this->get_field_id( 'day2' ) ); ?>"><?php esc_html_e( 'Week Day:', 'gymat-core' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'day2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'day2' ) ); ?>" type="text" value="<?php echo esc_attr( $day2 ); ?>" /></p>

        <p><label for="<?php echo esc_attr( $this->get_field_id( 'day2_time' ) ); ?>"><?php esc_html_e( 'Working Time:', 'gymat-core' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'day2_time' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'day2_time' ) ); ?>" type="text" value="<?php echo esc_attr( $day2_time ); ?>" /></p>

     

        <p><label for="<?php echo esc_attr( $this->get_field_id( 'holiday' ) ); ?>"><?php esc_html_e( 'Holiday:', 'gymat-core' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'holiday' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'holiday' ) ); ?>" type="text" value="<?php echo esc_attr( $holiday); ?>" /></p>
		
		<?php
	}
}