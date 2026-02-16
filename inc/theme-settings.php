<?php
function theme_customize_register($wp_customize)
{
	$wp_customize->add_section('general_info_settings', [
		'title' => __('General Information', 'theme-slug'),
		'priority' => 30,
	]);

	// Email
	$wp_customize->add_setting('contact_email', [
		'default' => 'info@bettered.global',
		'sanitize_callback' => 'sanitize_email',
	]);
	$wp_customize->add_control('contact_email_control', [
		'label' => __('Contact Email', 'theme-slug'),
		'section' => 'general_info_settings',
		'settings' => 'contact_email',
		'type' => 'email',
	]);

	// Slogan
	$wp_customize->add_setting('footer_slogan', [
		'default' => 'ВІД ЗНАНЬ ДО ВПЛИВУ',
		'sanitize_callback' => 'sanitize_text_field',
	]);
	$wp_customize->add_control('footer_slogan_control', [
		'label' => __('Footer Slogan', 'theme-slug'),
		'section' => 'general_info_settings',
		'settings' => 'footer_slogan',
		'type' => 'text',
	]);
}

add_action('customize_register', 'theme_customize_register');
