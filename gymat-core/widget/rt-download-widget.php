<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

class GymatTheme_Download extends WP_Widget {
	public function __construct() {
		parent::__construct(
            'gymat_download', // Base ID
            esc_html__( 'Gymat: Download', 'gymat-core' ), // Name
            array( 'description' => esc_html__( 'Gymat: Download Widget', 'gymat-core' )) );
	}

	public function widget( $args, $instance ){
		echo wp_kses_post( $args['before_widget'] );
		if ( !empty( $instance['title'] ) ) {
			$html = apply_filters( 'widget_title', $instance['title'] );
			$html = $args['before_title'] . $html .$args['after_title'];
		}
		else {
			$html = '';
		}
		
		echo wp_kses_post( $html );
		?>
		<?php if( !empty( $instance['content_text'] ) ){ ?> 
			<p><?php echo esc_html( $instance['content_text'] ); ?></p>
		<?php } ?>
		<?php if( !empty( $instance['pdf_title'] ) || !empty($instance['download_url']) ){ ?> 	
			<div class="download-list">
				<div class="item">
					<div class="item-icon">
						<i class="fas fa-file-pdf"></i>
					</div>
					<div class="item-text">
						<h4><a class="link" download href="<?php echo esc_url( $instance['download_url'] ); ?>"><?php echo esc_html( $instance['pdf_title'] ); ?></a></h4>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ){
		$instance                  = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['content_text'] = ( ! empty( $new_instance['content_text'] ) ) ? wp_kses_post( $new_instance['content_text'] ) : '';

		$instance['pdf_title']   = ( ! empty( $new_instance['pdf_title'] ) ) ? wp_kses_post( $new_instance['pdf_title'] ) : '';

		$instance['download_url']   = ( ! empty( $new_instance['download_url'] ) ) ? wp_kses_post( $new_instance['download_url'] ) : '';

		return $instance;
	}

	public function form( $instance ){
		$defaults = array(
			'title'       	=> '',
			'content_text'  => '',
			'pdf_title' 	=> '',
			'download_url' 	=> '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = array(
			'title'       => array(
				'label'   => esc_html__( 'Title', 'gymat-core' ),
				'type'    => 'text',
			),
			'content_text'       => array(
				'label'   => esc_html__( 'content', 'gymat-core' ),
				'type'    => 'textarea',
			),
			'pdf_title'       => array(
				'label'   => esc_html__( 'Pdf Title', 'gymat-core' ),
				'type'    => 'text',
			),
			'download_url'    => array(
				'label'    => esc_html__( 'Download URL', 'gymat-core' ),
				'type'     => 'url',
			),
		);

		RT_Widget_Fields::display( $fields, $instance, $this );
	}
}