<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Slider Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Slider_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Slider widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Slider';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Slider widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Slider', 'picchi-extension' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Slider widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-code';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Slider widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'desvert-elements' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'Picchi Slider', 'url', 'link' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'picchi-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'list_sub_title', [
				'label' => esc_html__( 'Sub Title', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'HOW WE STARTED' , 'picchi-extension' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Title', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Getting ready to fly' , 'picchi-extension' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'list_description', [
				'label' => esc_html__( 'Description', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'In spring 2007, Francois Dubrelle, a veteran in the aerospace industry, had a simple idea: to supply the industry with productive financial engineering. ' , 'picchi-extension' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'slider_list',
			[
				'label' => esc_html__( 'Slider List', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				/*'placeholder' => [
					[
						'list_title' => esc_html__( 'List Title', 'picchi-extension' ),
						'list_description' => esc_html__( 'Slider content. Click the edit button to change this text.', 'picchi-extension' ),
					],
				],*/
				'title_field' => '{{{ list_title }}}',
			]
		);
		$this->add_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .your-class' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		if ( $settings['slider_list'] ) {
			echo '<dl>';
			foreach (  $settings['list'] as $slider_data ) {
				echo '<dt' . $slider_data['list_sub_title'] . '</dt>';
				echo '<dt class="elementor-repeater-item-' . esc_attr( $slider_data['_id'] ) . '">' . $slider_data['list_title'] . '</dt>';
				echo '<dd>' . $slider_data['list_description'] . '</dd>';
			}
			echo '</dl>';
			foreach (  $settings['slider_list'] as $slider_data ){
				?>
					<div class="owl-carousel owl-theme">
						<div class="item">
							<h4><?php echo $slider_data['list_sub_title']; ?></h4>
							<h2><?php echo $slider_data['list_title']; ?></h2>
							<p><?php echo $slider_data['list_description']; ?></p>
							<img src="<?php echo $slider_data['image']['url']; ?>" alt="<?php echo $slider_data['image']['name']; ?>">
						</div>
					</div>
				<?php
			}
		}

	}
	protected function content_template() {
		?>
		<# if ( settings.list.length ) { #>
		<dl>
			<# _.each( settings.list, function( item ) { #>
				<dt class="elementor-repeater-item-{{ item._id }}">{{{ slider_data.list_title }}}</dt>
				<dd>{{{ slider_data.list_description }}}</dd>
			<# }); #>
			</dl>
		<# } #>
		<?php
	}

}