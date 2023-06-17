<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Banner Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Banner_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Banner widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Banner';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Banner widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Banner', 'picchi-extension' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Banner widget icon.
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
	 * Retrieve the list of categories the Banner widget belongs to.
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
		return [ 'Banner', 'url', 'link' ];
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
			'banner_section_sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'picchi-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hero_sub_title',
			[
				'label' => esc_html__( 'Hero Sub Title', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
				'placeholder' => esc_html__( 'Hero Sub Title', 'picchi-extension' ),
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'banner_section_title',
			[
				'label' => esc_html__( 'Hero Title', 'picchi-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'hero_title',
			[
				'label' => esc_html__( 'Hero Title', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
				'placeholder' => esc_html__( 'Hero Title', 'picchi-extension' ),
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'banner_section_desc',
			[
				'label' => esc_html__( 'Hero Description', 'picchi-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'hero_description',
			[
				'label' => esc_html__( 'Hero Description', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
                'label_block' => true,
				'placeholder' => esc_html__( 'Hero Description', 'picchi-extension' ),
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'banner_section_btn',
			[
				'label' => esc_html__( 'Hero Buttons', 'picchi-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'hero_btn1_text',
			[
				'label' => esc_html__( 'Hero Btn1 Text', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
				'placeholder' => esc_html__( 'Hero Btn1 Text', 'picchi-extension' ),
			]
		);
        $this->add_control(
			'hero_btn1_url',
			[
				'label' => esc_html__( 'Hero Btn1 URL', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true,
				'placeholder' => esc_html__( '#', 'picchi-extension' ),
			]
		);
        $this->add_control(
			'hero_btn2_text',
			[
				'label' => esc_html__( 'Hero Btn2 Text', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
				'placeholder' => esc_html__( 'Hero Btn2 Text', 'picchi-extension' ),
			]
		);
        $this->add_control(
			'hero_btn2_url',
			[
				'label' => esc_html__( 'Hero Btn2 URL', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true,
				'placeholder' => esc_html__( '#', 'picchi-extension' ),
			]
		);

		$this->end_controls_section();
        
        //Widgets Style Controls
        $this->start_controls_section(
			'banner_subtitle_Style',
			[
				'label' => esc_html__( 'Hero Sub Title Style', 'picchi-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'hero_subtitle_color',
			[
				'label' => esc_html__( 'Hero Sub Title Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .welcome-content h4' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'title' => 'Hero Subtitle Typography',
                'name' => 'hero_subtitle_typography',
				'selector' => '{{WRAPPER}} .welcome-content h4',
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'banner_title_Style',
			[
				'label' => esc_html__( 'Hero TItle Style', 'picchi-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'hero_title_color',
			[
				'label' => esc_html__( 'Hero Title Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .welcome-content h2' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'title' => 'Hero title Typography',
                'name' => 'hero_title_typography',
				'selector' => '{{WRAPPER}} .welcome-content h2',
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'banner_description_Style',
			[
				'label' => esc_html__( 'Hero Description Style', 'picchi-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'hero_description_color',
			[
				'label' => esc_html__( 'Hero Description Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .welcome-content p' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'title' => 'Hero Description Typography',
                'name' => 'hero_description_typography',
				'selector' => '{{WRAPPER}} .welcome-content p',
			]
		);
        $this->end_controls_section();
        //BTN 1
        $this->start_controls_section(
			'banner_btn1_Style',
			[
				'label' => esc_html__( 'Hero Btn1 Style', 'picchi-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->start_controls_tabs(
			'btn1_style_tabs'
		);

		$this->start_controls_tab(
			'btn1_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'picchi-extension' ),
			]
		);
        $this->add_control(
			'hero_btn1_color',
			[
				'label' => esc_html__( 'Hero Btn1 Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .box-btn' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'hero_btn1_bg_color',
			[
				'label' => esc_html__( 'Hero Btn1 BG Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .box-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'title' => 'Hero Btn1 Typography',
                'name' => 'hero_btn1_typography',
				'selector' => '{{WRAPPER}} .box-btn',
			]
		);
        //Padding
        $this->add_control(
			'btn1_padding',
			[
				'label' => esc_html__( 'Btn1 Padding', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .box-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        //Border
        $this->add_control(
			'btn1_border',
			[
				'label' => esc_html__( 'Btn1 border', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .box-btn' => 'border: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'hero_btn1_border_color',
			[
				'label' => esc_html__( 'Hero Btn1 Border Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .box-btn' => 'border-color: {{VALUE}};',
				],
			]
		);
        //Border
        $this->add_control(
			'btn1_border_radius',
			[
				'label' => esc_html__( 'Btn1 border Radius', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .box-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        //Margin
        $this->add_control(
			'btn1_margin',
			[
				'label' => esc_html__( 'Btn1 Margin', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .box-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_tab();

		$this->start_controls_tab(
			'btn1_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'picchi-extension' ),
			]
		);
        $this->add_control(
			'hero_btn1_hover_color',
			[
				'label' => esc_html__( 'Hero Btn1 Hover Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .box-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'hero_btn1_hover_bg_color',
			[
				'label' => esc_html__( 'Hero Btn1 Hover BG Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .box-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
        $this->end_controls_tab();
		$this->end_controls_tabs();

        $this->end_controls_section();

        //BTN 2
        $this->start_controls_section(
			'banner_btn2_Style',
			[
				'label' => esc_html__( 'Hero Btn2 Style', 'picchi-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->start_controls_tabs(
			'btn2_style_tabs'
		);

		$this->start_controls_tab(
			'btn2_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'picchi-extension' ),
			]
		);
        $this->add_control(
			'hero_btn2_color',
			[
				'label' => esc_html__( 'Hero Btn2 Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .border-btn' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'hero_btn2_bg_color',
			[
				'label' => esc_html__( 'Hero Btn2 BG Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .border-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'title' => 'Hero Btn2 Typography',
                'name' => 'hero_btn2_typography',
				'selector' => '{{WRAPPER}} .border-btn',
			]
		);
        //Padding
        $this->add_control(
			'btn2_padding',
			[
				'label' => esc_html__( 'Btn2 Padding', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .border-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        //Border
        $this->add_control(
			'btn2_border',
			[
				'label' => esc_html__( 'Btn2 border', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .border-btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'hero_btn2_border_color',
			[
				'label' => esc_html__( 'Hero Btn2 Border Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .border-btn' => 'border-color: {{VALUE}};',
				],
			]
		);
        //Border
        $this->add_control(
			'btn2_border_radius',
			[
				'label' => esc_html__( 'Btn2 border Radius', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .border-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        //Margin
        $this->add_control(
			'btn2_margin',
			[
				'label' => esc_html__( 'Btn2 Margin', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .border-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_tab();

		$this->start_controls_tab(
			'btn2_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'picchi-extension' ),
			]
		);
        $this->add_control(
			'hero_btn2_hover_color',
			[
				'label' => esc_html__( 'Hero Btn2 Hover Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .border-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'hero_btn2_hover_bg_color',
			[
				'label' => esc_html__( 'Hero Btn2 Hover BG Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .border-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
        //Border
        $this->add_control(
			'btn2_hover_border',
			[
				'label' => esc_html__( 'Btn2 Hover border', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .border-btn:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'hero_btn2_hover_border_color',
			[
				'label' => esc_html__( 'Hero Btn2 Hover Border Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .border-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
        $this->end_controls_tab();
		$this->end_controls_tabs();

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
        $hero_sub_title = $settings['hero_sub_title'];
        $hero_title = $settings['hero_title'];
        $hero_description = $settings['hero_description'];
        $hero_btn1_text = $settings['hero_btn1_text'];
        $hero_btn1_url = $settings['hero_btn1_url']['url'];
        $hero_btn2_text = $settings['hero_btn2_text'];
        $hero_btn2_url = $settings['hero_btn2_url']['url'];
    ?>
	  <!-- Welcome Area Start -->
	  <section class="welcome-areas flex-center" id="home">
		<div class="container">
			<div class="row">
				<div class="col-xl-8 mx-auto">
					<div class="welcome-content text-center">
						<h4><?php echo $hero_sub_title; ?></h4>
						<h2><?php echo $hero_title; ?></h2>
						<p><?php echo $hero_description; ?></p>
						<a href="<?php echo $hero_btn1_url; ?>" class="box-btn"><?php echo $hero_btn1_text; ?></a>
						<a href="<?php echo $hero_btn2_url; ?>" class="border-btn"><?php echo $hero_btn2_text; ?></a>
					</div>
				</div>
			</div>
		</div>
	  </section>
	  <!-- Welcome Area End -->
    <?php

	}

}