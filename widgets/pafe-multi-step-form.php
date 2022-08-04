<?php

class PAFE_Multi_Step_Form extends \Elementor\Widget_Base {

	public function get_name() {
		return 'pafe-multi-step-form';
	}

	public function get_title() {
		return __( 'Multi Step Form', 'pafe' );
	}

	public function get_icon() {
		return 'eicon-counter';
	}

	public function get_categories() {
		return [ 'pafe-form-builder' ];
	}

	public function get_keywords() {
		return [ 'input', 'form', 'field', 'submit', 'step', 'multi', 'multi step', 'multi step form' ];
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

	public static function get_button_sizes() {
		return [
			'xs' => __( 'Extra Small', 'elementor' ),
			'sm' => __( 'Small', 'elementor' ),
			'md' => __( 'Medium', 'elementor' ),
			'lg' => __( 'Large', 'elementor' ),
			'xl' => __( 'Extra Large', 'elementor' ),
		];
	}

    public function acf_get_field_key( $field_name, $post_id ) {
        global $wpdb;
        $acf_fields = $wpdb->get_results( $wpdb->prepare( "SELECT ID,post_parent,post_name FROM $wpdb->posts WHERE post_excerpt=%s AND post_type=%s" , $field_name , 'acf-field' ) );
        // get all fields with that name.
        switch ( count( $acf_fields ) ) {
            case 0: // no such field
                return false;
            case 1: // just one result.
                return $acf_fields[0]->post_name;
        }
        // result is ambiguous
        // get IDs of all field groups for this post
        $field_groups_ids = array();
        $field_groups = acf_get_field_groups( array(
            'post_id' => $post_id,
        ) );
        foreach ( $field_groups as $field_group )
            $field_groups_ids[] = $field_group['ID'];

        // Check if field is part of one of the field groups
        // Return the first one.
        foreach ( $acf_fields as $acf_field ) {
            $acf_field_id = acf_get_field($acf_field->post_parent);
            if ( in_array($acf_field_id['parent'],$field_groups_ids) ) {
                return $acf_field->post_name;
            }
        }
        return false;
    }

    public function jetengine_repeater_get_field_object( $field_name, $meta_field_id ) {
        $meta_objects = get_option('jet_engine_meta_boxes');
        foreach ( $meta_objects as $meta_object ) {
            $meta_fields = $meta_object['meta_fields'];
            foreach ( $meta_fields as $meta_field ) {
                if ( ($meta_field['name'] == $meta_field_id) && ($meta_field['type'] == 'repeater') ) {
                    $meta_repeater_fields = $meta_field['repeater-fields'];
                    foreach ( $meta_repeater_fields as $meta_repeater_field ) {
                        if ( $meta_repeater_field['name'] == $field_name ) {
                            return $meta_repeater_field;
                        }
                    }
                }
            }
        }
    }

    public function metabox_group_get_field_object( $field_name, $meta_objects ) {
        foreach ( $meta_objects as $meta_object ) {
            $meta_fields = $meta_object['fields'];
            foreach ( $meta_fields as $meta_field ) {
                if ( ($meta_field['type'] == 'group') && ($meta_field['clone']) ) {
                    $meta_repeater_fields = $meta_field['fields'];
                    foreach ( $meta_repeater_fields as $meta_repeater_field ) {
                        if ( $meta_repeater_field['id'] == $field_name ) {
                            return $meta_repeater_field;
                        }
                    }
                }
            }
        }
        return false;
    }

	protected function _register_controls() {
		$this->start_controls_section(
			'pafe_multi_step_form_section_content',
			[
				'label' => __( 'Multi Step Form', 'pafe' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_id',
			[
				'label' => __( 'Form ID* (Required)', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'Enter the same form id for all fields in all steps, with latin character and no space. E.g order_form', 'pafe' ),
                'dynamic' => [
                    'active' => true,
                ],
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
			'enter_submit_form',
			[
				'label' => __( 'Press Enter To Submit Form', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'hide_button_after_submitting',
			[
				'label' => __( 'Hide The Button After Submitting', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'pafe_multi_step_form_item_title',
			[
				'label' => __( 'Step Title', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'pafe_multi_step_form_item_shortcode',
			[
				'label' => __( 'Template Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'pafe_multi_step_form_item_disable_button_prev',
			[
				'label' => __( 'Disable Previous Button', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
			]
		);

		$repeater->add_control(
			'pafe_multi_step_form_item_disable_button_next',
			[
				'label' => __( 'Disable Next Button', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'pafe_multi_step_form_list',
			array(
				'type'    => Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '{{{ pafe_multi_step_form_item_title }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_scroll_to_top',
			[
				'label' => __( 'Scroll To Top', 'pafe' ),
			]
		);

		$this->add_control(
			'pafe_multi_step_form_scroll_to_top',
			[
				'label' => __( 'Enable', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
			] 
		);

		$this->add_control(
			'pafe_multi_step_form_scroll_to_top_offset_desktop',
			[
				'label' => __( 'Desktop Negative Offset Top (px)', 'pafe' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 0,
				'condition' => [
					'pafe_multi_step_form_scroll_to_top' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_multi_step_form_scroll_to_top_offset_tablet',
			[
				'label' => __( 'Tablet Negative Offset Top (px)', 'pafe' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 0,
				'condition' => [
					'pafe_multi_step_form_scroll_to_top' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_multi_step_form_scroll_to_top_offset_mobile',
			[
				'label' => __( 'Mobile Negative Offset Top (px)', 'pafe' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 0,
				'condition' => [
					'pafe_multi_step_form_scroll_to_top' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[
				'label' => __( 'Button', 'elementor' ),
			]
		);

		$this->add_control(
			'button_type',
			[
				'label' => __( 'Type', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'elementor' ),
					'info' => __( 'Info', 'elementor' ),
					'success' => __( 'Success', 'elementor' ),
					'warning' => __( 'Warning', 'elementor' ),
					'danger' => __( 'Danger', 'elementor' ),
				],
				'prefix_class' => 'elementor-button-',
			]
		);

		$this->add_control(
			'button_prev',
			[
				'label' => __( 'Previous', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Previous', 'pafe' ),
				'placeholder' => __( 'Previous', 'pafe' ),
			]
		);

		$this->add_control(
			'button_next',
			[
				'label' => __( 'Next', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Next', 'pafe' ),
				'placeholder' => __( 'Next', 'pafe' ),
			]
		);

		$this->add_control(
			'button_submit',
			[
				'label' => __( 'Submit', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Submit', 'pafe' ),
				'placeholder' => __( 'Submit', 'pafe' ),
			]
		);

		$this->add_control(
			'size',
			[
				'label' => __( 'Size', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => self::get_button_sizes(),
				'style_transfer' => true,
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_integration',
			[
				'label' => __( 'Actions After Submit', 'elementor-pro' ),
			]
		);

		
		$actions = [
			[
				'name' => 'email',
				'label' => 'Email'
			],
			[
				'name' => 'email2',
				'label' => 'Email 2'
			],
			[
				'name' => 'booking',
				'label' => 'Booking'
			],
			[
				'name' => 'redirect',
				'label' => 'Redirect'
			],
			[
				'name' => 'register',
				'label' => 'Register'
			],
			[
				'name' => 'login',
				'label' => 'Login'
			],
			[
				'name' => 'update_user_profile',
				'label' => 'Update User Profile'
			],
			[
				'name' => 'webhook',
				'label' => 'Webhook'
			],
			[
				'name' => 'remote_request',
				'label' => 'Remote Request'
			],
			[
				'name' => 'popup',
				'label' => 'Popup'
			],
			[
				'name' => 'open_popup',
				'label' => 'Open Popup'
			],
			[
				'name' => 'close_popup',
				'label' => 'Close Popup'
			],
			[
				'name' => 'submit_post',
				'label' => 'Submit Post'
			],
			[
				'name' => 'woocommerce_add_to_cart',
				'label' => 'Woocommerce Add To Cart'
			],
			[
				'name' => 'woocommerce_checkout',
				'label' => 'Woocommerce Checkout'
			],
			[
				'name' => 'mailchimp',
				'label' => 'MailChimp'
			],
            [
                'name'  => 'google_calendar',
                'label' => 'Google Calendar',
            ],
            [
                'name' => 'hubspot',
                'label' => 'Hubspot'
            ],
			[
				'name' => 'mailchimp_v3',
				'label' => 'MailChimp V3 (Recommended)'
			],
			[
				'name' => 'mailerlite',
				'label' => 'MailerLite'
			],
			[
				'name' => 'mailerlite_v2',
				'label' => 'MailerLite V2'
			],
			[
				'name' => 'activecampaign',
				'label' => 'ActiveCampaign'
			],
			[
				'name' => 'pdfgenerator',
				'label' => 'PDF Generator'
			],
			[
				'name' => 'getresponse',
				'label' => 'Getresponse'
			],
			[
				'name' => 'mailpoet',
				'label' => 'Mailpoet'
			],
			[
				'name' => 'zohocrm',
				'label' => 'Zoho CRM'
			],
			[
				'name' => 'sendinblue',
				'label' => 'Sendinblue'
			],
			[
                'name' => 'sendy',
                'label' => 'Sendy'
            ],
            [
                'name'  => 'sendfox',
                'label' => 'SendFox',
            ],
			[
                'name'  => 'constantcontact',
                'label' => 'Constant Contact',
            ],
            [
                'name' => 'webhook_slack',
                'label' => 'Webhook Slack'
            ],
            [
                'name' => 'twilio_whatsapp',
                'label' => 'Twilio Whatsapp'
            ],
            [
                'name'  => 'twilio_sms',
                'label' => 'Twilio SMS',
            ],
            [
                'name'  => 'twilio_sendgrid',
                'label' => 'Twilio SendGrid',
            ],
			[
                'name'  => 'convertkit',
                'label' => 'Convertkit',
            ],
		];

		$actions_options = [];

		foreach ( $actions as $action ) {
			$actions_options[ $action['name'] ] = $action['label'];
		}

		$this->add_control(
			'submit_actions',
			[
				'label' => __( 'Add Action', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $actions_options,
				'label_block' => true,
				'default' => [
					'email',
				],
				'description' => __( 'Add actions that will be performed after a visitor submits the form (e.g. send an email notification). Choosing an action will add its setting below.', 'elementor-pro' ),
			]
		);
		$this->add_control(
			'submit_metadata_shortcode',
			[
				'label' => __( 'Metadata Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<div class="pafe-metarata-shortcode"><div class="pafe-metadata-shortcode-item"><label>Submit ID</label><div><input type="text" value="[submit_id]" readonly></div></div><div class="pafe-metadata-shortcode-item"><label>Page URL</label><div><input type="text" value="[page_url]" readonly></div></div><div class="pafe-metadata-shortcode-item"><label>Remote IP</label><div><input type="text" value="[remote_ip]" readonly></div></div><div class="pafe-metadata-shortcode-item"><label>User Agent</label><div><input type="text" value="[user_agent]" readonly></div></div><div class="pafe-metadata-shortcode-item"><label>Date Submit</label><div><input type="text" value="[date_submit]" readonly></div></div><div class="pafe-metadata-shortcode-item"><label>Time Submit</label><div><input type="text" value="[time_submit]" readonly></div></div><div class="pafe-metadata-shortcode-item"><label>Payment Status</label><div><input type="text" value="[payment_status]" readonly=""></div></div></div>', 'pafe' ),
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_booking',
			[
				'label' => __( 'Booking', 'pafe' ),
				'condition' => [
					'submit_actions' => 'booking',
				],
			]
		);

		$this->add_control(
			'booking_shortcode',
			[
				'label' => __( 'Booking Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( '[field id="booking"]', 'pafe' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_register',
			[
				'label' => __( 'Register', 'pafe' ),
				'condition' => [
					'submit_actions' => 'register',
				],
			]
		);

        global $wp_roles;
        $roles = $wp_roles->roles;
        $roles_array = array();
        foreach ($roles as $key => $value) {
            $roles_array[$key] = $value['name'];
        }

        $this->add_control(
            'register_role',
            [
                'label' => __( 'Role', 'pafe' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $roles_array,
                'label_block' => true,
                'default' => 'subscriber',
            ]
        );

        $this->add_control(
            'register_email',
            [
                'label' => __( 'Email Field Shortcode* (Required)', 'pafe' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'E.g [field id="email"]', 'pafe' ),
            ]
        );

        $this->add_control(
            'register_username',
            [
                'label' => __( 'Username Field Shortcode* (Required)', 'pafe' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'E.g [field id="username"]', 'pafe' ),
            ]
        );

        $this->add_control(
            'register_password',
            [
                'label' => __( 'Password Field Shortcode* (Required)', 'pafe' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'E.g [field id="password"]', 'pafe' ),
            ]
        );

        $this->add_control(
            'register_password_confirm',
            [
                'label' => __( 'Confirm Password Field Shortcode', 'pafe' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'E.g [field id="confirm_password"]', 'pafe' ),
            ]
        );

        $this->add_control(
            'register_password_confirm_message',
            [
                'label' => __( 'Wrong Password Message', 'pafe' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Wrong Password', 'pafe' ),
            ]
        );

        $this->add_control(
            'register_first_name',
            [
                'label' => __( 'First Name Field Shortcode', 'pafe' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'E.g [field id="first_name"]', 'pafe' ),
            ]
        );

        $this->add_control(
            'register_last_name',
            [
                'label' => __( 'Last Name Field Shortcode', 'pafe' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'E.g [field id="last_name"]', 'pafe' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'register_user_meta',
            [
                'label' => __( 'User Meta', 'pafe' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => __( 'Choose', 'pafe' ),
                    'meta' => __( 'User Meta Key', 'pafe' ),
                    'acf' => __( 'ACF Field', 'pafe' ),
                ],
                'description' => __( 'If you want to update user password, you have to create a password field and confirm password field', 'pafe' ),
            ]
        );

        $repeater->add_control(
            'register_user_meta_type',
            [
                'label' => __( 'User Meta Type', 'pafe' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'text' => __( 'Text,Textarea,Number,Email,Url,Password', 'pafe' ),
                    'image' => __( 'Image', 'pafe' ),
                    'gallery' => __( 'Gallery', 'pafe' ),
                    'select' => __( 'Select', 'pafe' ),
                    'radio' => __( 'Radio', 'pafe' ),
                    'checkbox' => __( 'Checkbox', 'pafe' ),
                    'true_false' => __( 'True / False', 'pafe' ),
                    'date' => __( 'Date', 'pafe' ),
                    'time' => __( 'Time', 'pafe' ),
                    // 'repeater' => __( 'ACF Repeater', 'pafe' ),
                    // 'google_map' => __( 'ACF Google Map', 'pafe' ),
                ],
                'default' => 'text',
                'condition' => [
                    'register_user_meta' => 'acf'
                ],
            ]
        );

        $repeater->add_control(
            'register_user_meta_key',
            [
                'label' => __( 'Meta Key', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => 'E.g description',
            ]
        );

        $repeater->add_control(
            'register_user_meta_field_id',
            [
                'label' => __( 'Field Shortcode', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'E.g [field id="description"]', 'pafe' ),
            ]
        );

        $this->add_control(
            'register_user_meta_list',
            [
                'type'    => Elementor\Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'title_field' => '{{{ register_user_meta_key }}} - {{{ register_user_meta_field_id }}}',
                'label' => __( 'User Meta List', 'pafe' ),
            ]
        );

		$this->end_controls_section();

        $this->start_controls_section(
            'pafe_google_calendar_section',
            [
                'label' => __('Google Calendar', 'pafe' ),
                'condition' => [
                    'submit_actions' => 'google_calendar',
                ],
            ]
        );

        $this->add_control(
            'google_calendar_enable',
            [
                'label'        => __('Enable', 'pafe' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'pafe' ),
                'label_off'    => __( 'No', 'pafe' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'google_calendar_summary',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label'        => __('Summary* (Required)', 'pafe' ),
                'label_block'  => true,
                'placeholder' => '[field id="summary"] or Event ABC',
                'condition' => [
                    'google_calendar_enable' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'google_calendar_date_type',
            [
                'label' => __('Date Type', 'pafe' ),
                'type' => \Elementor\Controls_Manager::SELECT,

                'options' => [
                    'date' => __( 'Date', 'pafe' ),
                    'date_time'   => __( 'Date Time', 'pafe' ),
                ],
                'default' => 'date',
                'condition' => [
                    'google_calendar_enable' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'google_calendar_date_start',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label'        => __('Date Start* (Required)', 'pafe' ),
                'label_block'  => true,
                'placeholder' => '[field id="date_start"]',
                'condition' => [
                    'google_calendar_enable' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'google_calendar_date_end',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label'        => __('Date End* (Required)', 'pafe' ),
                'label_block'  => true,
                'placeholder' => '[field id="date_end"]',
                'condition' => [
                    'google_calendar_enable' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'google_calendar_duration',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label'        => 'Duration* (Required)',
                'label_block'  => true,
                'placeholder' => '',
                'description' => __('The unit is minute. Eg:30,60,90,...Use this option if you do not have the Date End', 'pafe' ),
                'condition' => [
                    'google_calendar_enable' => 'yes',
                    'google_calendar_date_type' => 'date_time',
                    'google_calendar_date_end' => ''
                ]
            ]
        );

        $this->add_control(
            'google_calendar_attendees_name',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label'        => __('Attendees Name* (Required)', 'pafe' ),
                'label_block'  => true,
                'placeholder' => '[field id="attendees_name"]',
                'condition' => [
                    'google_calendar_enable' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'google_calendar_attendees_email',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label'        => __('Attendees Email* (Required)', 'pafe' ),
                'label_block'  => true,
                'placeholder' => '[field id="attendees_email"]',
                'condition' => [
                    'google_calendar_enable' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'google_calendar_description',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label'        => __('Description', 'pafe' ),
                'label_block'  => true,
                'placeholder' => '[field id="description"]',
                'condition' => [
                    'google_calendar_enable' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'google_calendar_location',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label'        => __('Location', 'pafe' ),
                'label_block'  => true,
                'placeholder' => '[field id="location"]',
                'condition' => [
                    'google_calendar_enable' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'google_calendar_remind_method',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label'        => __('Remind Method* (Required)', 'pafe' ),
                'label_block'  => true,
                'value'        => 'left',
                'options'      => [
                    'email'   => __( 'Email', 'pafe' ),
                    'popup' => __( 'Popup', 'pafe' ),
                ],
                'condition' => [
                    'google_calendar_enable' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'google_calendar_remind_time',
            [
                'type'         => \Elementor\Controls_Manager::TEXT,
                'label'        => __('Remind Time* (Required)', 'pafe' ),
                'label_block'  => true,
                'description' => __( 'The unit is minute. Eg:30,60,90,...', 'pafe' ),
                'condition' => [
                    'google_calendar_enable' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'section_login',
			[
				'label' => __( 'Login', 'pafe' ),
				'condition' => [
					'submit_actions' => 'login',
				],
			]
		);

		$this->add_control(
			'login_username',
			[
				'label' => __( 'Username or Email Field Shortcode* (Required)', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="username"]', 'pafe' ),
			]
		);

		$this->add_control(
			'login_password',
			[
				'label' => __( 'Password Field Shortcode* (Required)', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="password"]', 'pafe' ),
			]
		);

		$this->add_control(
			'login_remember',
			[
				'label' => __( 'Remember Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="remember"]', 'pafe' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_update_user_profile',
			[
				'label' => __( 'Update User Profile', 'pafe' ),
				'condition' => [
					'submit_actions' => 'update_user_profile',
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'update_user_meta',
			[
				'label' => __( 'User Meta', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Choose', 'pafe' ),
					'display_name' => __( 'Display Name', 'pafe' ),
					'first_name' => __( 'First Name', 'pafe' ),
					'last_name' => __( 'Last Name', 'pafe' ),
					'description' => __( 'Bio', 'pafe' ),
					'email' => __( 'Email', 'pafe' ),
					'password' => __( 'Password', 'pafe' ),
					'url' => __( 'Website', 'pafe' ),
					'meta' => __( 'User Meta Key', 'pafe' ),
					'acf' => __( 'ACF Field', 'pafe' ),
					'metabox' => __( 'MetaBox Field', 'pafe' ),
					'toolset' => __( 'Toolset Field', 'pafe' ),
				],
				'description' => __( 'If you want to update user password, you have to create a password field and confirm password field', 'pafe' ),
			]
		);

		$repeater->add_control(
			'update_user_meta_type',
			[
				'label' => __( 'User Meta Type', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'text' => __( 'Text,Textarea,Number,Email,Url,Password', 'pafe' ),
					'image' => __( 'Image', 'pafe' ),
					'gallery' => __( 'Gallery', 'pafe' ),
					'select' => __( 'Select', 'pafe' ),
					'radio' => __( 'Radio', 'pafe' ),
					'checkbox' => __( 'Checkbox', 'pafe' ),
					'true_false' => __( 'True / False', 'pafe' ),
					'date' => __( 'Date', 'pafe' ),
					'time' => __( 'Time', 'pafe' ),
					// 'repeater' => __( 'ACF Repeater', 'pafe' ),
					// 'google_map' => __( 'ACF Google Map', 'pafe' ),
				],
				'default' => 'text',
				'condition' => [
					'update_user_meta' => ['acf', 'metabox', 'toolset']
				],
			]
		);

		$repeater->add_control(
			'update_user_meta_key',
			[
				'label' => __( 'User Meta Key', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => 'E.g description',
				'condition' => [
					'update_user_meta' => ['meta', 'acf', 'metabox', 'toolset']
				],
			]
		);

		$repeater->add_control(
			'update_user_meta_field_shortcode',
			[
				'label' => __( 'Field Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="description"]', 'pafe' ),
			]
		);

		$repeater->add_control(
			'update_user_meta_field_shortcode_confirm_password',
			[
				'label' => __( 'Confirm Password Field Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="confirm_password"]', 'pafe' ),
				'condition' => [
					'update_user_meta' => 'password',
				],
			]
		);

		$repeater->add_control(
			'wrong_password_message',
			[
				'label' => __( 'Wrong Password Message', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Wrong Password', 'pafe' ),
				'condition' => [
					'update_user_meta' => 'password',
				],
			]
		);

		$this->add_control(
			'update_user_meta_list',
			array(
				'type'    => Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '{{{ update_user_meta }}} - {{{ update_user_meta_key }}} - {{{ update_user_meta_field_shortcode }}}',
				'label' => __( 'User Meta List', 'pafe' ),
			)
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'pafe_hubspot_section',
            [
                'label' => __( 'Hubspot', 'pafe' ),
                'condition' => [
                    'submit_actions' => 'hubspot',
                ],
            ]
        );
        $this->add_control(
            'pafe_hubspot_acceptance_field',
            [
                'label' => __( 'Acceptance Field?', 'pafe' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'pafe' ),
                'label_off' => __( 'No', 'pafe' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'pafe_hubspot_acceptance_field_shortcode',
            [
                'label' => __( 'Acceptance Field Shortcode', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( '', 'pafe' ),
                'placeholder' => __( 'Enter your shortcode here', 'pafe' ),
                'condition' => [
                    'pafe_hubspot_acceptance_field' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'pafe_hubspot_get_group',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __( '<button data-pafe-hubspot-get-group-list class="pafe-admin-button-ajax elementor-button elementor-button-default" type="button">Get Group List<i class="fas fa-spinner fa-spin"></i></button><div class="pafe-hubspot-group-list"></div>', 'pafe' ),
            ]
        );
        $this->add_control(
            'pafe_hubspot_group_key',
            [
                'label' => __( 'Group Key', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( '', 'pafe' ),
                'placeholder' => __( 'Enter the group key here', 'pafe' ),
            ]
        );
        $this->add_control(
            'pafe_hubspot_get_property',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __( '<button data-pafe-hubspot-get-property-list class="pafe-admin-button-ajax elementor-button elementor-button-default" type="button">Get Property List<i class="fas fa-spinner fa-spin"></i></button><div class="pafe-hubspot-property-list"></div>', 'pafe' ),
            ]
        );


        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'pafe_hubspot_property_name',
            [
                'label' => __( 'Property Name', 'pafe' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'E.g email, name, last_name', 'pafe' ),
            ]
        );

        $repeater->add_control(
            'pafe_hubspot_field_shortcode',
            [
                'label' => __( 'Field Shortcode', 'pafe' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'E.g [field id="email"]', 'pafe' ),
            ]
        );

        $this->add_control(
            'pafe_hubspot_property_list',
            [
                'type'    => Elementor\Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'title_field' => '{{{pafe_hubspot_property_name}}}',
                'label' => __( 'Property', 'pafe' ),
            ]
        );
        $this->end_controls_section();

		$this->start_controls_section(
			'section_submit_post',
			[
				'label' => __( 'Submit Post', 'pafe' ),
				'condition' => [
					'submit_actions' => 'submit_post',
				],
			]
		);

		$post_types = get_post_types( [], 'objects' );
		$post_types_array = array();
		$taxonomy = array();
		foreach ( $post_types as $post_type ) {
	        $post_types_array[$post_type->name] = $post_type->label;
	        $taxonomy_of_post_type = get_object_taxonomies( $post_type->name, 'names' );
	        $post_type_name = $post_type->name;
	        if (!empty($taxonomy_of_post_type) && $post_type_name != 'nav_menu_item' && $post_type_name != 'elementor_library' && $post_type_name != 'elementor_font' ) {
	        	if ($post_type_name == 'post') {
	        		$taxonomy_of_post_type = array_diff( $taxonomy_of_post_type, ["post_format"] );
	        	}
	        	$taxonomy[$post_type_name] = $taxonomy_of_post_type;
	        }
	    }

	    $taxonomy_array = array();
	    foreach ($taxonomy as $key => $value) {
	    	foreach ($value as $key_item => $value_item) {
	    		$taxonomy_array[$value_item . '|' . $key] = $value_item . ' - ' . $key;
	    	}
	    }

		$this->add_control(
			'submit_post_type',
			[
				'label' => __( 'Post Type', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $post_types_array,
				'default' => 'post',
			]
		);

		$this->add_control(
			'submit_post_taxonomy',
			[
				'label' => __( 'Taxonomy', 'pafe' ),
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'default' => 'category-post',
			]
		);

		$this->add_control(
			'submit_post_term_slug',
			[
				'label' => __( 'Term slug', 'pafe' ),
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'description' => 'E.g news, [field id="term"]',
			]
		);

		$this->add_control(
			'submit_post_term',
			[
				'label' => __( 'Term Field Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'description' => __( 'E.g [field id="term"]', 'pafe' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'submit_post_taxonomy',
			[
				'label' => __( 'Taxonomy', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $taxonomy_array,
				'default' => 'category-post',
			]
		);

		$repeater->add_control(
			'submit_post_terms_slug',
			[
				'label' => __( 'Term slug', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => 'E.g news',
			]
		);

		$repeater->add_control(
			'submit_post_terms_field_id',
			[
				'label' => __( 'Terms Select Field Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="term"]', 'pafe' ),
			]
		);

		$this->add_control(
			'submit_post_terms_list',
			array(
				'type'    => Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => 'term',
				'label' => __( 'Terms', 'pafe' ),
			)
		);

		$this->add_control(
			'submit_post_status',
			[
				'label' => __( 'Post Status', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'publish' => __( 'Publish', 'pafe' ),
					'pending' => __( 'Pending', 'pafe' ),
				],
				'default' => 'publish',
			]
		);

		$this->add_control(
			'submit_post_url_shortcode',
			[
				'label' => __( 'Post URL shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'classes' => 'forms-field-shortcode',
				'raw' => '<input class="elementor-form-field-shortcode" value="[post_url]" readonly />',
			]
		);

		$this->add_control(
			'submit_post_id_shortcode',
			[
				'label' => __( 'Post ID Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'classes' => 'forms-field-shortcode',
				'raw' => '<input class="elementor-form-field-shortcode" value="[post_id]" readonly />',
			]
		);

		$this->add_control(
			'submit_post_title',
			[
				'label' => __( 'Title Field Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="title"]', 'pafe' ),
			]
		);

		$this->add_control(
			'submit_post_content',
			[
				'label' => __( 'Content Field Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="content"]', 'pafe' ),
			]
		);

		$this->add_control(
			'submit_post_featured_image',
			[
				'label' => __( 'Featured Image Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="featured_image_upload"]', 'pafe' ),
			]
		);

		// $this->add_control(
		// 	'submit_post_url_edit',
		// 	[
		// 		'label' => __( 'Edit Post URL shortcode', 'pafe' ),
		// 		'label_block' => true,
		// 		'type' => \Elementor\Controls_Manager::RAW_HTML,
		// 		'classes' => 'forms-field-shortcode-edit-post',
		// 		'raw' => '<input class="elementor-form-field-shortcode" value="[edit_post edit_text='. "'Edit Post'" . ' sm=' . "'" . $this->get_id() . "'" . ' smpid=' . "'" . get_the_ID() . "'" .']' . get_the_permalink() . '[/edit_post]" readonly /></div><div class="elementor-control-field-description">' . __( 'Add this shortcode to your single template.', 'pafe' ) . ' The shortcode will be changed if you edit this form so you have to refresh Elementor Editor Page and then copy the shortcode. ' . __( 'Replace', 'pafe' ) . ' "' . get_the_permalink() . '" ' . __( 'by your Page URL contains your Submit Post Form.', 'pafe' ) . '</div>',
		// 	]
		// );

		$this->add_control(
			'submit_post_custom_field_source',
			[
				'label' => __( 'Custom Fields', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'post_custom_field' => __( 'Post Custom Field', 'pafe' ),
					'acf_field' => __( 'ACF Field', 'pafe' ),
					'toolset_field' => __( 'Toolset Field', 'pafe' ),
					'jet_engine_field' => __( 'JetEngine Field', 'pafe' ),
					'pods_field'  => __( 'Pods Field', 'pafe' ),
                    'metabox_field' => __( 'Metabox Field', 'pafe' ),
				],
				'default' => 'post_custom_field',
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'submit_post_custom_field',
			[
				'label' => __( 'Custom Field Slug', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g custom_field_slug', 'pafe' ),
			]
		);

		$repeater->add_control(
			'submit_post_custom_field_id',
			[
				'label' => __( 'Field Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="addition"]', 'pafe' ),
			]
		);

		$repeater->add_control(
			'submit_post_custom_field_type',
			[
				'label' => __( 'Custom Field Type if you use ACF, Toolset, JetEngine, Pods or MetaBox', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'text' => __( 'Text,Textarea,Number,Email,Url,Password', 'pafe' ),
					'image' => __( 'Image', 'pafe' ),
					'gallery' => __( 'Gallery', 'pafe' ),
					'select' => __( 'Select', 'pafe' ),
					'radio' => __( 'Radio', 'pafe' ),
					'checkbox' => __( 'Checkbox', 'pafe' ),
					'true_false' => __( 'True / False', 'pafe' ),
					'date' => __( 'Date', 'pafe' ),
					'time' => __( 'Time', 'pafe' ),
					'repeater' => __( 'ACF Repeater', 'pafe' ),
					'google_map' => __( 'ACF Google Map', 'pafe' ),
                    'acf_relationship' => __( 'ACF Relationship', 'pafe' ),
                    'jet_engine_repeater' => __( 'JetEngine Repeater', 'pafe' ),
                    'meta_box_group' => __( 'MetaBox Group', 'pafe' ),
                    'metabox_google_map' => __( 'MetaBox Google Map', 'pafe' ),
				],
				'default' => 'text',
			]
		);

		$this->add_control(
			'submit_post_custom_fields_list',
			array(
				'type'    => Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '{{{ submit_post_custom_field }}} - {{{ submit_post_custom_field_id }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_stripe',
			[
				'label' => __( 'Stripe Payment', 'pafe' ),
			]
		);

		$this->add_control(
			'pafe_stripe_enable',
			[
				'label' => __( 'Enable', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'pafe_stripe_currency',
			[
				'label' => __( 'Currency', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'USD' => 'USD',
					'AED' => 'AED',
					'AFN' => 'AFN',
					'ALL' => 'ALL',
					'AMD' => 'AMD',
					'ANG' => 'ANG',
					'AOA' => 'AOA',
					'ARS' => 'ARS',
					'AUD' => 'AUD',
					'AWG' => 'AWG',
					'AZN' => 'AZN',
					'BAM' => 'BAM',
					'BBD' => 'BBD',
					'BDT' => 'BDT',
					'BGN' => 'BGN',
					'BIF' => 'BIF',
					'BMD' => 'BMD',
					'BND' => 'BND',
					'BOB' => 'BOB',
					'BRL' => 'BRL',
					'BSD' => 'BSD',
					'BWP' => 'BWP',
					'BZD' => 'BZD',
					'CAD' => 'CAD',
					'CDF' => 'CDF',
					'CHF' => 'CHF',
					'CLP' => 'CLP',
					'CNY' => 'CNY',
					'COP' => 'COP',
					'CRC' => 'CRC',
					'CVE' => 'CVE',
					'CZK' => 'CZK',
					'DJF' => 'DJF',
					'DKK' => 'DKK',
					'DOP' => 'DOP',
					'DZD' => 'DZD',
					'EGP' => 'EGP',
					'ETB' => 'ETB',
					'EUR' => 'EUR',
					'FJD' => 'FJD',
					'FKP' => 'FKP',
					'GBP' => 'GBP',
					'GEL' => 'GEL',
					'GIP' => 'GIP',
					'GMD' => 'GMD',
					'GNF' => 'GNF',
					'GTQ' => 'GTQ',
					'GYD' => 'GYD',
					'HKD' => 'HKD',
					'HNL' => 'HNL',
					'HRK' => 'HRK',
					'HTG' => 'HTG',
					'HUF' => 'HUF',
					'IDR' => 'IDR',
					'ILS' => 'ILS',
					'INR' => 'INR',
					'ISK' => 'ISK',
					'JMD' => 'JMD',
					'JPY' => 'JPY',
					'KES' => 'KES',
					'KGS' => 'KGS',
					'KHR' => 'KHR',
					'KMF' => 'KMF',
					'KRW' => 'KRW',
					'KYD' => 'KYD',
					'KZT' => 'KZT',
					'LAK' => 'LAK',
					'LBP' => 'LBP',
					'LKR' => 'LKR',
					'LRD' => 'LRD',
					'LSL' => 'LSL',
					'MAD' => 'MAD',
					'MDL' => 'MDL',
					'MGA' => 'MGA',
					'MKD' => 'MKD',
					'MMK' => 'MMK',
					'MNT' => 'MNT',
					'MOP' => 'MOP',
					'MRO' => 'MRO',
					'MUR' => 'MUR',
					'MVR' => 'MVR',
					'MWK' => 'MWK',
					'MXN' => 'MXN',
					'MYR' => 'MYR',
					'MZN' => 'MZN',
					'NAD' => 'NAD',
					'NGN' => 'NGN',
					'NIO' => 'NIO',
					'NOK' => 'NOK',
					'NPR' => 'NPR',
					'NZD' => 'NZD',
					'PAB' => 'PAB',
					'PEN' => 'PEN',
					'PGK' => 'PGK',
					'PHP' => 'PHP',
					'PKR' => 'PKR',
					'PLN' => 'PLN',
					'PYG' => 'PYG',
					'QAR' => 'QAR',
					'RON' => 'RON',
					'RSD' => 'RSD',
					'RUB' => 'RUB',
					'RWF' => 'RWF',
					'SAR' => 'SAR',
					'SBD' => 'SBD',
					'SCR' => 'SCR',
					'SEK' => 'SEK',
					'SGD' => 'SGD',
					'SHP' => 'SHP',
					'SLL' => 'SLL',
					'SOS' => 'SOS',
					'SRD' => 'SRD',
					'STD' => 'STD',
					'SZL' => 'SZL',
					'THB' => 'THB',
					'TJS' => 'TJS',
					'TOP' => 'TOP',
					'TRY' => 'TRY',
					'TTD' => 'TTD',
					'TWD' => 'TWD',
					'TZS' => 'TZS',
					'UAH' => 'UAH',
					'UGX' => 'UGX',
					'UYU' => 'UYU',
					'UZS' => 'UZS',
					'VND' => 'VND',
					'VUV' => 'VUV',
					'WST' => 'WST',
					'XAF' => 'XAF',
					'XCD' => 'XCD',
					'XOF' => 'XOF',
					'XPF' => 'XPF',
					'YER' => 'YER',
					'ZAR' => 'ZAR',
					'ZMW' => 'ZMW',
				],
				'default' => 'USD',
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_subscriptions',
			[
				'label' => __( 'Subscriptions', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
				'description' => __( 'E.g bills every day, 2 weeks, 3 months, 1 year', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);
		$this->add_control(
			'pafe_stripe_subscriptions_only_price_enable',
			[
				'label' => __( 'Subscriptions use only price?', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'pafe_stripe_enable',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'pafe_stripe_subscriptions',
							'operator' => '==',
							'value' => 'yes'
						]
					]
				]
			]
		);
		$this->add_control(
			'pafe_stripe_subscriptions_price_id',
			[
				'label' => __( 'Price ID', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'pafe_stripe_enable',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'pafe_stripe_subscriptions_only_price_enable',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'pafe_stripe_subscriptions',
							'operator' => '==',
							'value' => 'yes'
						]
					]
				]
			]
		);
		$this->add_control(
			'pafe_stripe_subscriptions_product_name',
			[
				'label' => __( 'Product Name* (Required)', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Piotnet Addons For Elementor',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'pafe_stripe_enable',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'pafe_stripe_subscriptions',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'pafe_stripe_subscriptions_only_price_enable',
							'operator' => '==',
							'value' => ''
						]
					]
				]
			]
		);

        $this->add_control(
            'pafe_stripe_subscriptions_product_id',
            [
                'label' => __( 'Product ID (Optional)', 'pafe' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'pafe_stripe_enable',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'pafe_stripe_subscriptions',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'pafe_stripe_subscriptions_only_price_enable',
							'operator' => '==',
							'value' => ''
						]
					]
				]
            ]
        );
		$this->add_control(
			'pafe_stripe_tax_rate_enable',
			[
				'label' => __( 'Use Tax?', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'pafe_stripe_enable',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'pafe_stripe_subscriptions',
							'operator' => '==',
							'value' => 'yes'
						],
					]
				]
			]
		);
		$this->add_control(
			'pafe_stripe_tax_rate',
			[
				'label' => __( 'Tax ID', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'pafe_stripe_enable',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'pafe_stripe_tax_rate_enable',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'pafe_stripe_subscriptions',
							'operator' => '==',
							'value' => 'yes'
						],
					]
				]
			]
		);
		$this->add_control(
			'pafe_stripe_subscriptions_field_enable',
			[
				'label' => __( 'Subscriptions Plan Select Field', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'pafe_stripe_enable',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'pafe_stripe_subscriptions',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'pafe_stripe_subscriptions_only_price_enable',
							'operator' => '==',
							'value' => ''
						]
					]
				]
			]
		);

		$this->add_control(
			'pafe_stripe_subscriptions_field',
			[
				'label' => __( 'Subscriptions Plan Select Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="plan_select"]', 'pafe' ),
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'pafe_stripe_enable',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'pafe_stripe_subscriptions',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'pafe_stripe_subscriptions_only_price_enable',
							'operator' => '==',
							'value' => ''
						],
						[
							'name' => 'pafe_stripe_subscriptions_field_enable',
							'operator' => '==',
							'value' => 'yes'
						]
					]
				]
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'pafe_stripe_subscriptions_field_enable_repeater',
			[
				'label' => __( 'Subscriptions Plan Select Field', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
			]
		);

		$repeater->add_control(
			'pafe_stripe_subscriptions_field_value',
			[
				'label' => __( 'Subscriptions Plan Field Value', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g Daily, Weekly, 3 Months, Yearly', 'pafe' ),
				'condition' => [
					'pafe_stripe_subscriptions_field_enable_repeater' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'pafe_stripe_subscriptions_interval',
			[
				'label' => __( 'Interval* (Required)', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'day' => 'day',
					'week' => 'week',
					'month' => 'month',
					'year' => 'year',
				],
				'default' => 'year',
			]
		);

		$repeater->add_control(
			'pafe_stripe_subscriptions_interval_count',
			[
				'label' => __( 'Interval Count* (Required)', 'pafe' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 1,
				'description' => __( 'Interval "month", Interval Count "3" = Bills every 3 months', 'pafe' ),
			]
		);

		$repeater->add_control(
			'pafe_stripe_subscriptions_amount',
			[
				'label' => __( 'Amount', 'pafe' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'description' => __( 'E.g 100, 1000', 'pafe' ),
				'condition' => [
					'pafe_stripe_subscriptions_amount_field_enable!' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'pafe_stripe_subscriptions_one_time_fee',
			[
				'label' => __( 'One-time Fee', 'pafe' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 0,
			]
		);

		$repeater->add_control(
			'pafe_stripe_subscriptions_amount_field_enable',
			[
				'label' => __( 'Amount Field Enable', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
			]
		);

		$repeater->add_control(
			'pafe_stripe_subscriptions_amount_field',
			[
				'label' => __( 'Amount Field Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="amount_yearly"]', 'pafe' ),
				'condition' => [
					'pafe_stripe_subscriptions_amount_field_enable' => 'yes',
				],
			]
		);

        $repeater->add_control(
            'pafe_stripe_subscriptions_cancel',
            [
                'label' => __( 'Canceling Subscriptions', 'pafe' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => 'Yes',
                'label_off' => 'No',
                'return_value' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'pafe_stripe_subscriptions_cancel_add',
            [
                'label' => __( '+', 'pafe' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 0,
                'condition' => [
                    'pafe_stripe_subscriptions_cancel' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'pafe_stripe_subscriptions_cancel_add_unit',
            [
                'label' => __( 'Unit', 'pafe' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'day' => 'day',
                    'month' => 'month',
                    'year' => 'year',
                ],
                'default' => 'day',
                'condition' => [
                    'pafe_stripe_subscriptions_cancel' => 'yes',
                ],
            ]
        );

		$this->add_control(
			'pafe_stripe_subscriptions_list',
			array(
				'type'    => Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '{{{ pafe_stripe_subscriptions_interval_count }}} {{{ pafe_stripe_subscriptions_interval }}}',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'pafe_stripe_enable',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'pafe_stripe_subscriptions',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'pafe_stripe_subscriptions_only_price_enable',
							'operator' => '==',
							'value' => ''
						]
					]
				]
			)
		);

		$this->add_control(
			'pafe_stripe_amount',
			[
				'label' => __( 'Amount', 'pafe' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'description' => __( 'E.g 100, 1000', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
					'pafe_stripe_amount_field_enable!' => 'yes',
					'pafe_stripe_subscriptions!' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_amount_field_enable',
			[
				'label' => __( 'Amount Field Enable', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
				'condition' => [
					'pafe_stripe_enable' => 'yes',
					'pafe_stripe_subscriptions!' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_amount_field',
			[
				'label' => __( 'Amount Field Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="amount"]', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
					'pafe_stripe_amount_field_enable' => 'yes',
					'pafe_stripe_subscriptions!' => 'yes',
				],
			]
		);
		$this->add_control(
			'pafe_stripe_create_invoice',
			[
				'label' => __( 'Create Invoice?', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'pafe_stripe_amount_field_enable' => 'yes',
				]
			]
		);
		$this->add_control(
			'pafe_stripe_tax_invoice',
			[
				'label' => __( 'Tax ID', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g: txr_1JJsT9Bi8bDi9Dwe8vDZZOVJ', 'pafe' ),
				'condition' => [
					'pafe_stripe_create_invoice' => 'yes'
				]
			]
		);
		$this->add_control(
			'pafe_stripe_customer_description',
			[
				'label' => __( 'Payment Description', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="description"]', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_customer_field_name',
			[
				'label' => __( 'Customer Name Field', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="name"]', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_customer_field_email',
			[
				'label' => __( 'Customer Email Field', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="email"]', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_customer_info_field',
			[
				'label' => __( 'Customer Description Field', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="description"]', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_customer_field_phone',
			[
				'label' => __( 'Customer Phone Field', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="phone"]', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_customer_field_address_line1',
			[
				'label' => __( 'Customer Address Line 1 Field', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="address_line1"]', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_customer_field_address_city',
			[
				'label' => __( 'Customer Address City Field', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="city"]', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_customer_field_address_country',
			[
				'label' => __( 'Customer Address Country Field', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="country"]. You should create a select field, the country value is two-letter country code (https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2)', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_customer_field_address_line2',
			[
				'label' => __( 'Customer Address Line 2 Field', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="address_line2"]', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_customer_field_address_postal_code',
			[
				'label' => __( 'Customer Address Postal Code Field', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="postal_code"]', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_customer_field_address_state',
			[
				'label' => __( 'Customer Address State Field', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="state"]', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_customer_receipt_email',
			[
				'label' => __( 'Receipt Email', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g [field id="email"]', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_payment_note',
			[
				'label' => __( 'Payment ID shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'classes' => 'forms-field-shortcode',
				'raw' => '<input class="elementor-form-field-shortcode" value="[payment_id]" readonly />',
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_status_note',
			[
				'label' => __( 'Payment Status shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'classes' => 'forms-field-shortcode',
				'raw' => '<input class="elementor-form-field-shortcode" value="[payment_status]" readonly />',
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_status_succeeded',
			[
				'label' => __( 'Succeeded Status', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'succeeded', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_status_pending',
			[
				'label' => __( 'Pending Status', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'pending', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_status_failed',
			[
				'label' => __( 'Failed Status', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'failed', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_message_succeeded',
			[
				'label' => __( 'Succeeded Message', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Payment success', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_message_pending',
			[
				'label' => __( 'Pending Message', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Payment pending', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_stripe_message_failed',
			[
				'label' => __( 'Failed Message', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Payment failed', 'pafe' ),
				'condition' => [
					'pafe_stripe_enable' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_paypal',
			[
				'label' => __( 'Paypal Payment', 'pafe' ),
			]
		);

		$this->add_control(
			'paypal_enable',
			[
				'label' => __( 'Enable', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'paypal_currency',
			[
				'label' => __( 'Currency', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'AUD' => 'AUD',
					'BRL' => 'BRL',
					'CAD' => 'CAD',
					'CZK' => 'CZK',
					'DKK' => 'DKK',
					'EUR' => 'EUR',
					'HKD' => 'HKD',
					'HUF' => 'HUF',
					'INR' => 'INR',
					'ILS' => 'ILS',
					'MYR' => 'MYR',
					'MXN' => 'MXN',
					'TWD' => 'TWD',
					'NZD' => 'NZD',
					'NOK' => 'NOK',
					'PHP' => 'PHP',
					'PLN' => 'PLN',
					'GBP' => 'GBP',
					'RUB' => 'RUB',
					'SGD' => 'SGD',
					'SEK' => 'SEK',
					'CHF' => 'CHF',
					'THB' => 'THB',
					'USD' => 'USD',
				],
				'default' => 'USD',
				'condition' => [
					'paypal_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'paypal_amount',
			[
				'label' => __( 'Amount', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g 100, 1000, [field id="amount"]', 'pafe' ),
				'condition' => [
					'paypal_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'paypal_description',
			[
				'label' => __( 'Description', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g Piotnet Addons, [field id="description"]', 'pafe' ),
				'condition' => [
					'paypal_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'paypal_locale',
			[
				'label'       => __( 'Locale', 'piotnetforms' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g "fr_FR". By default PayPal smartly detects the correct locale for the buyer based on their geolocation and browser preferences. Go to this url to get your locale value <a href="https://developer.paypal.com/docs/checkout/reference/customize-sdk/#locale" target="_blank">https://developer.paypal.com/docs/checkout/reference/customize-sdk/#locale</a>', 'piotnetforms' ),
				'condition'   => [
					'paypal_enable' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		//Mollie
		$this->start_controls_section(
			'section_mollie',
			[
				'label' => __( 'Mollie Payment', 'pafe' ),
			]
		);
		if(empty(get_option('piotnet-addons-for-elementor-pro-mollie-api-key'))){
			$this->add_control(
				'mollie_payment_note',
				[
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'raw' => __( 'Please enter mollie payment API Key at Dashboard->Piotnet Addons->Mollie Payment', 'pafe' ),
				]
			);
		}else{
			$this->add_control(
				'mollie_enable',
				[
					'label' => __( 'Enable', 'pafe' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'default' => '',
					'label_on' => 'Yes',
					'label_off' => 'No',
					'return_value' => 'yes',
				]
			);
			$this->add_control(
				'mollie_currency',
				[
					'label' => __( 'Currency', 'pafe' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'AUD' => 'AUD',
						'BRL' => 'BRL',
						'CAD' => 'CAD',
						'CZK' => 'CZK',
						'DKK' => 'DKK',
						'EUR' => 'EUR',
						'HKD' => 'HKD',
						'HUF' => 'HUF',
						'INR' => 'INR',
						'ILS' => 'ILS',
						'MYR' => 'MYR',
						'MXN' => 'MXN',
						'TWD' => 'TWD',
						'NZD' => 'NZD',
						'NOK' => 'NOK',
						'PHP' => 'PHP',
						'PLN' => 'PLN',
						'GBP' => 'GBP',
						'RUB' => 'RUB',
						'SGD' => 'SGD',
						'SEK' => 'SEK',
						'CHF' => 'CHF',
						'THB' => 'THB',
						'USD' => 'USD',
					],
					'default' => 'USD',
					'condition' => [
						'mollie_enable' => 'yes',
					],
				]
			);

			$this->add_control(
				'mollie_amount',
				[
					'label' => __( 'Amount', 'pafe' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'description' => __( 'E.g 100, 1000, [field id="amount"]', 'pafe' ),
					'condition' => [
						'mollie_enable' => 'yes',
					],
				]
			);

			$this->add_control(
				'mollie_description',
				[
					'label' => __( 'Description', 'pafe' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'description' => __( 'E.g Piotnet Addons, [field id="description"]', 'pafe' ),
					'condition' => [
						'mollie_enable' => 'yes',
					],
				]
			);

			$this->add_control(
				'mollie_locale',
				[
					'label' => __( 'Locale', 'pafe' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'en_US',
					'options' => [
						'en_US'  => __( 'en_US', 'pafe' ),
						'nl_NL'  => __( 'nl_NL', 'pafe' ),
						'nl_BE'  => __( 'nl_BE', 'pafe' ),
						'fr_FR'  => __( 'fr_FR', 'pafe' ),
						'fr_BE'  => __( 'fr_BE', 'pafe' ),
						'de_DE'  => __( 'de_DE', 'pafe' ),
						'de_AT'  => __( 'de_AT', 'pafe' ),
						'de_CH'  => __( 'de_CH', 'pafe' ),
						'es_ES'  => __( 'es_ES', 'pafe' ),
						'ca_ES'  => __( 'ca_ES', 'pafe' ),
						'pt_PT'  => __( 'pt_PT', 'pafe' ),
						'it_IT'  => __( 'it_IT', 'pafe' ),
						'nb_NO'  => __( 'nb_NO', 'pafe' ),
						'sv_SE'  => __( 'sv_SE', 'pafe' ),
						'fi_FI'  => __( 'fi_FI', 'pafe' ),
						'da_DK'  => __( 'da_DK', 'pafe' ),
						'is_IS'  => __( 'is_IS', 'pafe' ),
						'hu_HU'  => __( 'hu_HU', 'pafe' ),
						'pl_PL'  => __( 'pl_PL', 'pafe' ),
						'lv_LV'  => __( 'lv_LV', 'pafe' ),
						'lt_LT'  => __( 'lt_LT', 'pafe' ),
					],
					'condition' => [
						'mollie_enable' => 'yes',
					],
				]
			);
			$this->add_control(
				'pafe_mollie_message_succeeded',
				[
					'label' => __( 'Succeeded Message', 'pafe' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Payment success', 'pafe' ),
					'condition' => [
						'mollie_enable' => 'yes',
					],
				]
			);

			$this->add_control(
				'pafe_mollie_message_pending',
				[
					'label' => __( 'Pending Message', 'pafe' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Payment pending', 'pafe' ),
					'condition' => [
						'mollie_enable' => 'yes',
					],
				]
			);

			$this->add_control(
				'pafe_mollie_message_failed',
				[
					'label' => __( 'Failed Message', 'pafe' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Payment failed', 'pafe' ),
					'condition' => [
						'mollie_enable' => 'yes',
					],
				]
			);
			$this->add_control(
				'pafe_mollie_message_open',
				[
					'label' => __( 'Open Message', 'pafe' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Payment open', 'pafe' ),
					'condition' => [
						'mollie_enable' => 'yes',
					],
				]
			);
			$this->add_control(
				'pafe_mollie_message_canceled',
				[
					'label' => __( 'Canceled Message', 'pafe' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Payment canceled', 'pafe' ),
					'condition' => [
						'mollie_enable' => 'yes',
					],
				]
			);
			$this->add_control(
				'pafe_mollie_message_authorized',
				[
					'label' => __( 'Authorized Message', 'pafe' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Payment authorized', 'pafe' ),
					'condition' => [
						'mollie_enable' => 'yes',
					],
				]
			);
			$this->add_control(
				'pafe_mollie_message_expired',
				[
					'label' => __( 'Expired Message', 'pafe' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Payment expired', 'pafe' ),
					'condition' => [
						'mollie_enable' => 'yes',
					],
				]
			);
		}
		$this->end_controls_section();

		$this->start_controls_section(
			'section_recaptcha',
			[
				'label' => __( 'reCAPTCHA V3', 'pafe' ),
			]
		);

		$this->add_control(
			'pafe_recaptcha_enable',
			[
				'label' => __( 'Enable', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'description' => __('To use reCAPTCHA, you need to add the Site Key and Secret Key in Dashboard > Piotnet Addons > reCAPTCHA.'),
				'default' => '',
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'pafe_recaptcha_hide_badge',
			[
				'label' => __( 'Hide the reCaptcha v3 badge', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_email',
			[
				'label' => 'Email',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'submit_actions' => 'email',
				],
			]
		);

		$this->add_control(
			'email_to',
			[
				'label' => __( 'To', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => get_option( 'admin_email' ),
				'placeholder' => get_option( 'admin_email' ),
				'label_block' => true,
				'title' => __( 'Separate emails with commas', 'elementor-pro' ),
				'render_type' => 'none',
                'dynamic' => [
                    'active' => true,
                ],
			]
		);

		/* translators: %s: Site title. */
		$default_message = sprintf( __( 'New message from "%s"', 'elementor-pro' ), get_option( 'blogname' ) );

		$this->add_control(
			'email_subject',
			[
				'label' => __( 'Subject', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => $default_message,
				'placeholder' => $default_message,
				'label_block' => true,
				'render_type' => 'none',
                'dynamic' => [
                    'active' => true,
                ],
			]
		);

		$this->add_control(
			'email_content',
			[
				'label' => __( 'Message', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => '[all-fields]',
				'placeholder' => '[all-fields]',
				'description' => __( 'By default, all form fields are sent via shortcode: <code>[all-fields]</code>. Want to customize sent fields? Copy the shortcode that appears inside the field and paste it above. Enter this if you want to customize sent fields and remove line if field empty [field id="your_field_id"][remove_line_if_field_empty]', 'pafe' ),
				'label_block' => true,
				'render_type' => 'none',
			]
		);

		// $site_domain = Utils::get_site_domain();

		$site_domain = get_option('siteurl'); 
		$site_domain = str_replace('http://', '', $site_domain);
		$site_domain = str_replace('https://', '', $site_domain);
		$site_domain = str_replace('www', '', $site_domain);

		$this->add_control(
			'email_from',
			[
				'label' => __( 'From Email', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'email@' . $site_domain,
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'email_from_name',
			[
				'label' => __( 'From Name', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => get_bloginfo( 'name' ),
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'email_reply_to',
			[
				'label' => __( 'Reply-To', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'options' => [
					'' => '',
				],
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'email_to_cc',
			[
				'label' => __( 'Cc', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Separate emails with commas', 'elementor-pro' ),
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'email_to_bcc',
			[
				'label' => __( 'Bcc', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Separate emails with commas', 'elementor-pro' ),
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'disable_attachment_pdf_email',
			[
				'label' => esc_html__( 'Disable attachment PDF file', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'pafe' ),
				'label_off' => esc_html__( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'submit_actions' => 'pdfgenerator'
				]
			]
		);

		$this->add_control(
			'form_metadata',
			[
				'label' => __( 'Meta Data', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'label_block' => true,
				'separator' => 'before',
				'default' => [
					'date',
					'time',
					'page_url',
					'user_agent',
					'remote_ip',
				],
				'options' => [
					'date' => __( 'Date', 'elementor-pro' ),
					'time' => __( 'Time', 'elementor-pro' ),
					'page_url' => __( 'Page URL', 'elementor-pro' ),
					'user_agent' => __( 'User Agent', 'elementor-pro' ),
					'remote_ip' => __( 'Remote IP', 'elementor-pro' ),
				],
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'email_content_type',
			[
				'label' => __( 'Send As', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'plain',
				'render_type' => 'none',
				'options' => [
					'html' => __( 'HTML', 'elementor-pro' ),
					'plain' => __( 'Plain', 'elementor-pro' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_email_2',
			[
				'label' => 'Email 2',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'submit_actions' => 'email2',
				],
			]
		);

		$this->add_control(
			'email_to_2',
			[
				'label' => __( 'To', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => get_option( 'admin_email' ),
				'placeholder' => get_option( 'admin_email' ),
				'label_block' => true,
				'title' => __( 'Separate emails with commas', 'elementor-pro' ),
				'render_type' => 'none',
                'dynamic' => [
                    'active' => true,
                ],
			]
		);

		/* translators: %s: Site title. */
		$default_message = sprintf( __( 'New message from "%s"', 'elementor-pro' ), get_option( 'blogname' ) );

		$this->add_control(
			'email_subject_2',
			[
				'label' => __( 'Subject', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => $default_message,
				'placeholder' => $default_message,
				'label_block' => true,
				'render_type' => 'none',
                'dynamic' => [
                    'active' => true,
                ],
			]
		);

		$this->add_control(
			'email_content_2',
			[
				'label' => __( 'Message', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => '[all-fields]',
				'placeholder' => '[all-fields]',
				'description' => __( 'By default, all form fields are sent via shortcode: <code>[all-fields]</code>. Want to customize sent fields? Copy the shortcode that appears inside the field and paste it above. Enter this if you want to customize sent fields and remove line if field empty [field id="your_field_id"][remove_line_if_field_empty]', 'pafe' ),
				'label_block' => true,
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'email_from_2',
			[
				'label' => __( 'From Email', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'email@' . $site_domain,
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'email_from_name_2',
			[
				'label' => __( 'From Name', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => get_bloginfo( 'name' ),
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'email_reply_to_2',
			[
				'label' => __( 'Reply-To', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'options' => [
					'' => '',
				],
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'email_to_cc_2',
			[
				'label' => __( 'Cc', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Separate emails with commas', 'elementor-pro' ),
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'email_to_bcc_2',
			[
				'label' => __( 'Bcc', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Separate emails with commas', 'elementor-pro' ),
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'disable_attachment_pdf_email2',
			[
				'label' => esc_html__( 'Disable attachment PDF file', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'pafe' ),
				'label_off' => esc_html__( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'submit_actions' => 'pdfgenerator'
				]
			]
		);

		$this->add_control(
			'form_metadata_2',
			[
				'label' => __( 'Meta Data', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'label_block' => true,
				'separator' => 'before',
				'default' => [],
				'options' => [
					'date' => __( 'Date', 'elementor-pro' ),
					'time' => __( 'Time', 'elementor-pro' ),
					'page_url' => __( 'Page URL', 'elementor-pro' ),
					'user_agent' => __( 'User Agent', 'elementor-pro' ),
					'remote_ip' => __( 'Remote IP', 'elementor-pro' ),
				],
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'email_content_type_2',
			[
				'label' => __( 'Send As', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'plain',
				'render_type' => 'none',
				'options' => [
					'html' => __( 'HTML', 'elementor-pro' ),
					'plain' => __( 'Plain', 'elementor-pro' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_redirect',
			[
				'label' => __( 'Redirect', 'elementor-pro' ),
				'condition' => [
					'submit_actions' => 'redirect',
				],
			]
		);

		$this->add_control(
			'redirect_to',
			[
				'label' => __( 'Redirect To', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'https://your-link.com', 'elementor-pro' ),
				'label_block' => true,
				'render_type' => 'none',
				'classes' => 'elementor-control-direction-ltr',
			]
		);

		$this->add_control(
			'redirect_open_new_tab',
			[
				'label' => __( 'Open In New Tab', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
			]
		);

		$this->end_controls_section();

		if ( class_exists( 'WooCommerce' ) ) {  
			$this->start_controls_section(
				'section_woocommerce_add_to_cart',
				[
					'label' => __( 'WooCommerce Add To Cart', 'pafe' ),
					'condition' => [
						'submit_actions' => 'woocommerce_add_to_cart',
					],
				]
			);

			$this->add_control(
				'woocommerce_add_to_cart_product_id',
				[
					'label' => __( 'Product ID', 'elementor-pro' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'dynamic' => [
						'active' => true,
					],
					'condition' => [
						'submit_actions' => 'woocommerce_add_to_cart',
					],
				]
			);

			$this->add_control(
				'woocommerce_add_to_cart_price',
				[
					'label' => __( 'Price Field Shortcode', 'pafe' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Field Shortcode. E.g [field id="total"]', 'pafe' ),
					'label_block' => true,
					'condition' => [
						'submit_actions' => 'woocommerce_add_to_cart',
					],
				]
			);

			$this->add_control(
				'woocommerce_add_to_cart_custom_order_item_meta_enable',
				[
					'label' => __( 'Custom Order Item Meta', 'pafe' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'default' => '',
					'label_on' => 'Yes',
					'label_off' => 'No',
					'return_value' => 'yes',
				]
			);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'woocommerce_add_to_cart_custom_order_item_field_shortcode',
				[
					'label' => __( 'Field Shortcode, Repeater Shortcode', 'pafe' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
				]
			);

			$repeater->add_control(
				'woocommerce_add_to_cart_custom_order_item_remove_if_field_empty',
				[
					'label' => __( 'Remove If Field Empty', 'pafe' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'default' => '',
					'label_on' => 'Yes',
					'label_off' => 'No',
					'return_value' => 'yes',
				]
			);

			$this->add_control(
				'woocommerce_add_to_cart_custom_order_item_list',
				array(
					'type'    => Elementor\Controls_Manager::REPEATER,
					'fields'  => $repeater->get_controls(),
					'title_field' => '{{{ woocommerce_add_to_cart_custom_order_item_field_shortcode }}}',
					'condition' => [
						'woocommerce_add_to_cart_custom_order_item_meta_enable' => 'yes',
					],
				)
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_woocommerce_checkout',
				[
					'label' => __( 'WooCommerce Checkout', 'pafe' ),
					'condition' => [
						'submit_actions' => 'woocommerce_checkout',
					],
				]
			);

			$this->add_control(
				'pafe_woocommerce_checkout_remove_fields',
				[
					'label' => __( 'Remove fields from WooCommerce Checkout Form', 'pafe' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::SELECT2,
					'multiple' => true,
					'options' => [
						'billing_first_name' => __( 'Billing First Name', 'pafe' ),
						'billing_last_name' => __( 'Billing Last Name', 'pafe' ),
						'billing_company' => __( 'Billing Company', 'pafe' ),
						'billing_address_1' => __( 'Billing Address 1', 'pafe' ),
						'billing_address_2' => __( 'Billing Address 2', 'pafe' ),
						'billing_city' => __( 'Billing City', 'pafe' ),
						'billing_postcode' => __( 'Billing Post Code', 'pafe' ),
						'billing_country' => __( 'Billing Country', 'pafe' ),
						'billing_state' => __( 'Billing State', 'pafe' ),
						'billing_phone' => __( 'Billing Phone', 'pafe' ),
						'billing_email' => __( 'Billing Email', 'pafe' ),
						'order_comments' => __( 'Order Comments', 'pafe' ),
						'shipping_first_name' => __( 'Shipping First Name', 'pafe' ),
						'shipping_last_name' => __( 'Shipping Last Name', 'pafe' ),
						'shipping_company' => __( 'Shipping Company', 'pafe' ),
						'shipping_address_1' => __( 'Shipping Address 1', 'pafe' ),
						'shipping_address_2' => __( 'Shipping Address 2', 'pafe' ),
						'shipping_city' => __( 'Shipping City', 'pafe' ),
						'shipping_postcode' => __( 'Shipping Post Code', 'pafe' ),
						'shipping_country' => __( 'Shipping Country', 'pafe' ),
						'shipping_state' => __( 'Shipping State', 'pafe' ),
					],
				]
			);

			$this->add_control(
				'pafe_woocommerce_checkout_product_id',
				[
					'label' => __( 'Product ID* (Required)', 'pafe' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'condition' => [
						'submit_actions' => 'woocommerce_checkout',
					],
				]
			);

			$this->add_control(
				'pafe_woocommerce_checkout_redirect',
				[
					'label' => __( 'Redirect', 'pafe' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'condition' => [
						'submit_actions' => 'woocommerce_checkout',
					],
				]
			);

			$this->end_controls_section();
    	}

		if ( defined('ELEMENTOR_PRO_VERSION') ) {
		    if ( version_compare( ELEMENTOR_PRO_VERSION, '2.4.0', '>=' ) ) {
		    	$this->start_controls_section(
					'section_popup',
					[
						'label' => __( 'Popup', 'elementor-pro' ),
						'condition' => [
							'submit_actions' => 'popup',
						],
					]
				);

				$this->add_control(
					'popup_action',
					[
						'label' => __( 'Action', 'elementor-pro' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => [
							'' => __( 'Choose', 'elementor-pro' ),
							'open' => __( 'Open Popup', 'elementor-pro' ),
							'close' => __( 'Close Popup', 'elementor-pro' ),
						],
					]
				);

				if ( version_compare( ELEMENTOR_PRO_VERSION, '2.6.0', '<' ) ) {

					$this->add_control(
						'popup_action_popup_id',
						[
							'label' => __( 'Popup', 'elementor-pro' ),
							'type' => \ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
							'label_block' => true,
							'filter_type' => 'popup_templates',
							'condition' => [
								'popup_action' => ['open','close'],
							],
						]
					);

				} else {

					$this->add_control(
						'popup_action_popup_id',
						[
							'label' => __( 'Popup', 'elementor-pro' ),
							'type' => \ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
							'label_block' => true,
							'autocomplete' => [
								'object' => \ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_LIBRARY_TEMPLATE,
								'query' => [
									'posts_per_page' => 20,
									'meta_query' => [
										[
											'key' => Elementor\Core\Base\Document::TYPE_META_KEY,
											'value' => 'popup',
										],
									],
								],
							],
							'condition' => [
								'popup_action' => ['open','close'],
							],
						]
					);

				}

				$this->end_controls_section();

				$this->start_controls_section(
					'section_popup_open',
					[
						'label' => __( 'Open Popup', 'elementor-pro' ),
						'condition' => [
							'submit_actions' => 'open_popup',
						],
					]
				);

				if ( version_compare( ELEMENTOR_PRO_VERSION, '2.6.0', '<' ) ) {

					$this->add_control(
						'popup_action_popup_id_open',
						[
							'label' => __( 'Popup', 'elementor-pro' ),
							'type' => \ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
							'label_block' => true,
							'filter_type' => 'popup_templates',
						]
					);

				} else {

					$this->add_control(
						'popup_action_popup_id_open',
						[
							'label' => __( 'Popup', 'elementor-pro' ),
							'type' => \ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
							'label_block' => true,
							'autocomplete' => [
								'object' => \ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_LIBRARY_TEMPLATE,
								'query' => [
									'posts_per_page' => 20,
									'meta_query' => [
										[
											'key' => Elementor\Core\Base\Document::TYPE_META_KEY,
											'value' => 'popup',
										],
									],
								],
							],
						]
					);

				}

				$this->end_controls_section();

				$this->start_controls_section(
					'section_popup_close',
					[
						'label' => __( 'Close Popup', 'elementor-pro' ),
						'condition' => [
							'submit_actions' => 'close_popup',
						],
					]
				);

				if ( version_compare( ELEMENTOR_PRO_VERSION, '2.6.0', '<' ) ) {

					$this->add_control(
						'popup_action_popup_id_close',
						[
							'label' => __( 'Popup', 'elementor-pro' ),
							'type' => \ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
							'label_block' => true,
							'filter_type' => 'popup_templates',
						]
					);

				} else {

					$this->add_control(
						'popup_action_popup_id_close',
						[
							'label' => __( 'Popup', 'elementor-pro' ),
							'type' => \ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
							'label_block' => true,
							'autocomplete' => [
								'object' => \ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_LIBRARY_TEMPLATE,
								'query' => [
									'posts_per_page' => 20,
									'meta_query' => [
										[
											'key' => Elementor\Core\Base\Document::TYPE_META_KEY,
											'value' => 'popup',
										],
									],
								],
							],
						]
					);

				}

				$this->end_controls_section();
	    	}
    	}

    	$this->start_controls_section(
			'section_webhook',
			[
				'label' => __( 'Webhook', 'elementor-pro' ),
				'condition' => [
					'submit_actions' => 'webhook',
				],
			]
		);

		$this->add_control(
			'webhooks',
			[
				'label' => __( 'Webhook URL', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'https://your-webhook-url.com', 'elementor-pro' ),
				'label_block' => true,
				'separator' => 'before',
				'description' => __( 'Enter the integration URL (like Zapier) that will receive the form\'s submitted data.', 'elementor-pro' ),
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'webhooks_advanced_data',
			[
				'label' => __( 'Advanced Data', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
				'render_type' => 'none',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_remote_request',
			[
				'label' => __( 'Remote Request', 'pafe' ),
				'condition' => [
					'submit_actions' => 'remote_request',
				],
			]
		);

		$this->add_control(
			'remote_request_url',
			[
				'label' => __( 'URL', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'https://your-endpoint-url.com', 'pafe' ),
				'label_block' => true,
				'render_type' => 'none',
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'remote_request_arguments_parameter',
			[
				'label' => __( 'Parameter', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g method, timeout', 'pafe' ),
			]
		);

		$repeater->add_control(
			'remote_request_arguments_value',
			[
				'label' => __( 'Value', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g POST, 30', 'pafe' ),
			]
		);

		$this->add_control(
			'remote_request_arguments_list',
			array(
				'type'    => Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '{{{ remote_request_arguments_parameter }}} = {{{ remote_request_arguments_value }}}',
				'label' => __( 'Request arguments. E.g method = POST, method = GET, timeout = 30', 'pafe' ),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'remote_request_header',
			[
				'label' => __( 'Header arguments', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'remote_request_header_parameter',
			[
				'label' => __( 'Parameter', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g content-type, x-powered-by', 'pafe' ),
			]
		);

		$repeater->add_control(
			'remote_request_header_value',
			[
				'label' => __( 'Value', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g application/php, PHP/5.3.3', 'pafe' ),
			]
		);

		$this->add_control(
			'remote_request_header_list',
			array(
				'type'    => Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '{{{ remote_request_header_parameter }}} = {{{ remote_request_header_value }}}',
				'label' => __( 'Header arguments. E.g content-type = application/php, x-powered-by = PHP/5.3.3', 'pafe' ),
				'separator' => 'before',
				'condition' => [
					'remote_request_header' => 'yes'
				]
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'remote_request_body_parameter',
			[
				'label' => __( 'Parameter', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g email', 'pafe' ),
			]
		);

		$repeater->add_control(
			'remote_request_body_value',
			[
				'label' => __( 'Value', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g [field id="email"]', 'pafe' ),
			]
		);

		$this->add_control(
			'remote_request_body_list',
			array(
				'type'    => Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '{{{ remote_request_body_parameter }}} = {{{ remote_request_body_value }}}',
				'label' => __( 'Body arguments. E.g email = [field id="email"]', 'pafe' ),
				'separator' => 'before',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_mailchimp',
			[
				'label' => __( 'MailChimp', 'pafe' ),
				'condition' => [
					'submit_actions' => 'mailchimp',
				],
			]
		);

		$this->add_control(
			'mailchimp_note',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'classes' => 'elementor-descriptor',
				'raw' => __( 'You are using MailChimp API Key set in WP Dashboard > Piotnet Addons > MailChimp Integration. You can also set a different MailChimp API Key by choosing "Custom".', 'pafe' ),
				'condition' => [
					'mailchimp_api_key_source' => 'default',
				],
			]
		);

		$this->add_control(
			'mailchimp_api_key_source',
			[
				'label' => __( 'API Key', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'pafe' ),
					'custom' => __( 'Custom', 'pafe' ),
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'mailchimp_api_key',
			[
				'label' => __( 'Custom API Key', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mailchimp_api_key_source' => 'custom',
				],
				'description' => __( 'Use this field to set a custom API Key for the current form', 'pafe' ),
			]
		);

		$this->add_control(
			'mailchimp_audience_id',
			[
				'label' => __( 'Audience ID', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g 82e5ab8640', 'pafe' ),
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'mailchimp_acceptance_field_shortcode',
			[
				'label' => __( 'Acceptance Field Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g [field id="acceptance"]', 'pafe' ),
			]
		);

		$this->add_control(
			'mailchimp_groups_id',
			[
				'label' => __( 'Groups', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => [],
				'label_block' => true,
				'multiple' => true,
				'render_type' => 'none',
				'condition' => [
					'mailchimp_list!' => '',
				],
			]
		);

		$this->add_control(
			'mailchimp_tags',
			[
				'label' => __( 'Tags', 'elementor-pro' ),
				'description' => __( 'Add comma separated tags', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'render_type' => 'none',
				'condition' => [
					'mailchimp_list!' => '',
				],
			]
		);

		// $this->add_control(
		// 	'mailchimp_double_opt_in',
		// 	[
		// 		'label' => __( 'Double Opt-In', 'elementor-pro' ),
		// 		'type' => \Elementor\Controls_Manager::SWITCHER,
		// 		'default' => '',
		// 		'condition' => [
		// 			'mailchimp_list!' => '',
		// 		],
		// 	]
		// );

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'mailchimp_field_mapping_address',
			[
				'label' => __( 'Address Field', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
			]
		);

		$repeater->add_control(
			'mailchimp_field_mapping_tag_name',
			[
				'label' => __( 'Tag Name. E.g EMAIL, FNAME, LNAME, ADDRESS', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g EMAIL, FNAME, LNAME, ADDRESS', 'pafe' ),
			]
		);

		$repeater->add_control(
			'mailchimp_field_mapping_field_shortcode',
			[
				'label' => __( 'Field Shortcode E.g [field id="email"]', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g [field id="email"]', 'pafe' ),
				'condition' => [
					'mailchimp_field_mapping_address' => '',
				],
			]
		);

		$repeater->add_control(
			'mailchimp_field_mapping_address_field_shortcode_address_1',
			[
				'label' => __( 'Address 1 Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mailchimp_field_mapping_address' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'mailchimp_field_mapping_address_field_shortcode_address_2',
			[
				'label' => __( 'Address 2 Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mailchimp_field_mapping_address' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'mailchimp_field_mapping_address_field_shortcode_city',
			[
				'label' => __( 'City Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mailchimp_field_mapping_address' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'mailchimp_field_mapping_address_field_shortcode_state',
			[
				'label' => __( 'State Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mailchimp_field_mapping_address' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'mailchimp_field_mapping_address_field_shortcode_zip',
			[
				'label' => __( 'Zip Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mailchimp_field_mapping_address' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'mailchimp_field_mapping_address_field_shortcode_country',
			[
				'label' => __( 'Country Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mailchimp_field_mapping_address' => 'yes',
				],
			]
		);

		$this->add_control(
			'mailchimp_field_mapping_list',
			array(
				'type'    => Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '{{{ mailchimp_field_mapping_tag_name }}} = {{{ mailchimp_field_mapping_field_shortcode }}}',
				'label' => __( 'Field Mapping', 'pafe' ),
			)
		);

		$this->end_controls_section();

		//Mailchimp V3
		$this->start_controls_section(
			'section_mailchimp_v3',
			[
				'label' => __( 'MailChimp V3', 'pafe' ),
				'condition' => [
					'submit_actions' => 'mailchimp_v3',
				],
			]
		);

		$this->add_control(
			'mailchimp_note_v3',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'classes' => 'elementor-descriptor',
				'raw' => __( 'You are using MailChimp API Key set in WP Dashboard > Piotnet Addons > MailChimp Integration. You can also set a different MailChimp API Key by choosing "Custom".', 'pafe' ),
				'condition' => [
					'mailchimp_api_key_source_v3' => 'default',
				],
			]
		);

		$this->add_control(
			'mailchimp_api_key_source_v3',
			[
				'label' => __( 'API Key', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'pafe' ),
					'custom' => __( 'Custom', 'pafe' ),
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'mailchimp_api_key_v3',
			[
				'label' => __( 'Custom API Key', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mailchimp_api_key_source_v3' => 'custom',
				],
				'description' => __( 'Use this field to set a custom API Key for the current form', 'pafe' ),
			]
		);
		$this->add_control(
			'mailchimp_confirm_email_v3',
			[
				'label' => __( 'Send confirm email?', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		$this->add_control(
			'mailchimp_acceptance_field_shortcode_v3',
			[
				'label' => __( 'Acceptance Field Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g [field id="acceptance"]', 'pafe' ),
			]
		);

		$this->add_control(
			'mailchimp_get_data_list',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<button data-pafe-mailchimp-get-data-list class="pafe-admin-button-ajax elementor-button elementor-button-default" type="button">Get List IDs&ensp;<i class="fas fa-spinner fa-spin"></i></button><br><div data-pafe-mailchimp-get-data-list-results></div>', 'pafe' ),
			]
		);

		$this->add_control(
			'mailchimp_list_id',
			[
				'label' => __( 'List ID (<i>required</i>)', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g 82e5ab8640', 'pafe' ),
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'mailchimp_get_group_and_fields',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<button data-pafe-mailchimp-get-group-and-field class="pafe-admin-button-ajax elementor-button elementor-button-default" type="button">Get Groups and Fields <i class="fas fa-spinner fa-spin"></i></button><br>', 'pafe' ),
			]
		);

		$this->add_control(
			'mailchimp_get_groups',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<div data-pafe-mailchimp-get-groups></div>', 'pafe' ),
			]
		);

		$this->add_control(
			'mailchimp_group_id',
			[
				'label' => __( 'Group IDs', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g ade42df840', 'pafe' ),
				'description' => 'You can add multiple group ids separated by commas.',
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'mailchimp_get_merge_fields',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<div data-pafe-mailchimp-get-data-merge-fields></div>', 'pafe' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'mailchimp_field_mapping_address_v3',
			[
				'label' => __( 'Address Field', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
			]
		);

		$repeater->add_control(
			'mailchimp_field_mapping_tag_name_v3',
			[
				'label' => __( 'Tag Name', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g EMAIL, FNAME, LNAME, ADDRESS', 'pafe' ),
			]
		);

		$repeater->add_control(
			'mailchimp_field_mapping_field_shortcode_v3',
			[
				'label' => __( 'Field Shortcode E.g [field id="email"]', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g [field id="email"]', 'pafe' ),
				'condition' => [
					'mailchimp_field_mapping_address_v3' => '',
				],
			]
		);

		$repeater->add_control(
			'mailchimp_v3_field_mapping_address_field_shortcode_address_1',
			[
				'label' => __( 'Address 1 Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mailchimp_field_mapping_address_v3' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'mailchimp_v3_field_mapping_address_field_shortcode_address_2',
			[
				'label' => __( 'Address 2 Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mailchimp_field_mapping_address_v3' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'mailchimp_v3_field_mapping_address_field_shortcode_city',
			[
				'label' => __( 'City Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mailchimp_field_mapping_address_v3' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'mailchimp_v3_field_mapping_address_field_shortcode_state',
			[
				'label' => __( 'State Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mailchimp_field_mapping_address_v3' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'mailchimp_v3_field_mapping_address_field_shortcode_zip',
			[
				'label' => __( 'Zip Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mailchimp_field_mapping_address_v3' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'mailchimp_v3_field_mapping_address_field_shortcode_country',
			[
				'label' => __( 'Country Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mailchimp_field_mapping_address_v3' => 'yes',
				],
			]
		);

		$this->add_control(
			'mailchimp_field_mapping_list_v3',
			array(
				'type'    => Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '{{{ mailchimp_field_mapping_tag_name_v3 }}} = {{{ mailchimp_field_mapping_field_shortcode_v3 }}}',
				'label' => __( 'Field Mapping', 'pafe' ),
			)
		);

		$this->end_controls_section();
		//Mailerlite V2
		$this->start_controls_section(
			'section_mailerlite_v2',
			[
				'label' => __( 'Mailerlite V2', 'pafe' ),
				'condition' => [
					'submit_actions' => 'mailerlite_v2',
				],
			]
		);
		$this->add_control(
			'mailerlite_note_v2',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'classes' => 'elementor-descriptor',
				'raw' => __( 'You are using Mailerlite API Key set in WP Dashboard > Piotnet Addons > Mailerlite Integration. You can also set a different MailChimp API Key by choosing "Custom".', 'pafe' ),
				'condition' => [
					'mailerlite_api_key_source_v2' => 'default',
				],
			]
		);

		$this->add_control(
			'mailerlite_api_key_source_v2',
			[
				'label' => __( 'API Key', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'pafe' ),
					'custom' => __( 'Custom', 'pafe' ),
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'mailerlite_api_key_v2',
			[
				'label' => __( 'Custom API Key', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mailerlite_api_key_source_v2' => 'custom',
				],
				'description' => __( 'Use this field to set a custom API Key for the current form', 'pafe' ),
			]
		);
		$this->add_control(
			'mailerlite_api_acceptance_field',
			[
				'label' => __( 'Acceptance Field?', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		$this->add_control(
			'mailerlite_api_acceptance_field_shortcode',
			[
				'label' => __( 'Acceptance Field Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g [field id="acceptance"]', 'pafe' ),
				'condition' => [
					'mailerlite_api_acceptance_field' => 'yes'
				]
			]
		);
		$this->add_control(
			'mailerlite_api_get_groups',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<button data-pafe-mailerlite_api_get_groups class="pafe-admin-button-ajax elementor-button elementor-button-default" type="button">Get Groups <i class="fas fa-spinner fa-spin"></i></button><br><div class="pafe-mailerlite-group-result" data-pafe-mailerlite-api-get-groups-results></div>', 'pafe' ),
			]
		);
		$this->add_control(
			'mailerlite_api_group',
			[
				'label' => __( 'Group ID', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type your group here', 'pafe' ),
			]
		);
		$this->add_control(
			'mailerlite_api_get_fields',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<div class="pafe-mailerlite-fields-result" data-pafe-mailerlite-api-get-fields-results></div>', 'pafe' ),
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'mailerlite_api_field_mapping_tag_name_v2',
			[
				'label' => __( 'Tag Name', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g EMAIL, FNAME, LNAME, ADDRESS', 'pafe' ),
			]
		);

		$repeater->add_control(
			'mailerlite_api_field_mapping_field_shortcode_v2',
			[
				'label' => __( 'Field Shortcode E.g [field id="email"]', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g [field id="email"]', 'pafe' ),
			]
		);

		$this->add_control(
			'mailerlite_api_field_mapping_list_v2',
			array(
				'type'    => Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '{{{ mailerlite_api_field_mapping_tag_name_v2 }}} = {{{ mailerlite_api_field_mapping_field_shortcode_v2 }}}',
				'label' => __( 'Field Mapping', 'pafe' ),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_mailerlite',
			[
				'label' => __( 'MailerLite', 'pafe' ),
				'condition' => [
					'submit_actions' => 'mailerlite',
				],
			]
		);

		$this->add_control(
			'mailerlite_note',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'classes' => 'elementor-descriptor',
				'raw' => __( 'You are using MailerLite API Key set in WP Dashboard > Piotnet Addons > MailerLite Integration. You can also set a different MailerLite API Key by choosing "Custom".', 'pafe' ),
				'condition' => [
					'mailerlite_api_key_source' => 'default',
				],
			]
		);

		$this->add_control(
			'mailerlite_api_key_source',
			[
				'label' => __( 'API Key', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'pafe' ),
					'custom' => __( 'Custom', 'pafe' ),
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'mailerlite_api_key',
			[
				'label' => __( 'Custom API Key', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mailerlite_api_key_source' => 'custom',
				],
				'description' => __( 'Use this field to set a custom API Key for the current form', 'pafe' ),
			]
		);

		$this->add_control(
			'mailerlite_group_id',
			[
				'label' => __( 'GroupID', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g 87562190', 'pafe' ),
			]
		);

		$this->add_control(
			'mailerlite_email_field_shortcode',
			[
				'label' => __( 'Email Field Shortcode* (Required)', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g [field id="email"]', 'pafe' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'mailerlite_field_mapping_tag_name',
			[
				'label' => __( 'Tag Name', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g email, name, last_name', 'pafe' ),
			]
		);

		$repeater->add_control(
			'mailerlite_field_mapping_field_shortcode',
			[
				'label' => __( 'Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g [field id="email"]', 'pafe' ),
			]
		);

		$this->add_control(
			'mailerlite_field_mapping_list',
			array(
				'type'    => Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '{{{ mailerlite_field_mapping_tag_name }}} = {{{ mailerlite_field_mapping_field_shortcode }}}',
				'label' => __( 'Field Mapping', 'pafe' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_getresponse',
			[
				'label' => __( 'Getresponse', 'pafe' ),
				'condition' => [
					'submit_actions' => 'getresponse',
				],
			]
		);

		$this->add_control(
			'getresponse_api_key_source',
			[
				'label' => __( 'API Key', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'pafe' ),
					'custom' => __( 'Custom', 'pafe' ),
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'getresponse_api_key',
			[
				'label' => __( 'Custom API Key', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'getresponse_api_key_source' => 'custom',
				],
			]
		);

		$this->add_control(
			'getresponse_get_data_list',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<button data-pafe-getresponse-get-data-list class="pafe-admin-button-ajax elementor-button elementor-button-default" type="button">Get List&ensp;<i class="fas fa-spinner fa-spin"></i></button><div id="pafe-getresponse-list"></div>', 'pafe' ),
			]
		);

		$this->add_control(
			'getresponse_campaign_id',
			[
				'label' => __( 'Campaign ID', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'getresponse_date_of_cycle',
			[
				'label' => __( 'Day Of Cycle', 'pafe' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'step' => 1,
			]
		);
		$this->add_control(
			'getresponse_get_data_custom_fields',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<button data-pafe-getresponse-get-data-custom-fields class="pafe-admin-button-ajax elementor-button elementor-button-default" type="button">Get Custom Fields&ensp;<i class="fas fa-spinner fa-spin"></i></button><div id="pafe-getresponse-custom-fields"></div>', 'pafe' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'getresponse_field_mapping_multiple',
			[
				'label' => __( 'Multiple Field?', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$repeater->add_control(
			'getresponse_field_mapping_tag_name',
			[
				'label' => __( 'Tag Name', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g email, name, last_name', 'pafe' ),
			]
		);

		$repeater->add_control(
			'getresponse_field_mapping_field_shortcode',
			[
				'label' => __( 'Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g [field id="email"]', 'pafe' ),
			]
		);

		$this->add_control(
			'getresponse_field_mapping_list',
			array(
				'type'    => Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '{{{ getresponse_field_mapping_tag_name }}} = {{{ getresponse_field_mapping_field_shortcode }}}',
				'label' => __( 'Field Mapping', 'pafe' ),
			)
		);

		$this->end_controls_section();

		//Mailpoet
		$this->start_controls_section(
			'section_mailpoet',
			[
				'label' => __( 'Mailpoet', 'pafe' ),
				'condition' => [
					'submit_actions' => 'mailpoet',
				],
			]
		);
		$this->add_control(
			'mailpoet_send_confirmation_email',
			[
				'label' => __( 'Send Confirmation Email?', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
				'description' => __( 'Send confirmation email to customer, if not send subscriber to be added as unconfirmed.', 'pafe' ),
			]
		);
		$this->add_control(
			'mailpoet_send_welcome_email',
			[
				'label' => __( 'Send Welcome Email', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		$this->add_control(
			'mailpoet_skip_subscriber_notification',
			[
				'label' => __( 'Skip subscriber notification?', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		$this->add_control(
			'mailpoet_acceptance_field',
			[
				'label' => __( 'Acceptance Field?', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'mailpoet_acceptance_field_shortcode',
			[
				'label' => __( 'Acceptance Field Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '', 'pafe' ),
				'placeholder' => __( 'Enter your shortcode here', 'pafe' ),
				'condition' => [
					'mailpoet_acceptance_field' => 'yes'
				]
			]
		);
		$this->add_control(
			'mailpoet_select_list',
			[
				'label' => __( 'Select Lists', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->mailpoet_get_list(),
				'label_block' => true,
			]
		);
		$this->add_control(
			'mailpoet_get_custom_field',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<button class="elementor-button elementor-button-default piotnet-button-mailpoet-get-fields" data-piotnet-mailpoet-get-custom-fields>GET CUSTOM FIELDS <i class="fa fa-spinner fa-spin"></i></button><div class="piotnet-custom-fiedls-result" data-piotnet-mailpoet-result-custom-field></div>', 'plugin-name' ),
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'mailpoet_field_mapping_tag_name',
			[
				'label' => __( 'Tag Name', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g email, name, last_name', 'pafe' ),
			]
		);

		$repeater->add_control(
			'mailpoet_field_mapping_field_shortcode',
			[
				'label' => __( 'Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g [field id="email"]', 'pafe' ),
			]
		);
		$this->add_control(
			'mailpoet_field_mapping_list',
			array(
				'type'    => Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '{{{ mailpoet_field_mapping_tag_name }}} = {{{ mailpoet_field_mapping_field_shortcode }}}',
				'label' => __( 'Field Mapping', 'pafe' ),
				'default' => [
					[
						'mailpoet_field_mapping_tag_name' =>  __( 'email', 'pafe' ),
					]
				]
			)
		);

		$this->end_controls_section();
		//Zoho CRM
		$zoho_token = get_option('zoho_access_token');
		$this->start_controls_section(
			'section_zohocrm',
			[
				'label' => __( 'Zoho CRM', 'pafe' ),
				'condition' => [
					'submit_actions' => 'zohocrm',
				],
			]
		);
		if(empty($zoho_token)){
			$this->add_control(
				'zohocrm_note',
				[
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'raw' => __( 'Please get the Zoho CRM token in admin page.', 'pafe' ),
				]
			);
		}else{
			$this->add_control(
				'zohocrm_module',
				[
					'label' => __( 'Zoho Module', 'pafe' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'Leads',
					'options' => [
						'Leads'  => __( 'Leads', 'pafe' ),
						'Accounts' => __( 'Accounts', 'pafe' ),
						'Contacts' => __( 'Contacts', 'pafe' ),
						'campaigns' => __( 'Campaigns', 'pafe' ),
						'deals' => __( 'Deals', 'pafe' ),
						'tasks' => __( 'Tasks', 'pafe' ),
						'cases' => __( 'Cases', 'pafe' ),
						'events' => __( 'Events', 'pafe' ),
						'calls' => __( 'Calls', 'pafe' ),
						'solutions' => __( 'Solutions', 'pafe'),
						'products' => __( 'Products', 'pafe'),
						'vendors' => __( 'Vendors', 'pafe'),
						'pricebooks' => __( 'Pricebooks', 'pafe'),
						'quotes' => __( 'Quotes', 'pafe'),
						'salesorders' => __( 'Salesorders', 'pafe' ),
						'purchaseorders' => __( 'Purchaseorders', 'pafe'),
						'invoices' => __( 'Invoices', 'pafe'),
						'custom' => __( 'Custom', 'pafe'),
						'notes' => __( 'Notes', 'pafe'),
 					],
				]
			);
			$this->add_control(
				'zohocrm_get_field_mapping',
				[
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'raw' => __( '<button data-pafe-zohocrm-get-tag-name class="pafe-admin-button-ajax elementor-button elementor-button-default" type="button">Get Tag Name&ensp;<i class="fas fa-spinner fa-spin"></i></button><div id="pafe-zohocrm-tag-name"></div>', 'pafe' ),
				]
			);
			$this->add_control(
				'zoho_acceptance_field',
				[
					'label' => __( 'Acceptance Field?', 'pafe' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Yes', 'pafe' ),
					'label_off' => __( 'No', 'pafe' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);
			$this->add_control(
				'zoho_acceptance_field_shortcode',
				[
					'label' => __( 'Acceptance Field Shortcode', 'pafe' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( '', 'pafe' ),
					'placeholder' => __( 'Enter your shortcode here', 'pafe' ),
					'condition' => [
						'zoho_acceptance_field' => 'yes'
					]
				]
			);
	
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'zohocrm_tagname', [
					'label' => __( 'Tag Name', 'pafe' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'zohocrm_shortcode', [
					'label' => __( 'Field Shortcode', 'pafe' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'label_block' => true,
				]
			);

			$this->add_control(
				'zohocrm_fields_map',
				[
					'label' => __( 'Fields Mapping', 'pafe' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'list_title' => __( 'Title #1', 'pafe' ),
							'list_content' => __( 'Item content. Click the edit button to change this text.', 'pafe' ),
						],
						[
							'list_title' => __( 'Title #2', 'pafe' ),
							'list_content' => __( 'Item content. Click the edit button to change this text.', 'pafe' ),
						],
					],
					'title_field' => '{{{ zohocrm_tagname }}} --- {{{ zohocrm_shortcode }}}',
				]
			);
		}
		$this->end_controls_section();
		//Convertkit
		$this->start_controls_section(
			'section_convertkit',
			[
				'label' => __( 'Convertkit', 'pafe' ),
				'condition' => [
					'submit_actions' => 'convertkit',
				],
			]
		);
		$this->add_control(
			'convertkit_api_key_source',
			[
				'label' => __( 'API Credentials', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default', 'pafe' ),
					'custom' => __( 'Custom', 'pafe' ),
				],
				'render_type' => 'none'
			]
		);
		$this->add_control(
			'convertkit_api_key',
			[
				'label' => __( 'Custom API Key', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type your api key here', 'pafe' ),
				'condition'   => [
					'convertkit_api_key_source' => 'custom',
				],
				'render_type' => 'none'
			]
		);
		$this->add_control(
			'convertkit_acceptance_field',
			[
				'label' => __( 'Acceptance Field?', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'pafe' ),
				'label_off' => __( 'Hide', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
				'render_type' => 'none'
			]
		);
		$this->add_control(
			'convertkit_acceptance_field_shortcode',
			[
				'label' => __( 'Acceptance Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type your shortcode here', 'pafe' ),
				'condition'   => [
					'convertkit_acceptance_field' => 'yes',
				],
				'render_type' => 'none'
			]
		);
		$this->add_control(
			'convertkit_form_id',
			[
				'label' => __( 'Form ID', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type your form id here', 'pafe' ),
				'render_type' => 'none'
			]
		);
		$this->add_control(
			'convertkit_get_data_list',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<button data-pafe-convertkit-get-data class="pafe-admin-button-ajax elementor-button elementor-button-default" type="button">Click Here To Get Form IDs&ensp;<i class="fas fa-spinner fa-spin"></i></button><br><br><div data-pafe-convertkit-get-data-results></div>', 'pafe' ),
			]
		);
		$this->add_control(
			'convertkit_get_data_fields',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<div data-pafe-convertkit-fields></div>', 'pafe' ),
			]
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'convertkit_tag_name', [
				'label' => __( 'Tag Name', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'render_type' => 'none',
				'placeholder' => __( 'E.g email, name, last_name', 'pafe' ),
			]
		);

		$repeater->add_control(
			'convertkit_shortcode', [
				'label' => __( 'Field Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'render_type' => 'none',
				'placeholder' => __( 'E.g [field id="email"]', 'piotnetforms' ),
			]
		);
		$this->add_control(
			'convertkit_field_mapping_list',
			[
				'label' => __( 'Mapping List', 'pafe' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'convertkit_tag_name' => __( 'email', 'pafe' ),
					],
				],
				'title_field' => '{{{ convertkit_tag_name }}}',
			]
		);
		$this->end_controls_section();
		//Sendinblue
		$this->start_controls_section(
			'section_sendinblue',
			[
				'label' => __( 'Sendinblue', 'pafe' ),
				'condition' => [
					'submit_actions' => 'sendinblue',
				],
			]
		);
		$this->add_control(
			'sendinblue_note',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'classes' => 'elementor-descriptor',
				'raw' => __( 'You are using Sendinblue API Key set in WP Dashboard > Piotnet Addons > Sendinblue Integration. You can also set a different Sendinblue API Key by choosing "Custom".', 'pafe' ),
				'condition' => [
					'sendinblue_api_key_source' => 'default',
				],
			]
		);
		$this->add_control(
			'sendinblue_api_key_source',
			[
				'label' => __( 'API Key', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'pafe' ),
					'custom' => __( 'Custom', 'pafe' ),
				],
				'default' => 'default',
			]
		);
		$this->add_control(
			'sendinblue_api_key',
			[
				'label' => __( 'Custom API Key', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'sendinblue_api_key_source' => 'custom',
				],
				'description' => __( 'Use this field to set a custom API Key for the current form', 'pafe' ),
			]
		);
		$this->add_control(
			'sendinblue_api_acceptance_field',
			[
				'label' => __( 'Acceptance Field?', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		$this->add_control(
			'sendinblue_api_acceptance_field_shortcode',
			[
				'label' => __( 'Acceptance Field Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g [field id="acceptance"]', 'pafe' ),
				'condition' => [
					'sendinblue_api_acceptance_field' => 'yes'
				]
			]
		);
		$this->add_control(
			'sendinblue_list_ids',
			[
				'label' => __( 'List ID', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'sendinblue_api_get_list',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<button data-pafe-sendinblue-get-list class="pafe-admin-button-ajax elementor-button elementor-button-default" type="button">Get Lists <i class="fas fa-spinner fa-spin"></i></button><br><div class="pafe-sendinblue-group-result" data-pafe-sendinblue-api-get-list-results></div>', 'pafe' ),
			]
		);
		$this->add_control(
			'sendinblue_api_get_attr',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<div class="pafe-sendinblue-attribute-result" data-pafe-sendinblue-api-get-attributes-result></div>', 'pafe' ),
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'sendinblue_tagname', [
				'label' => __( 'Tag Name', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'sendinblue_shortcode', [
				'label' => __( 'Field Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'sendinblue_fields_map',
			[
				'label' => __( 'Fields Mapping', 'pafe' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'sendinblue_tagname' => __( 'email', 'pafe' ),
					],
				],
				'title_field' => '{{{ sendinblue_tagname }}} --- {{{ sendinblue_shortcode }}}',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_constant',
			[
				'label' => __( 'Constant Contact', 'pafe' ),
				'condition' => [
					'submit_actions' => 'constantcontact',
				],
			]
		);
		$constant_contact_token = get_option('piotnet-constant-contact-access-token');
		if(empty($constant_contact_token)){
			$this->add_control(
				'constant_contact_token_note',
				[
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'raw' => __( 'Please get the Constant Contact token in admin page.', 'pafe' ),
				]
			);
		}else{
			$this->add_control(
				'constant_contact_list_id',
				[
					'label' => __( 'List IDs', 'pafe' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Enter your list id here', 'pafe' ),
				]
			);
			$this->add_control(
				'constant_contact_kind',
				[
					'label' => __( 'The type of address', 'pafe' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => 'home',
					'description' => 'The type of address. Available types are: home, work, mobile, fax, other',
					'placeholder' => __( 'Enter your kind here', 'pafe' ),
				]
			);
			$this->add_control(
				'constant_contact_get_list',
				[
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'raw' => __( '<button data-pafe-constant-contact-get-list class="pafe-admin-button-ajax elementor-button elementor-button-default" type="button">Get List&ensp;<i class="fas fa-spinner fa-spin"></i></button><div id="pafe-constant-contact-list"></div>', 'pafe' ),
				]
			);
			$this->add_control(
				'constant_contact_get_custom_fields',
				[
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'raw' => __( '<button data-pafe-constant-contact-get-tag-name class="pafe-admin-button-ajax elementor-button elementor-button-default" type="button">Get Custom Fields&ensp;<i class="fas fa-spinner fa-spin"></i></button><div id="pafe-constant-contact-tag-name"></div>', 'pafe' ),
				]
			);
			$this->add_control(
				'constant_contact_acceptance_field',
				[
					'label' => __( 'Acceptance Field?', 'pafe' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Yes', 'pafe' ),
					'label_off' => __( 'No', 'pafe' ),
					'return_value' => 'yes',
					'default' => '',
				]
			);
			$this->add_control(
				'constant_contact_acceptance_field_shortcode',
				[
					'label' => __( 'Acceptance Field Shortcode', 'pafe' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( '', 'pafe' ),
					'placeholder' => __( 'Enter your shortcode here', 'pafe' ),
					'condition' => [
						'constant_contact_acceptance_field' => 'yes'
					]
				]
			);
			$repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'constant_contact_tagname', [
						'label' => __( 'Tag Name', 'pafe' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
					]
				);

				$repeater->add_control(
					'constant_contact_shortcode', [
						'label' => __( 'Field Shortcode', 'pafe' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
					]
				);

				$this->add_control(
					'constant_contact_fields_map',
					[
						'label' => __( 'Fields Mapping', 'pafe' ),
						'type' => \Elementor\Controls_Manager::REPEATER,
						'fields' => $repeater->get_controls(),
						'default' => [
							[
								'constant_contact_tagname' => __( 'email_address', 'pafe' ),
							],
						],
						'title_field' => '{{{ constant_contact_tagname }}} --- {{{ constant_contact_shortcode }}}',
					]
				);
			}
		$this->end_controls_section();
		// Add Sendy Integration
		$this->start_controls_section(
			'section_sendy',
			[
				'label' => __( 'Sendy', 'pafe' ),
				'condition' => [
					'submit_actions' => 'sendy',
				],
			]
		);

		$this->add_control(
            'sendy_url',
            [
                'label' => __( 'Sendy URL', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => 'http://your_sendy_installation/',
                'label_block' => true,
                'separator' => 'before',
                'description' => __( 'Enter the URL where you have Sendy installed, including a trailing /', 'pafe' ),
            ]
        );
		$this->add_control(
	        'sendy_api_key',
	        [
	            'label' => __( 'API key', 'pafe' ),
	            'type' => \Elementor\Controls_Manager::TEXT,
	            'description' => __( 'To find it go to Settings (top right corner) -> Your API Key.', 'pafe' ),
	        ]
        );
        $this->add_control(
            'sendy_list_id',
            [
                'label' => __( 'Sendy List ID', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'separator' => 'before',
                'description' => __( 'The list id you want to subscribe a user to.', 'pafe' ),
            ]
        );

        $this->add_control(
            'sendy_name_field_shortcode',
            [
                'label' => __( 'Name Field Shortcode', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'E.g [field id="name"]', 'pafe' ),
            ]
        );

        $this->add_control(
            'sendy_email_field_shortcode',
            [
                'label' => __( 'Email Field Shortcode', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'E.g [field id="email"]', 'pafe' ),
            ]
        );

        $this->add_control(
			'sendy_gdpr_shortcode',
			[
				'label' => __( 'GDPR/CCPA Compliant Shortcode', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g [field id="acceptance"]', 'pafe' ),
			]
		);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'custom_field_name', [
                'label' => __( 'Sendy Custom Field Name', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'Place the Name of the Sendy Custom Field', 'pafe' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'custom_field_shortcode', [
                'label' => __( 'Custom Field Shortcode', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'E.g [field id="phone"]', 'pafe' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'sendy_custom_fields',
            [
                'label' => __( 'Custom Fields', 'pafe' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ custom_field_name }}}',
                'separator' => 'before'
            ]
        );

		$this->end_controls_section();

		// End Sendy Integration

		// Add Sendfox
        $this->start_controls_section(
            'add_sendfox_setting_controls',
            [
                'label' => __( 'SendFox', 'pafe' ),
                'condition' => [
                    'submit_actions' => 'sendfox',
                ],
            ]
        );

        $this->add_control(
            'sendfox_list_id',
            [
                'label' => __( 'Sendfox List ID', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'sendfox_email_field_shortcode',
            [
                'label' => __( 'Email Field Shortcode', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'E.g [field id="email"]', 'pafe' ),
            ]
        );

        $this->add_control(
            'sendfox_first_name_field_shortcode',
            [
                'label' => __( 'Frist Name Field Shortcode', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'E.g [field id="first_name"]', 'pafe' ),
            ]
        );

        $this->add_control(
            'sendfox_last_name_field_shortcode',
            [
                'label' => __( 'Last Name Field Shortcode', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'E.g [field id="last_name"]', 'pafe' ),
            ]
        );

        $this->end_controls_section();
        // End Sendfox

        //Slack Webhook
        $this->start_controls_section(
            'section_webhook_slack',
            [
                'label' => __( 'Webhook Slack', 'pafe' ),
                'condition' => [
                    'submit_actions' => 'webhook_slack',
                ],
            ]
        );

        $this->add_control(
            'slack_webhook_url',
            [
                'label'       => __( 'Webhook URL', 'pafe' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => __( "Enter the webhook URL that will receive the form's submitted data. <a href='https://slack.com/apps/A0F7XDUAZ-incoming-webhooks/' target='_blank'>Click here for instructions</a>" , 'pafe' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'slack_icon_url',
            [
                'label'       => __( 'Icon URL', 'pafe' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'slack_channel',
            [
                'label'       => __( 'Channel', 'pafe' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => 'Enter the channel ID / channel name'
            ]
        );

        $this->add_control(
            'slack_username',
            [
                'label'       => __( 'Username', 'pafe' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'slack_pre_text',
            [
                'label'       => __( 'Pre Text', 'pafe' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'slack_title',
            [
                'label'       => __( 'Title', 'pafe' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'slack_message',
            [
                'label'       => __( 'Message', 'pafe' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'       => '[all-fields]',
                'placeholder' => '[all-fields]',
                'description' => __( 'By default, all form fields are sent via shortcode: <code>[all-fields]</code>. Want to customize sent fields? Copy the shortcode that appears inside the field and paste it above. Enter this if you want to customize sent fields and remove line if field empty [field id="your_field_id"][remove_line_if_field_empty]', 'pafe' ),
                'label_block' => true,
                'render_type' => 'none',
            ]
        );

        $this->add_control(
            'slack_color',
            [
                'label'       => __( 'Color', 'pafe' ),
                'type'        => \Elementor\Controls_Manager::COLOR,
                'value'       => '#2eb886',
            ]
        );

        $this->add_control(
            'slack_timestamp',
            [
                'label' => __( 'Timestamp', 'pafe' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => 'Yes',
                'label_off' => 'No',
                'return_value' => 'yes',
            ]
        );

        $this->end_controls_section();
        //End Slack Webhook

        // Add Twilio whatsapp
        $this->start_controls_section(
			'twilio_whatsapp_settings_section',
			[
				'label' => __( 'Twilio Whatsapp', 'pafe' ),
				'condition' => [
					'submit_actions' => 'twilio_whatsapp',
				],
			]
		);

		$this->add_control(
            'whatsapp_to',
            [
                'label' => __( 'Whatsapp To', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'Phone with country code, like: +14155238886', 'pafe' ),
            ]
        );

        $this->add_control(
            'whatsapp_form',
            [
                'label' => __( 'Whatsapp Form', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'Phone with country code, like: +14155238886', 'pafe' ),
            ]
        );

        $this->add_control(
            'whatsapp_message',
            [
				'label' => __( 'Message', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => '[all-fields]',
				'placeholder' => '[all-fields]',
				'description' => __( 'By default, all form fields are sent via shortcode: <code>[all-fields]</code>. Want to customize sent fields? Copy the shortcode that appears inside the field and paste it above. Enter this if you want to customize sent fields and remove line if field empty [field id="your_field_id"][remove_line_if_field_empty]', 'pafe' ),
				'label_block' => true,
				'render_type' => 'none',
			]
        );

		$this->end_controls_section();
		// End Twilio whatsapp

		// Add Twilio SMS
        $this->start_controls_section(
            'add_twilio_sms_setting_controls',
            [
                'label' => __( 'Twilio SMS', 'pafe' ),
                'condition' => [
                    'submit_actions' => 'twilio_sms',
                ],
            ]
        );

        $this->add_control(
            'twilio_sms_to',
            [
                'label' => __( 'To', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'Phone with country code, like: +14155238886', 'pafe' ),
            ]
        );

        $this->add_control(
            'twilio_sms_messaging_service_id',
            [
                'label' => __( 'Messaging ServiceS ID', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'twilio_sms_message',
            [
                'label' => __( 'Message', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '[all-fields]',
                'placeholder' => '[all-fields]',
                'description' => __( 'By default, all form fields are sent via shortcode: <code>[all-fields]</code>. Want to customize sent fields? Copy the shortcode that appears inside the field and paste it above. Enter this if you want to customize sent fields and remove line if field empty [field id="your_field_id"][remove_line_if_field_empty]', 'pafe' ),
                'label_block' => true,
                'render_type' => 'none',
            ]
        );

        $this->end_controls_section();

        //SendGrid
        $this->start_controls_section(
            'section_twilio_sendgrid',
            [
                'label' => __( 'Twilio SendGrid', 'pafe' ),
                'condition' => [
                    'submit_actions' => 'twilio_sendgrid',
                ],
            ]
        );

        // $this->add_control(
        // 	'twilio_sendgrid_url',
        // 	[
        // 		'label'       => __( 'SendGrid URL', 'pafe' ),
        // 		'type'        => \Elementor\Controls_Manager::TEXT,
        // 		'default' => 'https://api.sendgrid.com/v3/marketing/contacts',
        // 		'label_block' => true,
        // 	]
        // );

        $this->add_control(
            'twilio_sendgrid_api_key',
            [
                'label' => __( 'API Key', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                // 'condition' => [
                // 	'mailchimp_api_key_source' => 'custom',
                // ],
                // 'description' => __( 'Use this field to set a custom API Key for the current form', 'pafe' ),
            ]
        );

        $this->add_control(
            'twilio_sendgrid_get_data_list',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __( '<button data-pafe-twilio-sendgrid-get-data-list class="pafe-admin-button-ajax elementor-button elementor-button-default" type="button">Get List IDs&ensp;<i class="fas fa-spinner fa-spin"></i></button><br><div data-pafe-twilio-sendgrid-get-data-list-results></div>', 'pafe' ),
            ]
        );

        $this->add_control(
            'twilio_sendgrid_list_ids',
            [
                'label' => __( 'List IDs', 'pafe' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'title' => __( 'Separate IDs with commas', 'pafe' ),
                'render_type' => 'none',
            ]
        );

        $this->add_control(
            'twilio_sendgrid_email_field_shortcode',
            [
                'label'       => __( 'Email Field Shortcode* (Required)', 'pafe' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'E.g [field id="email"]', 'pafe' ),
                'label_block' => true,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'twilio_sendgrid_field_mapping_tag_name',
            [
                'label' => __( 'Tag Name', 'pafe' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'E.g first_name, last_name, phone_number', 'pafe' ),
            ]
        );

        $repeater->add_control(
            'twilio_sendgrid_field_mapping_field_shortcode',
            [
                'label' => __( 'Field Shortcode', 'pafe' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'E.g [field id="first_name"]', 'pafe' ),
            ]
        );

        $this->add_control(
            'twilio_sendgrid_field_mapping_list',
            array(
                'type'    => Elementor\Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'title_field' => '{{{ twilio_sendgrid_field_mapping_tag_name }}} = {{{ twilio_sendgrid_field_mapping_field_shortcode }}}',
                'label' => __( 'Field Mapping', 'pafe' ),
            )
        );

        $this->end_controls_section();
        //End SendGrid

		//Activecampaign

		$this->start_controls_section(
			'section_activecampaign',
			[
				'label' => __( 'ActiveCampaign', 'pafe' ),
				'condition' => [
					'submit_actions' => 'activecampaign',
				],
			]
		);

		$this->add_control(
			'activecampaign_note',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'classes' => 'elementor-descriptor',
				'raw' => __( 'You are using ActiveCampaign API Key set in WP Dashboard > Piotnet Addons > ActiveCampaign Integration. You can also set a different ActiveCampaign API Key by choosing "Custom".', 'pafe' ),
				'condition' => [
					'activecampaign_api_key_source' => 'default',
				],
			]
		);

		$this->add_control(
			'activecampaign_api_key_source',
			[
				'label' => __( 'API Credentials', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'pafe' ),
					'custom' => __( 'Custom', 'pafe' ),
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'activecampaign_api_url',
			[
				'label' => __( 'Custom API URL', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'activecampaign_api_key_source' => 'custom',
				],
				'description' => __( 'Use this field to set a custom API URL for the current form', 'pafe' ),
			]
		);

		$this->add_control(
			'activecampaign_api_key',
			[
				'label' => __( 'Custom API Key', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'activecampaign_api_key_source' => 'custom',
				],
				'description' => __( 'Use this field to set a custom API Key for the current form', 'pafe' ),
			]
		);
		
		$this->add_control(
			'activecampaign_edit_contact',
			[
				'label' => __( 'Edit Contact?', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		$this->add_control(
			'activecampaign_get_data_list',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<button data-pafe-campaign-get-data-list class="pafe-admin-button-ajax elementor-button elementor-button-default" type="button">Click Here To Get List IDs&ensp;<i class="fas fa-spinner fa-spin"></i></button><br><br><div data-pafe-campaign-get-data-list-results></div>', 'pafe' ),
				'content_classes' => 'your-class',
			]
		);

		$this->add_control(
			'activecampaign_list',
			[
				'label' => __( 'List ID* (Required)', 'pafe' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 1,
			]
		);

		$this->add_control(
			'activecampaign_get_flelds',
			[	
				'label' => __( 'Tag Name List', 'pafe' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<div>
				<br><br>
				<input type="text" value="email" readonly/>
				<br><br>
				<input type="text" value="first_name" readonly/>
				<br><br>
				<input type="text" value="last_name" readonly/>
				<br><br>
				<input type="text" value="phone" readonly/>
				<br><br>
				<input type="text" value="customer_acct_name" readonly/>
				<br><br>
				<input type="text" value="tags" readonly/>
				<br><br>
				</div>
				<div data-pafe-campaign-get-fields></div>
				', 'pafe' ),
				'content_classes' => 'your-class',
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'activecampaign_field_mapping_tag_name',
			[
				'label' => __( 'Tag Name', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g email, name, last_name', 'pafe' ),
			]
		);

		$repeater->add_control(
			'activecampaign_field_mapping_field_shortcode',
			[
				'label' => __( 'Field Shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g [field id="email"]', 'pafe' ),
			]
		);

		$this->add_control(
			'activecampaign_field_mapping_list',
			array(
				'type'    => Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '{{{ activecampaign_field_mapping_tag_name }}} = {{{ activecampaign_field_mapping_field_shortcode }}}',
				'label' => __( 'Field Mapping', 'pafe' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_pdfgenerator',
			[
				'label' => __( 'PDF Generator', 'pafe' ),
				'condition' => [
					'submit_actions' => 'pdfgenerator',
				],
			]
		);
		$this->add_control(
			'pdfgenerator_set_custom',
			[
				'label' => __( 'Custom Layout', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		$this->add_control(
			'pdfgenerator_import_template',
			[
				'label' => __( 'Import Template', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'pdfgenerator_set_custom' => 'yes'
				]
			]
		);
		$this->add_control(
			'pdfgenerator_template_url',
			[
				'label' => __( 'PDF Template File URL', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'Go to WP Dashboard > Media > Library > Upload PDF Template File > Get File URL', 'pafe' ),
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'pdfgenerator_set_custom',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'pdfgenerator_import_template',
							'operator' => '==',
							'value' => 'yes'
						]
					]
				]
			]
		);
		$this->add_control(
			'pdfgenerator_size',
			[
				'label' => __( 'PDF Size', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'a4',
				'options' => [
					'a3'  => __( 'A3 (297*420)', 'pafe' ),
					'a4' => __( 'A4 (210*297)', 'pafe' ),
					'a5' => __( 'A5 (148*210)', 'pafe' ),
					'letter' => __( 'Letter (215.9*279.4)', 'pafe' ),
					'legal' => __( 'Legal (215.9*355.6)', 'pafe' ),
				],
			]
		);
		$this->add_control(
			'pdfgenerator_title',
			[
				'label' => __( 'Title', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title here', 'pafe' ),
				'condition' => [
					'pdfgenerator_set_custom' => ''
				]
			]
		);
		// $this->add_control(
		// 	'pdfgenerator_title_font_weight',
		// 	[
		// 		'label' => __( 'Title Font Weight', 'pafe' ),
		// 		'type' => \Elementor\Controls_Manager::SELECT,
		// 		'default' => 'B',
		// 		'options' => [
		// 			''  => __( 'Normal', 'pafe' ),
		// 			'B' => __( 'Bold', 'pafe' ),
		// 			'I' => __( 'Italic', 'pafe' ),
		// 			'BI' => __( 'Bold Italic', 'pafe' ),
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .pafe-form-builder-pdf-generator-preview__item' => 'color: {{VALUE}}',
		// 		],
		// 		'condition' => [
		// 			'pdfgenerator_set_custom' => ''
		// 		]
		// 	]
		// );
		$this->add_control(
			'pdfgenerator_title_text_align',
			[
				'label' => __( 'Title Align', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => __( 'Left', 'pafe' ),
					'center' => __( 'Center', 'pafe' ),
					'right' => __( 'Right', 'pafe' ),
				],
				'selectors' => [
					'{{WRAPPER}} .pafe-form-builder-pdf-generator-preview__title' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'pdfgenerator_set_custom' => ''
				]
			]
		);
		$this->add_control(
			'pdfgenerator_title_font_size',
			[
				'label' => __( 'Title Font Size', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .pafe-form-builder-pdf-generator-preview__title' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'pdfgenerator_set_custom' => ''
				]
			]
		);
		$pdf_fonts = $this->pafe_get_pdf_fonts();
		$this->add_control(
			'pdfgenerator_font_family',
			[
				'label' => __( 'Font Family', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => $pdf_fonts,
			]
		);
		$this->add_control(
			'pdfgenerator_save_file',
			[
				'label' => __( 'Save file after submit', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'render_type' => 'none',
				'default' => '',
			]
		);
		$this->add_control(
			'pdfgenerator_custom_export_file',
			[
				'label' => __( 'Custom Export File Name ', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		$this->add_control(
			'pdfgenerator_export_file_name',
			[
				'label' => __( 'File Name', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type your file here', 'pafe' ),
				'condition' => [
					'pdfgenerator_custom_export_file' => 'yes'
				]
			]
		);
		$this->add_control(
			'pdfgenerator_font_size',
			[
				'label' => __( 'Content Font Size', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .pafe-form-builder-pdf-generator-preview__item' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'pdfgenerator_set_custom' => 'yes'
				]
			]
		);

		$this->add_control(
			'pdfgenerator_color',
			[
				'label' => __( 'Title Color', 'pafe' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .pafe-form-builder-pdf-generator-preview__item' => 'color: {{VALUE}}',
				],
				'condition' => [
					'pdfgenerator_set_custom' => ''
				]
			]
		);
		$this->add_control(
			'pdfgenerator_content_html',
			[
				'label' => __( 'Content HTML?', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'pdfgenerator_background_image_enable',
			[
				'label' => __( 'Image Background', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'Hide', 'pafe' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'pdfgenerator_background_image',
			[
				'label' => __( 'Choose Image', 'pafe' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'description' => "Only access image fomat jpg.",
				'condition'=>[
					'pdfgenerator_background_image_enable'=>'yes'
				]
			]
		);
		$this->add_control(
			'pdfgenerator_heading_field_mapping',
			[
				'label' => __( 'Field Mapping', 'pafe' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'pdfgenerator_set_custom' => ''
				]
			]
		);
		$this->add_control(
			'pdfgenerator_heading_field_mapping_show_label',
			[
				'label' => __( 'Show Label', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'pdfgenerator_set_custom' => ''
				]
			]
		);
		$this->add_control(
			'pdfgenerator_heading_field_mapping_font_size',
			[
				'label' => __( 'Font Size', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 12,
				],
				'selectors' => [
					'{{WRAPPER}} .pafe-form-builder-field-mapping__preview' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'pdfgenerator_set_custom' => ''
				]
			]
		);
		$this->add_control(
			'pdfgenerator_heading_field_mapping_color',
			[
				'label' => __( 'Text Color', 'pafe' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .pafe-form-builder-field-mapping__preview' => 'color: {{VALUE}}',
				],
				'condition' => [
					'pdfgenerator_set_custom' => ''
				]
			]
		);
		$this->add_control(
			'pdfgenerator_heading_field_mapping_text_align',
			[
				'label' => __( 'Text Align', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => __( 'Left', 'pafe' ),
					'center' => __( 'Center', 'pafe' ),
					'right' => __( 'Right', 'pafe' ),
				],
				'selectors' => [
					'{{WRAPPER}} .pafe-form-builder-field-mapping__preview' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'pdfgenerator_set_custom' => ''
				]
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'pdfgenerator_field_shortcode',
			[
				'label' => __( 'Field shortcode', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g [field id="email"]', 'pafe' ),
			]
		);

		$repeater->add_control(
			'pdfgenerator_field_type',
			[
				'label' => __( 'Type', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default', 'pafe' ),
					'image' => __( 'Image', 'pafe' ),
					'image-upload' => __( 'Image upload', 'pafe' ),
				],
			]
		);

		$repeater->add_control(
			'pdfgenerator_image_field',
			[
				'label' => __( 'Choose Image', 'pafe' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition'=>[
					'pdfgenerator_field_type' => ['image-upload']
				]
			]
		);

		// $this->add_control(
		// 	'pdfgenerator_image_field',
		// 	[
		// 		'label' => __( 'Image Upload', 'pafe' ),
		// 		'type' => \Elementor\Controls_Manager::SWITCHER,
		// 		'label_on' => __( 'Yes', 'pafe' ),
		// 		'label_off' => __( 'Hide', 'pafe' ),
		// 		'return_value' => 'yes',
		// 		'default' => 'yes',
		// 		'condition'=>[
		// 			'pdfgenerator_field_type' => ['image','image-upload']
		// 		]
		// 	]
		// );

		$repeater->add_control(
			'custom_font',
			[
				'label' => __( 'Custom Font Size?', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition'=>[
					'pdfgenerator_field_type' => ['default']
				],
			]
		);
		$repeater->add_control(
			'auto_position',
			[
				'label' => __( 'Auto Position?', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'pafe' ),
				'label_off' => __( 'No', 'pafe' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition'=>[
					'pdfgenerator_field_type' => ['default']
				],
			]
		);

		$repeater->add_control(
			'font_size',
			[
				'label' => __( 'Font Size', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 14,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'=>[
					'custom_font'=>'yes'
				]
			]
		);
		$pdf_fonts_styles = $this->pafe_get_pdf_fonts_style();
		$repeater->add_control(
			'font_weight',
			[
				'label' => __( 'Font Style', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'N',
				'options' => $pdf_fonts_styles,
				'condition'=>[
					'custom_font'=>'yes'
				]
			]
		);
		$repeater->add_control(
			'color',
			[
				'label' => __( 'Text Color', 'pafe' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
				],
				'condition'=>[
					'custom_font'=>'yes'
				]
			]
		);
		$repeater->add_control(
			'pdfgenerator_width',
			[
				'label' => __( 'Width', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => '%',
				'range' =>[
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{SIZE}}%;',
					'{{WRAPPER}} {{CURRENT_ITEM}} img' => 'width: {{SIZE}}%;',
				],
				'condition'=>[
					'pdfgenerator_field_type' => ['default', 'image-upload', 'image']
				]
			]
		);
		$repeater->add_control(
			'pdfgenerator_height',
			[
				'label' => __( 'Height', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => '%',
				'range' =>[
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'height: {{SIZE}}%;',
					'{{WRAPPER}} {{CURRENT_ITEM}} img' => 'height: {{SIZE}}%;',
				],
				'condition'=>[
					'pdfgenerator_field_type' => ['image']
				]
			]
		);

		$repeater->add_control(
			'pdfgenerator_set_x',
			[
				'label' => __( 'Set X (mm)', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => '%',
				'range' =>[
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'description' => 'This feature only works while custom layout enabled.',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}%;',
				],
				'condition'=>[
					'auto_position' => ''
				],
			]
		);

		$repeater->add_control(
			'pdfgenerator_set_y',
			[
				'label' => __( 'Set Y (mm)', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => '%',
				'range' =>[
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'description' => 'This feature only works while custom layout enabled.',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}%;',
				],
				'condition'=>[
					'auto_position' => ''
				],
			]
		);
		//Image
		$repeater->add_control(
			'pdfgenerator_image_set_x',
			[
				'label' => __( 'Set X (mm)', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => '%',
				'range' =>[
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'description' => 'This feature only works while custom layout enabled.',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} img' => 'left: {{SIZE}}%;',
				],
				'condition'=>[
					'pdfgenerator_field_type' => ['image', 'image-upload']
				],
			]
		);

		$repeater->add_control(
			'pdfgenerator_image_set_y',
			[
				'label' => __( 'Set Y (mm)', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => '%',
				'range' =>[
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'description' => 'This feature only works while custom layout enabled.',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} img' => 'top: {{SIZE}}%;',
				],
				'condition'=>[
					'pdfgenerator_field_type' => ['image', 'image-upload']
				],
			]
		);

		$this->add_control(
			'pdfgenerator_field_mapping_list',
			array(
				'type'    => Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '{{{ pdfgenerator_field_shortcode }}} - {{{pdfgenerator_width["size"]}}} - {{{ pdfgenerator_set_x["size"] }}} - {{{ pdfgenerator_set_y["size"] }}} - {{{pdfgenerator_field_type}}}',
				'label' => __( 'Field Mapping', 'pafe' ),
				'condition' => [
					'pdfgenerator_set_custom' => 'yes'
				]
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_form_options',
			[
				'label' => __( 'Custom Messages', 'elementor-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'success_message',
			[
				'label' => __( 'Success Message', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'The form was sent successfully.', 'elementor-pro' ),
				'placeholder' => __( 'The form was sent successfully.', 'elementor-pro' ),
				'label_block' => true,
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'error_message',
			[
				'label' => __( 'Error Message', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'An error occured.', 'elementor-pro' ),
				'placeholder' => __( 'An error occured.', 'elementor-pro' ),
				'label_block' => true,
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'required_field_message',
			[
				'label' => __( 'Required Message', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'This field is required.', 'elementor-pro' ),
				'placeholder' => __( 'This field is required.', 'elementor-pro' ),
				'label_block' => true,
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'invalid_message',
			[
				'label' => __( 'Invalid Message', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( "There's something wrong. The form is invalid.", "elementor-pro" ),
				'placeholder' => __( "There's something wrong. The form is invalid.", "elementor-pro" ),
				'label_block' => true,
				'render_type' => 'none',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_conditional_logic',
			[
				'label' => __( 'Conditional Logic', 'pafe' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'pafe_conditional_logic_form_enable',
			[
				'label' => __( 'Enable', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'description' => __( 'This feature only works on the frontend.', 'pafe' ),
				'label_on' => 'Yes',
				'label_off' => 'No',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'pafe_conditional_logic_form_speed',
			[
				'label' => __( 'Speed', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g 100, 1000, slow, fast' ),
				'default' => 400,
				'condition' => [
					'pafe_conditional_logic_form_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'pafe_conditional_logic_form_easing',
			[
				'label' => __( 'Easing', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'E.g swing, linear' ),
				'default' => 'swing',
				'condition' => [
					'pafe_conditional_logic_form_enable' => 'yes',
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'pafe_conditional_logic_form_if',
			[
				'label' => __( 'Show this submit If', 'pafe' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Field Shortcode', 'pafe' ),
			]
		);

		$repeater->add_control(
			'pafe_conditional_logic_form_comparison_operators',
			[
				'label' => __( 'Comparison Operators', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'options' => [
					'not-empty' => __( 'not empty', 'pafe' ),
					'empty' => __( 'empty', 'pafe' ),
					'=' => __( 'equals', 'pafe' ),
					'!=' => __( 'not equals', 'pafe' ),
					'>' => __( '>', 'pafe' ),
					'>=' => __( '>=', 'pafe' ),
					'<' => __( '<', 'pafe' ),
					'<=' => __( '<=', 'pafe' ),
					'checked' => __( 'checked', 'pafe' ),
					'unchecked' => __( 'unchecked', 'pafe' ),
					'contains' => __( 'contains', 'pafe' ),
				],
			]
		);

		$repeater->add_control(
			'pafe_conditional_logic_form_type',
			[
				'label' => __( 'Type Value', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'options' => [
					'string' => __( 'String', 'pafe' ),
					'number' => __( 'Number', 'pafe' ),
				],
				'default' => 'string',
				'condition' => [
					'pafe_conditional_logic_form_comparison_operators' => ['=','!=','>','>=','<','<=', 'contains'],
				],
			]
		);

		$repeater->add_control(
			'pafe_conditional_logic_form_value',
			[
				'label' => __( 'Value', 'pafe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( '50', 'pafe' ),
				'condition' => [
					'pafe_conditional_logic_form_comparison_operators' => ['=','!=','>','>=','<','<=', 'contains'],
				],
			]
		);

		$repeater->add_control(
			'pafe_conditional_logic_form_and_or_operators',
			[
				'label' => __( 'OR, AND Operators', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'options' => [
					'or' => __( 'OR', 'pafe' ),
					'and' => __( 'AND', 'pafe' ),
				],
				'default' => 'or',
			]
		);

		$this->add_control(
			'pafe_conditional_logic_form_list',
			array(
				'type'    => Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '{{{ pafe_conditional_logic_form_if }}} {{{ pafe_conditional_logic_form_comparison_operators }}} {{{ pafe_conditional_logic_form_value }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_progress_bar_style',
			[
				'label' => __( 'Progress Bar', 'pafe' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'progress_bar_show',
            [
                'label' => __( 'Show Progress Bar', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'elementor' ),
                'label_off' => __( 'Hide', 'elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'typography_step_number',
				'label' => 'Step Number',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .pafe-multi-step-form__progressbar-item-step',
                'condition' => [
                    'progress_bar_show' => 'yes',
                ],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'typography_step_title',
				'label' => 'Step Title',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .pafe-multi-step-form__progressbar-item-title',
                'condition'   => [
                    'progress_bar_show' => 'yes',
                ],
			]
		);

		$this->add_control(
			'progress_bar_step_title_hide_desktop',
			[
				'label' => __( 'Hide Step Title On Desktop', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => __( 'Hide', 'elementor' ),
				'label_off' => __( 'Show', 'elementor' ),
				'return_value' => 'elementor-hidden-desktop',
                'condition'   => [
                    'progress_bar_show' => 'yes',
                ],
			]
		);

		$this->add_control(
			'progress_bar_step_title_hide_tablet',
			[
				'label' => __( 'Hide Step Title On Tablet', 'elementor' ),
				'type' =>\Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => __( 'Hide', 'elementor' ),
				'label_off' => __( 'Show', 'elementor' ),
				'return_value' => 'elementor-hidden-tablet',
                'condition'   => [
                    'progress_bar_show' => 'yes',
                ],
			]
		);

		$this->add_control(
			'progress_bar_step_title_hide_mobile',
			[
				'label' => __( 'Hide Step Title On Mobile', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => __( 'Hide', 'elementor' ),
				'label_off' => __( 'Show', 'elementor' ),
				'return_value' => 'elementor-hidden-phone',
                'condition'   => [
                    'progress_bar_show' => 'yes',
                ],
			]
		);

		$this->add_responsive_control(
			'progress_bar_step_width',
			[
				'label' => __( 'Step Number Width', 'pafe' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .pafe-multi-step-form__progressbar-item-step' => 'width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
                'condition'   => [
                    'progress_bar_show' => 'yes',
                ],
			]
		);

		$this->add_control(
			'progress_bar_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pafe-multi-step-form__progressbar-item-step' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition'   => [
                    'progress_bar_show' => 'yes',
                ],
			]
		);

		$this->start_controls_tabs( 'tabs_progress_bar_style' );

		$this->start_controls_tab(
			'tab_progress_bar_normal',
			[
				'label' => __( 'Normal', 'elementor' ),
                'condition'   => [
                    'progress_bar_show' => 'yes',
                ],
			]
		);

		$this->add_control(
			'progress_bar_step_number_color',
			[
				'label' => __( 'Step Number Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pafe-multi-step-form__progressbar-item-step' => 'color: {{VALUE}};',
				],
                'condition'   => [
                    'progress_bar_show' => 'yes',
                ],
			]
		);

		$this->add_control(
			'progress_bar_step_number_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ececec',
				'selectors' => [
					'{{WRAPPER}} .pafe-multi-step-form__progressbar-item-step' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .pafe-multi-step-form__progressbar-item-step-number::after' => 'background-color: {{VALUE}};',
				],
                'condition'   => [
                    'progress_bar_show' => 'yes',
                ],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_progress_bar_active',
			[
				'label' => __( 'Active', 'pafe' ),
                'condition'   => [
                    'progress_bar_show' => 'yes',
                ],
			]
		);

		$this->add_control(
			'progress_bar_step_number_color_active',
			[
				'label' => __( 'Step Number Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .active .pafe-multi-step-form__progressbar-item-step' => 'color: {{VALUE}};',
				],
                'condition'   => [
                    'progress_bar_show' => 'yes',
                ],
			]
		);

		$this->add_control(
			'progress_bar_step_number_background_color_active',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#27AE60',
				'selectors' => [
					'{{WRAPPER}} .active .pafe-multi-step-form__progressbar-item-step' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .pafe-multi-step-form__progressbar-item.active .pafe-multi-step-form__progressbar-item-step-number::after' => 'background-color: {{VALUE}};',
				],
                'condition'   => [
                    'progress_bar_show' => 'yes',
                ],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Button', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
			]
		);

		$this->add_responsive_control(
			'multistep_justify_content',
			[
				'label' => __( 'Justify Content', 'pafe' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'space-between' => [
						'title' => __( 'Space Between', 'pafe' ),
						'icon' => 'eicon-text-align-left',
					],
					'space-evenly' => [
						'title' => __( 'Space Evenly', 'pafe' ),
						'icon' => 'eicon-text-align-center',
					],
					'space-around' => [
						'title' => __( 'Space Around', 'pafe' ),
						'icon' => 'eicon-text-align-right',
					],

				],
				'selectors' => [
					'{{WRAPPER}} .pafe-multi-step-form__content-item .pafe-multi-step-form__content-item-buttons ' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'elementor' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .elementor-button',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .elementor-button',
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_messages_style',
			[
				'label' => __( 'Messages', 'elementor-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'message_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .elementor-message',
			]
		);

		$this->add_control(
			'success_message_color',
			[
				'label' => __( 'Success Message Color', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-message.elementor-message-success' => 'color: {{COLOR}};',
				],
			]
		);

		$this->add_control(
			'error_message_color',
			[
				'label' => __( 'Error Message Color', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-message.elementor-message-danger' => 'color: {{COLOR}};',
				],
			]
		);

		$this->add_control(
			'inline_message_color',
			[
				'label' => __( 'Inline Message Color', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-message.elementor-help-inline' => 'color: {{COLOR}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public function create_popup_url($id,$action) {
    	if($action == 'open' || $action == 'toggle') {
    		if ( version_compare( ELEMENTOR_PRO_VERSION, '2.9.0', '<' ) ) {
				$link_action_url = \ElementorPro\Modules\LinkActions\Module::create_action_url( 'popup:open', [
					'id' => $id,
					'toggle' => 'toggle' === $action,
				] );
			} else {
				$link_action_url = \Elementor\Plugin::instance()->frontend->create_action_hash( 'popup:open', [
					'id' => $id,
					'toggle' => 'toggle' === $action,
				] );
			}
    	} else {
    		if ( version_compare( ELEMENTOR_PRO_VERSION, '2.9.0', '<' ) ) {
				$link_action_url = \ElementorPro\Modules\LinkActions\Module::create_action_url( 'popup:close' );
			} else {
				$link_action_url = \Elementor\Plugin::instance()->frontend->create_action_hash( 'popup:close' );
			}
    	}
    	
		return $link_action_url;
    }

	protected function get_client_ip() {
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( array_key_exists( 'pafe_multi_step_form_list',$settings ) ) {
			$list = $settings['pafe_multi_step_form_list'];	
			if( !empty($list[0]['pafe_multi_step_form_item_shortcode']) ) {
				$index = 0;

				$this->add_render_attribute( 'button', 'class', 'elementor-button' );
				$this->add_render_attribute( 'button', 'class', 'pafe-form-builder-button' );
				$this->add_render_attribute( 'button', 'role', 'button' );
				$this->add_render_attribute( 'button', 'data-pafe-form-builder-required-text', $settings['required_field_message'] );

				if ( ! empty( $settings['button_css_id'] ) ) {
					$this->add_render_attribute( 'button', 'id', $settings['button_css_id'] );
				}

				if ( ! empty( $settings['size'] ) ) {
					$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['size'] );
				}

				if ( ! empty( $settings['hover_animation'] ) ) {
					$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['hover_animation'] );
				}

				if ( ! empty( $settings['form_id'] ) ) {
					$submit_keyboard = !empty($settings['enter_submit_form']) ? 'true' : 'false';
					$submit_hide = !empty($settings['hide_button_after_submitting']) ? 'true' : 'false';
					$this->add_render_attribute( 'button', 'data-pafe-form-builder-nav-form-id', $settings['form_id'] );
					$this->add_render_attribute( 'button-submit', 'data-pafe-form-builder-submit-form-id', $settings['form_id'] );
					$this->add_render_attribute( 'button-submit', 'data-pafe-submit-keyboard', $submit_keyboard );
					$this->add_render_attribute( 'button-submit', 'data-pafe-submit-hide', $submit_hide );
				}

				if ( !empty(get_option('piotnet-addons-for-elementor-pro-recaptcha-site-key')) && !empty(get_option('piotnet-addons-for-elementor-pro-recaptcha-secret-key')) && !empty($settings['pafe_recaptcha_enable']) ) {
					$this->add_render_attribute( 'button-submit', 'data-pafe-form-builder-submit-recaptcha', esc_attr( get_option('piotnet-addons-for-elementor-pro-recaptcha-site-key') ) );
				}

				if(!empty($settings['mollie_enable'])){
					$this->add_render_attribute('button', [
						'data-pafe-form-builder-mollie-payment' => $settings['form_id']
					]);
				}

				if( !empty($settings['paypal_enable']) && isset($settings['form_id'])) {
					$this->add_render_attribute( 'button-submit', [
						'data-pafe-form-builder-paypal-submit' => '',
						'data-pafe-form-builder-paypal-submit-enable' => '',
					] );
				}

				if( !empty($settings['pafe_stripe_enable']) ) {

					$this->add_render_attribute( 'button', [
						'data-pafe-form-builder-stripe-submit' => '',
					] );

					if( !empty($settings['pafe_stripe_amount']) ) {
						$this->add_render_attribute( 'button', [
							'data-pafe-form-builder-stripe-amount' => $settings['pafe_stripe_amount'],
						] );
					}

					if( !empty($settings['pafe_stripe_currency']) ) {
						$this->add_render_attribute( 'button', [
							'data-pafe-form-builder-stripe-currency' => $settings['pafe_stripe_currency'],
						] );
					}

					if( !empty($settings['pafe_stripe_amount_field_enable']) && !empty($settings['pafe_stripe_amount_field']) ) {
						$this->add_render_attribute( 'button', [
							'data-pafe-form-builder-stripe-amount-field' => $settings['pafe_stripe_amount_field'],
						] );
					}

					if( !empty($settings['pafe_stripe_customer_info_field']) ) {
						$this->add_render_attribute( 'button', [
							'data-pafe-form-builder-stripe-customer-info-field' => $settings['pafe_stripe_customer_info_field'],
						] );
					}
				}

				if( !empty($settings['woocommerce_add_to_cart_product_id']) ) {

					$this->add_render_attribute( 'button', [
						'data-pafe-form-builder-woocommerce-product-id' => $settings['woocommerce_add_to_cart_product_id'],
					] );
				}
				
				if( !empty($_GET['edit']) ) {
					$post_id = intval($_GET['edit']);
					if( is_user_logged_in() && get_post($post_id) != null ) {
						if (current_user_can( 'edit_others_posts' ) || get_current_user_id() == get_post($post_id)->post_author) {
							$sp_post_id = get_post_meta($post_id,'_submit_post_id',true);
							$form_id = get_post_meta($post_id,'_submit_button_id',true);

							if (!empty($_GET['smpid'])) {
								$sp_post_id = sanitize_text_field($_GET['smpid']);
							}

							if (!empty($_GET['sm'])) {
								$form_id = sanitize_text_field($_GET['sm']);
							}

							$elementor = \Elementor\Plugin::$instance;

							if ( version_compare( ELEMENTOR_VERSION, '2.6.0', '>=' ) ) {
								$meta = $elementor->documents->get( $sp_post_id )->get_elements_data();
							} else {
								$meta = $elementor->db->get_plain_editor( $sp_post_id );
							}

							$form = find_element_recursive( $meta, $form_id );

							if ( !empty($form)) {
								$this->add_render_attribute( 'button', [
									'data-pafe-form-builder-submit-post-edit' => intval($post_id),
								] );
                                $submit_post_id = $post_id;

                                if (isset($form['settings']['submit_post_custom_fields_list'])) {

                                    $sp_custom_fields = $form['settings']['submit_post_custom_fields_list'];

                                    if (is_array($sp_custom_fields)) {
                                        foreach ($sp_custom_fields as $sp_custom_field) {
                                            if ( !empty( $sp_custom_field['submit_post_custom_field'] ) ) {
                                                $custom_field_value = '';
                                                $meta_type = $sp_custom_field['submit_post_custom_field_type'];

                                                if ($meta_type == 'repeater' && function_exists('update_field') && $form['settings']['submit_post_custom_field_source'] == 'acf_field') {
                                                    $custom_field_value = get_field($sp_custom_field['submit_post_custom_field'], $submit_post_id);
                                                    if (!empty($custom_field_value)) {
                                                        array_walk($custom_field_value, function (& $item, $custom_field_value_key, $submit_post_id_value ) {
                                                            foreach ($item as $key => $value) {
                                                                $field_object = get_field_object($this->acf_get_field_key( $key, $submit_post_id_value ));
                                                                if (!empty($field_object)) {
                                                                    $field_type = $field_object['type'];
                                                                    $item_value = $value;

                                                                    if ($field_type == 'repeater') {
                                                                        foreach ($item_value as $item_value_key => $item_value_element) {
                                                                            foreach ($field_object['sub_fields'] as $item_sub_field) {
                                                                                foreach ($item_value_element as $item_value_element_key => $item_value_element_value) {
                                                                                    if ($item_sub_field['name'] == $item_value_element_key) {
                                                                                        if ($item_sub_field['type'] == 'image') {
                                                                                            if (!empty($item_value_element_value['url'])) {
                                                                                                $item_value[$item_value_key][$item_value_element_key] = $item_value_element_value['url'];
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }

                                                                    if ($field_type == 'image') {
                                                                        if (!empty($item_value['url'])) {
                                                                            $item_value = $item_value['url'];
                                                                        }
                                                                    }

                                                                    if ($field_type == 'gallery') {
                                                                        if (is_array($item_value)) {
                                                                            $images = '';
                                                                            foreach ($item_value as $itemx) {
                                                                                if (is_array($itemx)) {
                                                                                    $images .= $itemx['url'] . ',';
                                                                                }
                                                                            }
                                                                            $item_value = rtrim($images, ',');
                                                                        }
                                                                    }

                                                                    if ($field_type == 'select' || $field_type == 'checkbox') {
                                                                        if (is_array($item_value)) {
                                                                            $value_string = '';
                                                                            foreach ($item_value as $itemx) {
                                                                                $value_string .= $itemx . ',';
                                                                            }
                                                                            $item_value = rtrim($value_string, ',');
                                                                        }
                                                                    }

                                                                    if ($field_type == 'date_picker') {
                                                                        $time = strtotime( $item_value );
                                                                        $item_value = date(get_option( 'date_format' ),$time);
                                                                    }

                                                                    $item[$key] = $item_value;
                                                                }
                                                            }
                                                        }, $_GET['edit']);

                                                        ?>
                                                        <div data-pafe-form-builder-repeater-value data-pafe-form-builder-repeater-value-id="<?php echo $sp_custom_field['submit_post_custom_field']; ?>" data-pafe-form-builder-repeater-value-form-id="<?php echo $settings['form_id']; ?>" style="display: none;">
                                                            <?php echo json_encode($custom_field_value); ?>
                                                        </div>
                                                        <?php
                                                    }
                                                }

                                                if ($meta_type == 'jet_engine_repeater' && $form['settings']['submit_post_custom_field_source'] == 'jet_engine_field') {
                                                    $custom_field_value = get_post_meta($submit_post_id, $sp_custom_field['submit_post_custom_field'], true);
                                                    if (!empty($custom_field_value)) {
                                                        foreach ($custom_field_value as $item_key => $custom_field_item) {
                                                            foreach ($custom_field_item as $key => $value) {
                                                                $field_object = $this->jetengine_repeater_get_field_object( $key, $sp_custom_field['submit_post_custom_field'] );
                                                                if (!empty($field_object)) {
                                                                    $field_type = $field_object['type'];
                                                                    $item_value = $value;

                                                                    if ($field_type == 'media') {
                                                                        $image = get_the_guid($value);
                                                                        if (!empty($image)) {
                                                                            $item_value = $image;
                                                                        }
                                                                    }

                                                                    if ($field_type == 'gallery') {
                                                                        $images_array = explode(',', $item_value);
                                                                        if (is_array($images_array)) {
                                                                            $images = '';
                                                                            foreach ($images_array as $images_item) {
                                                                                if (!empty($images_item)) {
                                                                                    $images .= get_the_guid($images_item) . ',';
                                                                                }
                                                                            }
                                                                            if (!empty($images)) {
                                                                                $item_value = rtrim($images, ',');
                                                                            }
                                                                        }
                                                                    }

                                                                    if ($field_type == 'checkbox') {
                                                                        if (is_array($item_value)) {
                                                                            $value_string = '';
                                                                            foreach ($item_value as $itemx => $itemx_value) {
                                                                                if ($itemx_value == 'true') {
                                                                                    $value_string .= $itemx . ',';
                                                                                }
                                                                            }
                                                                            $item_value = rtrim($value_string, ',');
                                                                        }
                                                                    }

                                                                    if ($field_type == 'date') {
                                                                        $time = strtotime( $item_value );
                                                                        if (empty($item_value)) {
                                                                            $item_value = '';
                                                                        } else {
                                                                            $item_value = date('Y-m-d',$time);
                                                                        }
                                                                    }

                                                                    if ($field_type == 'time') {
                                                                        $time = strtotime( $item_value );
                                                                        $item_value = date('H:i',$time);
                                                                    }

                                                                    $custom_field_item[$key] = $item_value;
                                                                }
                                                            }

                                                            if ( is_string($item_key) ) {
                                                                unset($custom_field_value[$item_key]);
                                                                $custom_field_value[] = $custom_field_item;
                                                            } else { $custom_field_value[$item_key] = $custom_field_item; }
                                                        }

                                                        ?>
                                                        <div data-pafe-form-builder-repeater-value data-pafe-form-builder-repeater-value-id="<?php echo $sp_custom_field['submit_post_custom_field']; ?>" data-pafe-form-builder-repeater-value-form-id="<?php echo $settings['form_id']; ?>" style="display: none;">
                                                            <?php echo json_encode($custom_field_value); ?>
                                                        </div>
                                                        <?php
                                                    }
                                                }

                                                if ($meta_type == 'meta_box_group' && function_exists('rwmb_get_value') && $form['settings']['submit_post_custom_field_source'] == 'metabox_field') {
                                                    $custom_field_value = rwmb_get_value($sp_custom_field['submit_post_custom_field'], array(), $submit_post_id );

                                                    $custom_field_group_id = $sp_custom_field['submit_post_custom_field_group_id'];
                                                    $agrs = array(
                                                        'name' => $custom_field_group_id,
                                                        'post_type' => 'meta-box',
                                                    );

                                                    $custom_field_post_id = get_posts($agrs)[0]->ID;
                                                    $custom_field_objects = get_post_meta($custom_field_post_id, 'meta_box');

                                                    if (!empty($custom_field_value)) {
                                                        array_walk($custom_field_value, function (& $item, $custom_field_value_key, $custom_field_object_value) {
                                                            foreach ($item as $key => $value) {
                                                                $field_object = $this->metabox_group_get_field_object( $key, $custom_field_object_value );
                                                                if (!empty($field_object)) {
                                                                    $field_type = $field_object['type'];
                                                                    $item_value = $value;

                                                                    if ( ($field_type == 'group') && ($field_object['clone']) ) {
                                                                        foreach ($item_value as $item_value_key => $item_value_element ) {
                                                                            foreach ($field_object['fields'] as $fields_items) {
                                                                                foreach ($item_value_element as $item_value_element_key => $item_value_element_value) {
                                                                                    if ( $fields_items['id'] == $item_value_element_key ) {
                                                                                        if ($fields_items['type'] == 'single_image') {
                                                                                            $image = wp_get_attachment_url($item_value_element_value);
                                                                                            if ( !empty( $image ) ) {
                                                                                                $item_value[$item_value_key][$item_value_element_key] = $image;
                                                                                            }
                                                                                        }

                                                                                        if ( $fields_items['type'] == 'image' ) {
                                                                                            if ( is_array( $item_value_element_value ) ) {
                                                                                                $images = '';
                                                                                                foreach ( $item_value_element_value as $image_item ) {
                                                                                                    $image = wp_get_attachment_url($image_item);
                                                                                                    if ( !empty( $image ) ) {
                                                                                                        $images .= $image . ',';
                                                                                                    }
                                                                                                }
                                                                                                $item_value[$item_value_key][$item_value_element_key] = rtrim( $images, ',' );
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }

                                                                    if ( $field_type == 'single_image' ) {
                                                                        $image = wp_get_attachment_url($value);
                                                                        if ( !empty( $image ) ) {
                                                                            $item_value = $image;
                                                                        }
                                                                    }

                                                                    if ( $field_type == 'image' ) {
                                                                        if ( is_array( $item_value ) ) {
                                                                            $images = '';
                                                                            foreach ( $item_value as $image_item ) {
                                                                                $image = wp_get_attachment_url($image_item);
                                                                                if ( !empty( $image ) ) {
                                                                                    $images .= $image . ',';
                                                                                }
                                                                            }
                                                                            $item_value = rtrim( $images, ',' );
                                                                        }
                                                                    }

                                                                    if ($field_type == 'select' || $field_type == 'checkbox') {
                                                                        if (is_array($item_value)) {
                                                                            $value_string = '';
                                                                            foreach ($item_value as $itemx) {
                                                                                $value_string .= $itemx . ',';
                                                                            }
                                                                            $item_value = rtrim($value_string, ',');
                                                                        }
                                                                    }

                                                                    if ($field_type == 'date') {
                                                                        $time = strtotime( $item_value );
                                                                        if (empty($item_value)) {
                                                                            $item_value = '';
                                                                        } else {
                                                                            $item_value = date(get_option( 'date_format' ),$time);
                                                                        }
                                                                    }

                                                                    if ($field_type == 'time') {
                                                                        $time = strtotime( $item_value );
                                                                        $item_value = date('H:i',$time);
                                                                    }
                                                                    $item[$key] = $item_value;
                                                                }
                                                            }
                                                        }, $custom_field_objects);
                                                        ?>
                                                        <div data-pafe-form-builder-repeater-value data-pafe-form-builder-repeater-value-id="<?php echo $sp_custom_field['submit_post_custom_field']; ?>" data-pafe-form-builder-repeater-value-form-id="<?php echo $settings['form_id']; ?>" style="display: none;">
                                                            <?php echo json_encode($custom_field_value); ?>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
							}
						}
					}
				}

				$list_conditional = $settings['pafe_conditional_logic_form_list'];	
				if( !empty($settings['pafe_conditional_logic_form_enable']) && !empty($list_conditional[0]['pafe_conditional_logic_form_if']) && !empty($list_conditional[0]['pafe_conditional_logic_form_comparison_operators']) ) {
					$this->add_render_attribute( 'button-submit', [
						'data-pafe-form-builder-conditional-logic' => str_replace('\"]','', str_replace('[field id=\"','', json_encode($list_conditional))),
						'data-pafe-form-builder-conditional-logic-speed' => $settings['pafe_conditional_logic_form_speed'],
						'data-pafe-form-builder-conditional-logic-easing' => $settings['pafe_conditional_logic_form_easing'],
						'data-pafe-form-builder-conditional-logic-not-field' => '',
						'data-pafe-form-builder-conditional-logic-not-field-form-id' => $settings['form_id'],
					] );
				}

				if( !empty($settings['pafe_multi_step_form_scroll_to_top'] ) ) {
					$this->add_render_attribute( 'button-submit', [
						'data-pafe-multi-step-form-scroll-to-top' => '',
						'data-pafe-multi-step-form-scroll-to-top-offset-desktop' => $settings['pafe_multi_step_form_scroll_to_top_offset_desktop'],
						'data-pafe-multi-step-form-scroll-to-top-offset-tablet' => $settings['pafe_multi_step_form_scroll_to_top_offset_tablet'],
						'data-pafe-multi-step-form-scroll-to-top-offset-mobile' => $settings['pafe_multi_step_form_scroll_to_top_offset_mobile'],
					] );
				}
		?>
			<div class="pafe-multi-step-form"<?php if( !empty($settings['pafe_multi_step_form_scroll_to_top'] ) ) : ?> data-pafe-multi-step-form-scroll-to-top data-pafe-multi-step-form-scroll-to-top-offset-desktop="<?php echo $settings['pafe_multi_step_form_scroll_to_top_offset_desktop']; ?>" data-pafe-multi-step-form-scroll-to-top-offset-tablet="<?php echo $settings['pafe_multi_step_form_scroll_to_top_offset_tablet']; ?>" data-pafe-multi-step-form-scroll-to-top-offset-mobile="<?php echo $settings['pafe_multi_step_form_scroll_to_top_offset_mobile']; ?>"<?php endif; ?>>
				<div class="pafe-multi-step-form__progressbar <?php if ( $settings['progress_bar_show'] != 'yes') { echo ('pafe-progressbar-hidden'); }?>">
					<?php foreach ($list as $item) : $index++; ?>
						<div class="pafe-multi-step-form__progressbar-item<?php if($index == 1) : ?> active<?php endif; ?>">
							<div class="pafe-multi-step-form__progressbar-item-step-number">
								<div class="pafe-multi-step-form__progressbar-item-step"><?php echo $index; ?></div>
							</div>
							<div class="pafe-multi-step-form__progressbar-item-title<?php echo ' ' . $settings['progress_bar_step_title_hide_desktop'] . ' ' . $settings['progress_bar_step_title_hide_tablet'] . ' ' . $settings['progress_bar_step_title_hide_mobile'] ; ?>"><?php echo $item['pafe_multi_step_form_item_title']; ?></div>
						</div>
					<?php endforeach; ?>
				</div>
				<?php $index = 0; ?>
				<div class="pafe-multi-step-form__content">
				<?php if(is_admin() && $settings['pdfgenerator_import_template'] == 'yes' && !empty($settings['pdfgenerator_template_url'])){ ?>
					<script src="<?php echo plugin_dir_url( __FILE__ ).'../assets/js/minify/pdf.min.js' ?>"></script>
				<?php } ?>
					<?php foreach ($list as $item) : $index++; ?>
						<div class="pafe-multi-step-form__content-item<?php if($index == 1) : ?> active<?php endif; ?>" data-pafe-form-builder-step-item-id="<?php echo abs((int) filter_var($item['pafe_multi_step_form_item_shortcode'], FILTER_SANITIZE_NUMBER_INT)); ?>">
							<div class="pafe-multi-step-form__content-item-shortcode">
								<?php echo do_shortcode( $item['pafe_multi_step_form_item_shortcode'] ) ?>
							</div>
							<div class="pafe-multi-step-form__content-item-buttons">
								<?php if ($index != 1 && empty( $item['pafe_multi_step_form_item_disable_button_prev'] )) : ?>
									<div class="pafe-multi-step-form__content-item-button">
										<button <?php echo $this->get_render_attribute_string( 'button' ); ?> data-pafe-form-builder-nav="prev">
											<span class="elementor-button-content-wrapper">
												<span class="elementor-button-text"><?php echo $settings['button_prev']; ?></span>
											</span>
										</button>
									</div>
								<?php endif; ?>
								<?php if ($index != count($list) && empty( $item['pafe_multi_step_form_item_disable_button_next'] )) : ?>
									<div class="pafe-multi-step-form__content-item-button">
										<button <?php echo $this->get_render_attribute_string( 'button' ); ?> data-pafe-form-builder-nav="next">
											<span class="elementor-button-content-wrapper">
												<span class="elementor-button-text"><?php echo $settings['button_next']; ?></span>
											</span>
										</button>
									</div>
								<?php endif; ?>
								<?php if ($index == count($list) && empty( $item['pafe_multi_step_form_item_disable_button_next'] )) : ?>
									<input type="hidden" name="post_id" value="<?php echo get_the_ID(); ?>" data-pafe-form-builder-hidden-form-id="<?php if ( $settings['form_id'] ) {echo $settings['form_id'];} ?>"/>
									<input type="hidden" name="form_id" value="<?php echo $this->get_id(); ?>" data-pafe-form-builder-hidden-form-id="<?php if ( $settings['form_id'] ) {echo $settings['form_id'];} ?>"/>
									<input type="hidden" name="remote_ip" value="<?php echo $this->get_client_ip(); ?>" data-pafe-form-builder-hidden-form-id="<?php if ( $settings['form_id'] ) {echo $settings['form_id'];} ?>"/>

									<?php if(in_array('redirect', $settings['submit_actions'])) : ?>
										<input type="hidden" name="redirect" value="<?php echo $settings['redirect_to']; ?>" data-pafe-form-builder-hidden-form-id="<?php if ( $settings['form_id'] ) {echo $settings['form_id'];} ?>" data-pafe-form-builder-open-new-tab="<?php echo $settings['redirect_open_new_tab']; ?>"/>
									<?php endif; ?>

									<?php if(in_array('popup', $settings['submit_actions'])) : ?>
										<?php if(!empty( $settings['popup_action'] ) && !empty( $settings['popup_action_popup_id'] )) : ?>
											<a href="<?php echo $this->create_popup_url($settings['popup_action_popup_id'],$settings['popup_action']); ?>" data-pafe-form-builder-popup data-pafe-form-builder-hidden-form-id="<?php if ( $settings['form_id'] ) {echo $settings['form_id'];} ?>" style="display: none;"></a>
										<?php endif; ?>
									<?php endif; ?>

									<?php if(in_array('open_popup', $settings['submit_actions'])) : ?>
										<?php if(!empty( $settings['popup_action_popup_id_open'] )) : ?>
											<a href="<?php echo $this->create_popup_url($settings['popup_action_popup_id_open'],'open'); ?>" data-pafe-form-builder-popup-open data-pafe-form-builder-hidden-form-id="<?php if ( $settings['form_id'] ) {echo $settings['form_id'];} ?>" style="display: none;"></a>
										<?php endif; ?>
									<?php endif; ?>

									<?php if(in_array('close_popup', $settings['submit_actions'])) : ?>
										<?php if(!empty( $settings['popup_action_popup_id_close'] )) : ?>
											<a href="<?php echo $this->create_popup_url($settings['popup_action_popup_id_close'],'close'); ?>" data-pafe-form-builder-popup-close data-pafe-form-builder-hidden-form-id="<?php if ( $settings['form_id'] ) {echo $settings['form_id'];} ?>" style="display: none;"></a>
										<?php endif; ?>
									<?php endif; ?>
		
									<div class="pafe-multi-step-form__content-item-button">
										<button <?php echo $this->get_render_attribute_string( 'button' ); ?> <?php echo $this->get_render_attribute_string( 'button-submit' ); ?>>
											<span class="elementor-button-content-wrapper">
												<span class="elementor-button-text"><?php echo $settings['button_submit']; ?></span>
											</span>
										</button>
									</div>
								<?php endif; ?>
								<?php if ($index == count($list)) : ?>
									<?php if( !empty($settings['paypal_enable']) && isset($settings['form_id'])) : ?>
										<?php
											$paypal_button_class = is_admin() ? ' pafe-paypal-admin' : '';
										?>
										<div class="pafe-form-builder-paypal">
											<!-- Set up a container element for the button -->
										    <div class="pafe-paypal-button<?php echo $paypal_button_class; ?>" id="pafe-paypal-button-container-<?php echo $settings['form_id']; ?>"></div>
									    </div>

									    <!-- Include the PayPal JavaScript SDK -->
			    						<script src="https://www.paypal.com/sdk/js?client-id=<?php echo esc_attr( get_option('piotnet-addons-for-elementor-pro-paypal-client-id') ); ?>&currency=<?php echo $settings['paypal_currency']; ?><?php if(!empty($settings['paypal_locale'])) : ?>&locale=<?php echo $settings['paypal_locale']; ?><?php endif; ?>"></script>

									    <script>
									    	function getFieldValue(fieldId) {
									    		var fieldName = 'form_fields[' + fieldId + ']',
									    			$field = jQuery(document).find('[name="' + fieldName + '"]'),
									    			fieldType = $field.attr('type'),
													formID = $field.attr('data-pafe-form-builder-form-id');

												if (fieldType == 'radio' || fieldType == 'checkbox') {
													var fieldValue = $field.closest('.elementor-element').find('input:checked').val();
										        } else {
										        	var fieldValue = $field.val();
										        }

										        if (fieldValue == '') {
										        	var fieldValue = 0;
										        }

										        return fieldValue;
									    	}

									    	function pafeValidateForm<?php echo $settings['form_id']; ?>() {
									    		var formID = '<?php echo $settings['form_id']; ?>',
									    			$ = jQuery,
										    		$fields = $(document).find('[data-pafe-form-builder-form-id='+ formID +']'),
										    		$submit = $(document).find('[data-pafe-form-builder-submit-form-id='+ formID +']'),
										    		requiredText = $submit.data('pafe-form-builder-required-text'),
										    		error = 0;

												var $parent = $submit.closest('.elementor-element');

												$fields.each(function(){
													if ( $(this).data('pafe-form-builder-stripe') == undefined && $(this).data('pafe-form-builder-html') == undefined ) {
														var $checkboxRequired = $(this).closest('.elementor-field-type-checkbox.elementor-field-required');
														var checked = 0;
														if ($checkboxRequired.length > 0) {
															checked = $checkboxRequired.find("input[type=checkbox]:checked").length;
														} 

														if ($(this).attr('oninvalid') != undefined) {
															requiredText = $(this).attr('oninvalid').replace("this.setCustomValidity('","").replace("')","");
														}

                                                        var isValid = $(this)[0].checkValidity();
                                                        var next_ele = $($(this)[0]).next()[0];
                                                        if ($(next_ele).hasClass('flatpickr-mobile')) {
                                                            isValid = next_ele.checkValidity();
                                                        }

														if ( !isValid && $(this).closest('.elementor-widget').css('display') != 'none' && $(this).closest('[data-pafe-form-builder-conditional-logic]').css('display') != 'none' && $(this).data('pafe-form-builder-honeypot') == undefined &&  $(this).closest('[data-pafe-signature]').length == 0 || checked == 0 && $checkboxRequired.length > 0 && $(this).closest('.elementor-element').css('display') != 'none') {
															if ($(this).css('display') == 'none' || $(this).closest('div').css('display') == 'none' || $(this).data('pafe-form-builder-image-select') != undefined || $checkboxRequired.length > 0) {
																$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html(requiredText);
																
															} else {
																if ($(this).data('pafe-form-builder-image-select') == undefined) {
																	$(this)[0].reportValidity();
																} 
															}

															error++;
														} else {

															$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html('');

															if ($(this).closest('[data-pafe-signature]').length > 0) {
																var $pafeSingature = $(this).closest('[data-pafe-signature]'),
																	$exportButton = $pafeSingature.find('[data-pafe-signature-export]');

																$exportButton.trigger('click');

																if ($(this).val() == '' && $(this).closest('.elementor-widget').css('display') != 'none' && $(this).attr('required') != undefined) {
																	$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html(requiredText);
																	error++;
																} 
															}
														}
													}
												});

												if (error == 0) {
													return true;
												} else {
													return false;
												}
									    	}
											var isFirefox = typeof InstallTrigger !== 'undefined';
									    	// fix alert ]
									        // Render the PayPal button into #paypal-button-container
									        paypal.Buttons({


								                onClick :  function(data, actions){
								                    if(!pafeValidateForm<?php echo $settings['form_id']; ?>()){
														if(isFirefox){
															setTimeout(() => {
																pafeValidateForm<?php echo $settings['form_id']; ?>()
															}, 300)
														}
								                        return false;
								                    }else {
								                        return true;
								                    }
								                },

									            // Set up the transaction
									            createOrder: function(data, actions) {
									                return actions.order.create({
									                    purchase_units: [{
									                        amount: {
									                        	<?php if (strpos($settings['paypal_amount'], 'field id="') !== false) : ?>
										                            value: getFieldValue('<?php echo str_replace('[field id="', '', str_replace('"]', '', $settings['paypal_amount'])); ?>'),
									                            <?php else : ?>
									                            	value: '<?php echo $settings['paypal_amount']; ?>',
										                        <?php endif; ?>
									                        },
									                        <?php if (strpos($settings['paypal_description'], '[field id="') !== false) : ?>
									                            description: getFieldValue('<?php echo str_replace('[field id="', '', str_replace('"]', '', $settings['paypal_description'])); ?>'),
								                            <?php else : ?>
								                            	description: '<?php echo $settings['paypal_description']; ?>',
									                        <?php endif; ?>
									                    }]
									                });
									            },

									            // Finalize the transaction
									            onApprove: function(data, actions) {
									                return actions.order.capture().then(function(details) {
									                    // Show a success message to the buyer
									                    // alert('Transaction completed by ' + details.payer.name.given_name + '!');
									                    var $submit = jQuery(document).find('[data-pafe-form-builder-submit-form-id="<?php echo $settings['form_id']; ?>"]');
									                    $submit.attr('data-pafe-form-builder-paypal-submit-transaction-id', details.id);
									                    $submit.trigger('click');
									                });
									            }


									        }).render('#pafe-paypal-button-container-<?php echo $settings['form_id']; ?>');
									    </script>
								    <?php endif; ?>
								<?php endif; ?>
							</div>

							<?php if(in_array('submit_post', $settings['submit_actions'])) : ?>
								<?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()) :
									echo '<div style="margin-top: 20px;">' . __('Edit Post URL Shortcode','pafe') . '</div><input class="elementor-form-field-shortcode" style="min-width: 300px; padding: 10px;" value="[edit_post edit_text='. "'Edit Post'" . ' sm=' . "'" . $this->get_id() . "'" . ' smpid=' . "'" . get_the_ID() . "'" .']' . get_the_permalink() . '[/edit_post]" readonly /><div class="elementor-control-field-description">' . __( 'Add this shortcode to your single template.', 'pafe' ) . ' The shortcode will be changed if you edit this form so you have to refresh Elementor Editor Page and then copy the shortcode. ' . __( 'Replace', 'pafe' ) . ' "' . get_the_permalink() . '" ' . __( 'by your Page URL contains your Submit Post Form.', 'pafe' ) . '</div>';
                                    echo '<div style="margin-top: 20px;">' . __('Delete Post URL Shortcode','pafe') . '</div><input class="elementor-form-field-shortcode" style="min-width: 300px; padding: 10px;" value="[delete_post force_delete='. "'0'". ' delete_text='. "'Delete Post'" . ' sm=' . "'" . $this->get_id() . "'" . ' smpid=' . "'" . get_the_ID() . "'" . ' redirect='."'http://YOUR-DOMAIN'".']'.'[/delete_post]" readonly /><div class="elementor-control-field-description">' . __( 'Add this shortcode to your single template.', 'pafe' ) . ' The shortcode will be changed if you edit this form so you have to refresh Elementor Editor Page and then copy the shortcode. ' . __( 'Replace', 'pafe' ) . ' "http://YOUR-DOMAIN" ' . __( 'by your Page URL', 'pafe' ) . '</div>';
                                ?>
								<?php endif; ?>
							<?php endif; ?>

							<?php if ($index == count($list)) : ?>

								<?php if( !empty($settings['pafe_stripe_enable']) ) : ?>
									<script src="https://js.stripe.com/v3/"></script>
									<div class="pafe-form-builder-alert pafe-form-builder-alert--stripe">
										<div class="elementor-message elementor-message-success" role="alert"><?php echo $settings['pafe_stripe_message_succeeded']; ?></div>
										<div class="elementor-message elementor-message-danger" role="alert"><?php echo $settings['pafe_stripe_message_failed']; ?></div>
										<div class="elementor-message elementor-help-inline" role="alert"><?php echo $settings['pafe_stripe_message_pending']; ?></div>
									</div>
								<?php endif; ?>
								<?php if ( !empty(get_option('piotnet-addons-for-elementor-pro-recaptcha-site-key')) && !empty(get_option('piotnet-addons-for-elementor-pro-recaptcha-secret-key')) && !empty($settings['pafe_recaptcha_enable']) ) : ?>
									<script src="https://www.google.com/recaptcha/api.js?render=<?php echo esc_attr(get_option('piotnet-addons-for-elementor-pro-recaptcha-site-key')); ?>"></script>
									<?php if (!empty($settings['pafe_recaptcha_hide_badge'])) : ?>
										<style type="text/css">
											.grecaptcha-badge {
												opacity:0 !important;
												visibility: collapse !important;
											}
										</style>
									<?php endif; ?>
								<?php endif; ?>
								<div class="pafe-form-builder-alert pafe-form-builder-alert--mail">
									<div class="elementor-message elementor-message-success" role="alert"><?php echo $settings['success_message']; ?></div>
									<div class="elementor-message elementor-message-danger" role="alert"><?php echo $settings['error_message']; ?></div>
									<!-- <div class="elementor-message elementor-help-inline" role="alert">Server error. Form not sent.</div> -->
								</div>
							<?php endif; ?>
							<div id="pafe-form-builder-trigger-success-<?php if ( $settings['form_id'] ) {echo $settings['form_id'];} ?>" data-pafe-form-builder-trigger-success="<?php if ( $settings['form_id'] ) {echo $settings['form_id'];} ?>" style="display: none"></div>
							<div id="pafe-form-builder-trigger-failed-<?php if ( $settings['form_id'] ) {echo $settings['form_id'];} ?>" data-pafe-form-builder-trigger-failed="<?php if ( $settings['form_id'] ) {echo $settings['form_id'];} ?>" style="display: none"></div>

							<?php if (in_array("pdfgenerator", $settings['submit_actions'])): ?>
							<?php if($settings['pdfgenerator_background_image_enable'] == 'yes'){
								if(isset($settings['pdfgenerator_background_image']['url'])){
									$pdf_generator_image = $settings['pdfgenerator_background_image']['url'];
								}
							} ?>
							<?php if($settings['pdfgenerator_import_template'] == 'yes' && !empty($settings['pdfgenerator_template_url'])): ?>
							<?php if(is_admin()): ?>
							<div class="pafe-button-load-pdf-template" style="text-align:center">
								<button data-pafe-load-pdf-template="<?php echo $settings['pdfgenerator_template_url']; ?>">Load PDF Template</button>
							</div>
							<?php endif; ?>
							<?php endif; ?>
							<div id="pafe-pdf-preview" class="pafe-form-builder-pdf-generator-preview<?php if(empty($settings['pdfgenerator_set_custom'])) { echo ' pafe-form-builder-pdf-generator-preview--not-custom'; } ?> <?php echo $settings['pdfgenerator_size'] ?>" style="border: 1px solid #000; margin: 0 auto; position: relative; <?php if(isset($pdf_generator_image)) {echo "background-image:url('".$pdf_generator_image."'); background-size: contain; background-position: left top; background-repeat: no-repeat;"; } ?>">
							<?php if($settings['pdfgenerator_set_custom'] == 'yes' && $settings['pdfgenerator_import_template'] == 'yes' && !empty($settings['pdfgenerator_template_url'])){ ?>
								<canvas class="pafe-pdf-canvas" id="pafe-pdf-preview-template-<?php echo $index; ?>"></canvas>
							<?php } ?>
							<?php if(!empty($settings['pdfgenerator_title'])): ?>
							<div class="pafe-form-builder-pdf-generator-preview__title" style="margin-top: 20px; margin-left: 20px;"><?php echo $settings['pdfgenerator_title'] ?></div>
							<?php endif; ?>
								<?php if($settings['pdfgenerator_set_custom'] == 'yes'){ ?>
									<?php if(is_admin() && $settings['pdfgenerator_import_template'] == 'yes' && !empty($settings['pdfgenerator_template_url'])){ ?>
										<script type="text/javascript">
											jQuery(document).ready(function($){
												var pdfTemplatePreview = $('[data-pafe-load-pdf-template]').attr('data-pafe-load-pdf-template');
												if(pdfTemplatePreview != ''){
													previewPDFTemplate(pdfTemplatePreview);
												} 
												$(document).on('click', '[data-pafe-load-pdf-template]', function(){
													var pdfTemplate = $(this).attr('data-pafe-load-pdf-template');
													if(pdfTemplate){
														previewPDFTemplate(pdfTemplate);
													}
												});
												function previewPDFTemplate(url){
													var pdfjsLib = window['pdfjs-dist/build/pdf'];

													pdfjsLib.GlobalWorkerOptions.workerSrc = '<?php echo plugin_dir_url( __FILE__ ).'../assets/js/minify/pdf.worker.min.js' ?>';
													var loadingTask = pdfjsLib.getDocument(url);
													loadingTask.promise.then(function(pdf) {
													
													var pageNumber = 1;
													pdf.getPage(pageNumber).then(function(page) {
														
														var scale = 1.32;
														var viewport = page.getViewport({scale: scale});

														var canvas = document.getElementById('pafe-pdf-preview-template-<?php echo $index; ?>');
														var context = canvas.getContext('2d');

														canvas.height = 1122;//viewport.height;
														canvas.width = 793;//viewport.width;

														var renderContext = {
														canvasContext: context,
														viewport: viewport
														};
														var renderTask = page.render(renderContext);
														renderTask.promise.then(function () {
															console.log('Page rendered');
														});
													});
													}, function (reason) {
													// PDF loading error
														console.error(reason);
													});
												}
											});
										</script>
									<?php } ?>
								<?php foreach($settings['pdfgenerator_field_mapping_list'] as $item): ?>
									<?php if($item['pdfgenerator_field_type'] == 'default'){ ?>
									<div class="pafe-form-builder-pdf-generator-preview__item  elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>" style="position: absolute; background: #dedede;line-height: 1;">
										<?php echo $item['pdfgenerator_field_shortcode']; ?>
									</div>
									<?php }elseif($item['pdfgenerator_field_type'] == 'image'){ ?>
										<div class="pafe-form-builder-pdf-generator-preview__item-image  elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
											<img src="<?php echo plugins_url().'/piotnet-addons-for-elementor-pro/assets/images/signature.png'; ?>" style="position: absolute;">
										</div>
									<?php }else{ ?>
									<?php
										$pdf_image_preview_url = !empty($item['pdfgenerator_image_field']['url']) ? $item['pdfgenerator_image_field']['url'] : plugins_url().'/piotnet-addons-for-elementor-pro/assets/images/signature.png';
									?>
									<div class="pafe-form-builder-pdf-generator-preview__item-image  elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
										<img src="<?php echo $pdf_image_preview_url; ?>" style="position: absolute;">
									</div>
								<?php } endforeach; }else{ ?>
								<div class="pafe-form-builder-field-mapping__preview">
									<?php if($settings['pdfgenerator_heading_field_mapping_show_label'] == 'yes'){ 
										echo "Label: Your Field Value";
									}else{
										echo 'Your Field Value';
									} ?>
								</div>
								<?php } ?>
							</div>
							<?php endif; ?>

						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php
			}
		}
	}

	public function mailpoet_get_list(){
		$data = [];
		if (class_exists(\MailPoet\API\API::class)) {
			$mailpoet_api = \MailPoet\API\API::MP('v1');
			$lists = $mailpoet_api->getLists();
			foreach($lists as $item){
				$data[$item['id']] = $item['name'];
			}
		}
		return $data;
	}

	public function add_wpml_support() {
		add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_widgets_to_translate_filter' ] );
	}

	public function wpml_widgets_to_translate_filter( $widgets ) {
		$widgets[ $this->get_name() ] = [
			'conditions' => [ 'widgetType' => $this->get_name() ],
			'fields'     => [
				[
					'field'       => 'button_prev',
					'type'        => __( 'Button Previous Text', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'button_next',
					'type'        => __( 'Button Next Text', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'email_to',
					'type'        => __( 'Email To', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'email_subject',
					'type'        => __( 'Email Subject', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'email_content',
					'type'        => __( 'Email Content', 'pafe' ),
					'editor_type' => 'AREA'
				],
				[
					'field'       => 'email_from',
					'type'        => __( 'Email From', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'email_from_name',
					'type'        => __( 'Email From Name', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'email_reply_to',
					'type'        => __( 'Email Reply To', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'email_to_cc',
					'type'        => __( 'Cc', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'email_to_bcc',
					'type'        => __( 'Bcc', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'email_to_2',
					'type'        => __( 'Email To 2', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'email_subject_2',
					'type'        => __( 'Email Subject 2', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'email_content_2',
					'type'        => __( 'Email Content 2', 'pafe' ),
					'editor_type' => 'AREA'
				],
				[
					'field'       => 'email_from_2',
					'type'        => __( 'Email From 2', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'email_from_name_2',
					'type'        => __( 'Email From Name 2', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'email_reply_to_2',
					'type'        => __( 'Email Reply To 2', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'email_to_cc_2',
					'type'        => __( 'Cc 2', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'email_to_bcc_2',
					'type'        => __( 'Bcc 2', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'success_message',
					'type'        => __( 'Success Message', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'error_message',
					'type'        => __( 'Error Message', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'required_field_message',
					'type'        => __( 'Required Message', 'pafe' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'invalid_message',
					'type'        => __( 'Invalid Message', 'pafe' ),
					'editor_type' => 'LINE'
				],
			],
		];

		return $widgets;
	}
	public function pafe_get_pdf_fonts(){
		$pdf_fonts = [];
		$pdf_fonts['default'] = 'Default';
		$pdf_fonts['Courier'] = 'Courier';
		$pdf_fonts['Helvetica'] = 'Helvetica';
		$pdf_fonts['Times'] = 'Times';
		$args = array( 
			'post_type' => 'pafe-fonts',
			'post_status' => 'publish',
		);
		$fonts = new WP_Query( $args );
		if(!empty($fonts->posts)){
			foreach($fonts->posts as $key => $font){
				$font_key = get_post_meta($font->ID, '_pafe_pdf_font', true);
				$font_key = substr($font_key, strpos($font_key, 'uploads/')+8);
				$pdf_fonts[$font_key] = $font->post_title;
			}
		}
		return $pdf_fonts;
	}
	public function pafe_get_pdf_fonts_style(){
		$pdf_fonts_style = [];
		$pdf_fonts_style['N'] = 'Normal';
		$pdf_fonts_style['I'] = 'Italic';
		$pdf_fonts_style['B'] = 'Bold';
		$pdf_fonts_style['BI'] = 'Bold Italic';
		$args = array( 
			'post_type' => 'pafe-fonts',
			'post_status' => 'publish',
		);
		$fonts = new WP_Query( $args );
		if(!empty($fonts->posts)){
			foreach($fonts->posts as $key => $font){
				$font_key = get_post_meta($font->ID, '_pafe_pdf_font', true);
				$font_key = substr($font_key, strpos($font_key, 'uploads/')+8);
				$pdf_fonts_style[$font_key] = $font->post_title;
			}
		}
		return $pdf_fonts_style;
	}

}

?>
