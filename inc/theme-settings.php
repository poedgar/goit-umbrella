<?php
function theme_customize_register($wp_customize)
{
	$wp_customize->add_section('contact_settings', [
		'title' => __('Contact Settings', 'goit-umbrella'),
		'priority' => 30,
	]);

	$wp_customize->add_setting('contact_email', [
		'default' => 'info@bettered.global',
		'sanitize_callback' => 'sanitize_email',
	]);

	$wp_customize->add_control('contact_email_control', [
		'label' => __('Contact Email', 'goit-umbrella'),
		'section' => 'contact_settings',
		'settings' => 'contact_email',
		'type' => 'email',
	]);
}
add_action('customize_register', 'theme_customize_register');
