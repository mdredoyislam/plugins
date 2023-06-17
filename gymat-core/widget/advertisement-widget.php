<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

class GymatTheme_Advertisement extends WP_Widget {
	public function __construct() {
		parent::__construct(
            'gymat_advertisement', // Base ID
            esc_html__( 'Gymat : Advertisement', 'gymat-core' ), // Name
            array( 'description' => esc_html__( 'Advertisement Widget', 'gymat-core' ) ) // Args
            );
	}

	public function widget( $args, $instance ){
		echo wp_kses_post( $args['before_widget'] );
		if ( !empty( $instance['title'] ) ) {
			$html = apply_filters( 'widget_title', $instance['title'] );
			echo $html = $args['before_title'] . $html .$args['after_title'];
		}
		else {
			$html = '';
		}
		?>
		<div class="advertisement-widget" style="background-image: url(<?php echo wp_get_attachment_image_url($instance['bg_image'],'full') ; ?>)">
		    <div class="ad-widget-wrap">
				<?php
					if( !empty( $instance['ad_title'] ) ){ ?>
						<div class="add-title">
							<h2><?php echo esc_html( $instance['ad_title'] ); ?></h2>
						</div>
					<?php }
					if( !empty( $instance['percentage_discount'] ) ){ ?>
						<div class="percentage">
							<h3><?php echo esc_html( $instance['percentage_discount'] ); ?></h3>
						</div>
					<?php }
					if( !empty( $instance['subtitle'] ) ){ ?>
						<div class="discount">
							<h4><?php echo esc_html( $instance['subtitle'] ); ?></h4>
						</div>
					<?php }  
					
				?>
				<?php if( !empty( $instance['btn_text'] ) || !empty( $instance['btn_url'] )  ){ ?> 
					<div class="add-button">
						<a href="<?php echo esc_url( $instance['btn_url'] ); ?>" class="btn-style1"><span><?php echo esc_html( $instance['btn_text'] ); ?><svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M0 6C0 6.22729 0.087059 6.44527 0.242027 6.60598C0.396994 6.7667 0.607174 6.85699 0.82633 6.85699H18.1774L14.6292 10.5352C14.5523 10.6149 14.4914 10.7095 14.4498 10.8136C14.4082 10.9177 14.3868 11.0292 14.3868 11.1419C14.3868 11.2546 14.4082 11.3662 14.4498 11.4703C14.4914 11.5744 14.5523 11.669 14.6292 11.7487C14.706 11.8284 14.7972 11.8916 14.8976 11.9347C14.998 11.9778 15.1056 12 15.2142 12C15.3229 12 15.4304 11.9778 15.5308 11.9347C15.6312 11.8916 15.7224 11.8284 15.7992 11.7487L20.7572 6.60675C20.8342 6.52714 20.8952 6.43257 20.9369 6.32846C20.9786 6.22434 21 6.11272 21 6C21 5.88728 20.9786 5.77566 20.9369 5.67154C20.8952 5.56743 20.8342 5.47286 20.7572 5.39325L15.7992 0.251323C15.6441 0.0904038 15.4336 0 15.2142 0C14.9948 0 14.7843 0.0904038 14.6292 0.251323C14.474 0.412243 14.3868 0.630497 14.3868 0.858071C14.3868 1.08565 14.474 1.3039 14.6292 1.46482L18.1774 5.14301H0.82633C0.607174 5.14301 0.396994 5.2333 0.242027 5.39402C0.087059 5.55474 0 5.77271 0 6Z" fill="white"/>
						</svg></span>
					</a>
					</div>
				<?php } ?>
			</div>
		</div>

		<?php
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ){
		$instance              = array();
		$instance['title']     = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['bg_image']      = ( ! empty( $new_instance['bg_image'] ) ) ? sanitize_text_field( $new_instance['bg_image'] ) : '';
		$instance['ad_title']     = ( ! empty( $new_instance['ad_title'] ) ) ? sanitize_text_field( $new_instance['ad_title'] ) : '';
		$instance['percentage_discount']     = ( ! empty( $new_instance['percentage_discount'] ) ) ? sanitize_text_field( $new_instance['percentage_discount'] ) : '';
		$instance['subtitle']   = ( ! empty( $new_instance['subtitle'] ) ) ? wp_kses_post( $new_instance['subtitle'] ) : '';
		$instance['btn_text']     = ( ! empty( $new_instance['btn_text'] ) ) ? sanitize_text_field( $new_instance['btn_text'] ) : '';
		$instance['btn_url']     = ( ! empty( $new_instance['btn_url'] ) ) ? sanitize_text_field( $new_instance['btn_url'] ) : '';
		return $instance;
	}

	public function form( $instance ){
		$defaults = array(
			'title'   						=> '',
			'subtitle'						=> '',
			'ad_title'   					=> '',
			'bg_image'    					=> '',
			'percentage_discount'   		=> '',
			'btn_text'   					=> '',
			'btn_url'   					=> '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = array(
			'title'     => array(
				'label' => esc_html__( 'Title', 'gymat-core' ),
				'type'  => 'text',
			),
			'bg_image'    => array(
				'label'   => esc_html__( 'background image', 'blogxer-core' ),
				'type'    => 'image',
			),
			'subtitle' => array(
				'label'   => esc_html__( 'Discount Title', 'techkit-core' ),
				'type'    => 'text',
			),
			'ad_title'     => array(
				'label' => esc_html__( 'Ad Title', 'gymat-core' ),
				'type'  => 'text',
			),      
			'percentage_discount'     => array(
				'label' => esc_html__( 'Percentage Discount', 'gymat-core' ),
				'type'  => 'text',
			),
			'btn_text'     => array(
				'label' => esc_html__( 'Button Text', 'gymat-core' ),
				'type'  => 'text',
			),
			'btn_url'     => array(
				'label' => esc_html__( 'Button Url', 'gymat-core' ),
				'type'  => 'url',
			),
		);

		RT_Widget_Fields::display( $fields, $instance, $this );
	}
}


