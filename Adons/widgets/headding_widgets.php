<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Heading Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Heading_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Heading widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Heading';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Heading widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Heading', 'picchi-extension' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Heading widget icon.
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
	 * Retrieve the list of categories the Heading widget belongs to.
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
		return [ 'Heading', 'url', 'link' ];
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
			'section_heading',
			[
				'label' => esc_html__( 'Heading Sub Title', 'picchi-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading_sub_title',
			[
				'label' => esc_html__( 'Heading Sub Title', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
				'placeholder' => esc_html__( 'Heading Sub Title', 'picchi-extension' ),
			]
		);
        $this->add_control(
			'heading_title',
			[
				'label' => esc_html__( 'Heading Title', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
				'separator' => 'before',
				'placeholder' => esc_html__( 'Heading Title', 'picchi-extension' ),
			]
		);
        $this->add_control(
			'heading_description',
			[
				'label' => esc_html__( 'Heading Description', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
                'label_block' => true,
				'separator' => 'before',
				'placeholder' => esc_html__( 'Heading Description', 'picchi-extension' ),
			]
		);
		$this->add_control(
			'section_content_align',
			[
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'label' => esc_html__( 'Alignment', 'picchi-extension' ),
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'picchi-extension' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'picchi-extension' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'picchi-extension' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-title' => 'text-align: {{VALUE}};',
				],
			]
		);
        $this->end_controls_section();
        
        //Widgets Style Controls
        $this->start_controls_section(
			'heading_sec_subtitle_Style',
			[
				'label' => esc_html__( 'Heading Sub Title Style', 'picchi-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'heading_subtitle_color',
			[
				'label' => esc_html__( 'Heading Sub Title Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title h4' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'title' => 'Heading Subtitle Typography',
                'name' => 'heading_subtitle_typography',
				'selector' => '{{WRAPPER}} .section-title h4',
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'heading_title_Style',
			[
				'label' => esc_html__( 'Heading TItle Style', 'picchi-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'heading_title_color',
			[
				'label' => esc_html__( 'Heading Title Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title h2' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'title' => 'Heading title Typography',
                'name' => 'heading_title_typography',
				'selector' => '{{WRAPPER}} .section-title h2',
			]
		);
		$this->add_control(
			'heading_title_before_color',
			[
				'label' => esc_html__( 'Heading Title Before Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title h2:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'heading_title_after_color',
			[
				'label' => esc_html__( 'Heading Title After Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title h2:after' => 'background-color: {{VALUE}};',
				],
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'heading_description_Style',
			[
				'label' => esc_html__( 'Heading Description Style', 'picchi-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'heading_description_color',
			[
				'label' => esc_html__( 'Hero Description Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title p' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'title' => 'Heading Description Typography',
                'name' => 'heading_description_typography',
				'selector' => '{{WRAPPER}} .section-title p',
			]
		);
        $this->end_controls_section();

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
        $heading_sub_title = $settings['heading_sub_title'];
        $heading_title = $settings['heading_title'];
        $heading_description = $settings['heading_description'];
    ?>
	<div class="section-title">
		<h4><?php echo $heading_sub_title; ?></h4>
		<h2><?php echo $heading_title; ?></h2>
		<p><?php echo $heading_description; ?></p>
	</div>
    <?php

	}

}