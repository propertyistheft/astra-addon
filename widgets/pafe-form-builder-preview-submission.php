<?php

class PAFE_Form_Builder_Preview_Submission extends \Elementor\Widget_Base {

	public function get_name() {
		return 'pafe-form-builder-preview-submission';
	}

	public function get_title() {
		return __( 'Preview Submission', 'pafe' );
	}

	public function get_icon() {
		return 'eicon-bullet-list';
	}

	public function get_categories() {
		return [ 'pafe-form-builder' ];
	}

	public function get_keywords() {
		return [ 'input', 'form', 'field', 'submit', 'preview', 'submission' ];
	}

	public function get_script_depends() {
		return [ 
			'pafe-form-builder'
		];
	}

	public function get_style_depends() {
		return [ 
			'pafe-form-builder-style'
		];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'pafe_form_builder_preview_submission_section',
			[
				'label' => __( 'Settings', 'elementor' ),
			]
		);

		$this->add_control(
			'form_id',
			[
				'label' => __( 'Form ID* (Required)', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'Enter the same form id for all fields in a form, with latin character and no space. E.g order_form', 'pafe' ),
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'remove_empty_form_input_fields',
			[
				'label' => __( 'Remove Empty Form Input Fields', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'preview_submission_custom_list_fields',
			[
				'label' => __( 'Custom List Fields', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'description' => __( 'If your form has Repeater Fields, you have to enable it and enter Repeater Shortcode', 'pafe' ),
				'default' => '',
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'field_shortcode',
			[
				'label' => __( 'Field Shortcode, Repeater Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'preview_submission_custom_list_fields_list',
			array(
				'type'    => Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '{{{ field_shortcode }}}',
				'condition' => [
					'preview_submission_custom_list_fields' => 'yes',
				],
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'pafe_form_builder_preview_submission_style_label',
			[
				'label' => __( 'Label', 'pafe' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pafe_form_builder_preview_submission_style_label_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .pafe-form-builder-preview-submission__item-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'pafe_form_builder_preview_submission_style_label_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .pafe-form-builder-preview-submission__item-label',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'pafe_form_builder_preview_submission_style_value',
			[
				'label' => __( 'Value', 'pafe' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pafe_form_builder_preview_submission_style_value_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .pafe-form-builder-preview-submission__item-value' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'pafe_form_builder_preview_submission_style_value_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .pafe-form-builder-preview-submission__item-value',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		if ( !empty( $settings['form_id'] ) ) {

		?>	
			<div class="pafe-form-builder-preview-submission" data-pafe-form-builder-preview-submission="<?php echo $settings['form_id']; ?>" <?php if (!empty( $settings['remove_empty_form_input_fields'])) { echo ' data-pafe-form-builder-preview-submission-remove-empty-fields'; } ?><?php if (!empty($settings['preview_submission_custom_list_fields_list']) && !empty($settings['preview_submission_custom_list_fields'])) { echo " data-pafe-form-builder-preview-submission-custom-list-fields='" . json_encode($settings['preview_submission_custom_list_fields_list']) . "'"; } ?>>
			</div>
        <?php

		}

	}

}


?>
