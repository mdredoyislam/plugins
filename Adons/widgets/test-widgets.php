<?php
class Test_widgets extends \Elementor\Widget_Base {

	public function get_name() {
		return 'hello_world_widget_1';
	}

	public function get_title() {
		return esc_html__( 'Hello World 1', 'picchi-extension' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'desvert-elements' ];
	}

	public function get_keywords() {
		return [ 'hello', 'world' ];
	}
    protected function register_controls() {

		// Content Tab Start

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'picchi-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'picchi-extension' ),
                'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Hello world', 'picchi-extension' ),
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'section_desc',
			[
				'label' => esc_html__( 'Section Desacription', 'picchi-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'picchi-extension' ),
                'separator' => 'before',
                'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Hello world', 'picchi-extension' ),
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'section_link',
			[
				'label' => esc_html__( 'Section Links', 'picchi-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'link_text',
			[
				'label' => esc_html__( 'Link Text', 'picchi-extension' ),
                'separator' => 'before',
                'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Read More', 'picchi-extension' ),
			]
		);
        $this->add_control(
			'link_url',
			[
				'label' => esc_html__( 'Link URL', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'Btn URL Here', 'picchi-extension' ),
			]
		);
		$this->end_controls_section();

		// Content Tab End
        // Style Tab Start

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'picchi-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'title_style',
			[
				'label' => esc_html__( 'Title', 'picchi-extension' ),
                'separator' => 'after',
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hello-world' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'title' => 'Title Typography',
                'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .hello-world',
			]
		);
        $this->add_control(
			'desc_style',
			[
				'label' => esc_html__( 'Description', 'picchi-extension' ),
                'separator' => 'before',
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
        $this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Desc Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hello-text' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'title' => 'Desc Typography',
                'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .hello-text',
			]
		);
        $this->add_control(
			'link_style',
			[
				'label' => esc_html__( 'Link', 'picchi-extension' ),
                'separator' => 'before',
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
        $this->add_control(
			'link_color',
			[
				'label' => esc_html__( 'Link Color', 'picchi-extension' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn-link' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'title' => 'Link Typography',
                'name' => 'link_typography',
				'selector' => '{{WRAPPER}} .btn-link',
			]
		);

		$this->end_controls_section();

		// Style Tab End
    }
    protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<h3 class="hello-world">
			<?php echo $settings['title']; ?>
        </h3>
        <p class="hello-text">
			<?php echo $settings['description']; ?>
        </p>
        <a class="btn-link" href="<?php echo $settings['link_url']['url']; ?>"><?php echo $settings['link_text']; ?></a>

		<?php
	}

}