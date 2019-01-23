<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'main' => array(
		'type' => 'box',
		'title' => '',
		'options' => array(
			'id' => array(
				'type' => 'unique',
				'length' => 8
			),
			'builder' => array(
				'type' => 'tab',
				'title' => __('Form Fields', 'creatus'),
				'options' => array(
					'form' => array(
						'label' => false,
						'type' => 'form-builder',
						'value' => array(
							'json' => '[]'
						),
						'fixed_header' => true
					)
				)
			),
			'settings' => array(
				'type' => 'tab',
				'title' => __('Settings', 'creatus'),
				'options' => array(
					'settings-options' => array(
						'title' => __('Options', 'creatus'),
						'type' => 'tab',
						'options' => array(
							'email_to' => array(
								'type' => 'text',
								'label' => __('Email To', 'creatus'),
								'help' => esc_html__('We recommend you to use an email that you verify often', 'creatus'),
								'desc' => esc_html__('The form will be sent to this email address.', 'creatus')
							),
							'subject_message' => array(
								'type' => 'text',
								'label' => __('Subject Message', 'creatus'),
								'desc' => esc_html__('This text will be used as subject message for the email', 'creatus'),
								'value' => esc_html__('Contact Form', 'creatus')
							),
							'submit_button_text' => array(
								'type' => 'text',
								'label' => __('Submit Button', 'creatus'),
								'desc' => esc_html__('This text will appear in submit button', 'creatus'),
								'value' => esc_html__('Send', 'creatus')
							),
							'success_message' => array(
								'type' => 'text',
								'label' => __('Success Message', 'creatus'),
								'desc' => esc_html__('This text will be displayed when the form will successfully send', 'creatus'),
								'value' => esc_html__('Message sent!', 'creatus')
							),
							'suf' => array(
								'type' => 'thz-typography',
								'label' => __('Success font', 'creatus'),
								'value' => array(),
								'disable' => array(
									'hovered',
									'text-shadow'
								),
								'desc' => esc_html__('Adjust Success Message font', 'creatus'),
							),
							'failure_message' => array(
								'type' => 'text',
								'label' => __('Failure Message', 'creatus'),
								'desc' => esc_html__('This text will be displayed when the form will fail to be sent', 'creatus'),
								'value' => esc_html__('Oops something went wrong.', 'creatus')
							),
							'faf' => array(
								'type' => 'thz-typography',
								'label' => __('Failure font', 'creatus'),
								'value' => array(),
								'disable' => array(
									'hovered',
									'text-shadow'
								),
								'desc' => esc_html__('Adjust Failure Message font', 'creatus'),
							),
							'fhide' => array(
								'label' => __('Hide form', 'creatus'),
								'desc' => __('Hide form after successful submit.', 'creatus'),
								'type' => 'short-select',
								'value' => 'donothide',
								'choices' => array(
									'donothide' => __('Do not hide', 'creatus'),
									'hide' => __('Hide', 'creatus'),
								)
							),
						)
					),
					'mailer-options' => array(
						'title' => __('Mailer', 'creatus'),
						'type' => 'tab',
						'options' => array(
							'mailer' => array(
								'label' => false,
								'type' => 'mailer'
							)
						)
					)
				)
			),
			'style' => array(
				'title' => __('Style', 'creatus'),
				'type' => 'tab',
				'options' => array(
					'spacings' => array(
						'type' => 'thz-multi-options',
						'label' => __('Elements spacings', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'value' => array(
							'v' => '',
							'h' => ''
						),
						'desc' => esc_html__('Adjust spacings for all elements in this form.', 'creatus'),
						'help' => esc_html__('This option will let you adjust space for all elements in this form. If empty it will use default theme form spacings.', 'creatus'),
						'thz_options' => array(
							'v' => array(
								'type' => 'spinner',
								'title' => esc_html__('Vertical', 'creatus'),
								'addon' => 'px',
								'min' => 0,
								'max' => 1000,
								'step' => 1,
								'attr' => array(
									'placeholder' => 15
								)
							),
							'h' => array(
								'type' => 'spinner',
								'title' => esc_html__('Horizontal', 'creatus'),
								'addon' => 'px',
								'min' => 0,
								'max' => 1000,
								'step' => 1,
								'attr' => array(
									'placeholder' => 30
								)
							)
						)
					),
					'bs' => array(
						'type' => 'thz-box-style',
						'label' => __('Container box style', 'creatus'),
						'preview' => false,
						'popup' => true,
						'button-text' => esc_html__('Customize container box style', 'creatus'),
						'desc' => esc_html__('Adjust .thz-shortcode-form box style', 'creatus'),
						'disable' => array(
							'video'
						),
						'value' => array()
					),
					'msgbs' => array(
						'type' => 'thz-box-style',
						'label' => __('Message box style', 'creatus'),
						'preview' => false,
						'popup' => true,
						'button-text' => esc_html__('Customize message box style', 'creatus'),
						'desc' => esc_html__('Adjust .thz-shortcode-form-msg box style.', 'creatus'),
						'disable' => array(
							'video'
						),
						'value' => array()
					),
					'i' => array(
						'type' => 'addable-popup',
						'value' => array(),
						'label' => __('Custom inputs', 'creatus'),
						'desc' => esc_html__('Add custom inputs style for this form or leave as is for theme defaults.', 'creatus'),
						'template' => 'Custom input style is active',
						'popup-title' => null,
						'size' => 'large',
						'limit' => 1,
						'add-button-text' => esc_html__('Add custom input style', 'creatus'),
						'sortable' => false,
						'popup-options' => array(
							'bs' => array(
								'type' => 'thz-box-style',
								'label' => __('Input box style', 'creatus'),
								'preview' => true,
								'disable' => array(
									'video',
									'boxsize',
									'layout'
								),
								'popup' => false,
								'value' => array()
							),
							'if' => array(
								'type' => 'thz-typography',
								'label' => __('Input font', 'creatus'),
								'value' => array(),
								'disable' => array(
									'hovered',
									'text-shadow'
								),
							),
							'lf' => array(
								'type' => 'thz-typography',
								'label' => __('Label font', 'creatus'),
								'value' => array(),
								'disable' => array(
									'hovered',
									'text-shadow'
								),
							),
							'thzelch' => array(
								'type' => 'thz-multi-options',
								'label' => __('Input hover colors', 'creatus'),
								'desc' => esc_html__('Adjust input:hover colors', 'creatus'),
								'value' => array(
									'bg' => '',
									'color' => '',
									'bcolor' => ''
								),
								'thz_options' => array(
									'bg' => array(
										'type' => 'color',
										'title' => esc_html__('Background', 'creatus'),
										'box' => true
									),
									'color' => array(
										'type' => 'color',
										'title' => esc_html__('Text color', 'creatus'),
										'box' => true
									),
									'bcolor' => array(
										'type' => 'color',
										'title' => esc_html__('Border color', 'creatus'),
										'box' => true
									)
								)
							),
							'thzelcf' => array(
								'type' => 'thz-multi-options',
								'label' => __('Input focus colors', 'creatus'),
								'desc' => esc_html__('Adjust input:focus colors', 'creatus'),
								'value' => array(
									'bg' => '',
									'color' => '',
									'bcolor' => ''
								),
								'thz_options' => array(
									'bg' => array(
										'type' => 'color',
										'title' => esc_html__('Background', 'creatus'),
										'box' => true
									),
									'color' => array(
										'type' => 'color',
										'title' => esc_html__('Text color', 'creatus'),
										'box' => true
									),
									'bcolor' => array(
										'type' => 'color',
										'title' => esc_html__('Border color', 'creatus'),
										'box' => true
									)
								)
							)
						)
					),
					'b' => array(
						'type' => 'addable-popup',
						'value' => array(),
						'label' => __('Custom button', 'creatus'),
						'desc' => esc_html__('Add custom button for this form or leave as is for theme defaults.', 'creatus'),
						'template' => 'Custom button is active',
						'popup-title' => null,
						'size' => 'large',
						'limit' => 1,
						'add-button-text' => esc_html__('Add custom button', 'creatus'),
						'sortable' => false,
						'popup-options' => array(
							'b' => array(
								'type' => 'thz-button',
								'hidelinks' => true,
								'value' => array(
									'buttonText' => 'Send',
									'activeColor' => 'theme',
									'buttonTag' => 'button',
									'html' => '<div class="thz-btn-container"><button class="thz-button thz-btn-theme thz-btn-normal thz-radius-4 thz-btn-border-1 thz-align-center"><span class="thz-btn-text thz-fs-14 thz-fw-400">Send</span></button></div>'
								),
								'label' => false
							)
						)
					),
					'cmx' => _thz_container_metrics_defaults()
				)
			),
			
			'conteffects' => array(
				'title' => __('Effects', 'creatus'),
				'type' => 'tab',
				'options' => array(
					'animate' => array(
						'type' => 'thz-animation',
						'label' => false,
						'value' => array(
							'animate' => 'inactive',
							'effect' => 'thz-anim-fadeIn',
							'duration' => 400,
							'delay' => 0
						)
					),
					'cpx' => _thz_container_parallax_default()
				)
			)
			
		)
	)
);