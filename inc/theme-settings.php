<?php
function theme_customize_register($wp_customize)
{
	// --- General Information ---
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

	// Media Kit Link
	$wp_customize->add_setting('media_kit_link', [
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	]);
	$wp_customize->add_control('media_kit_link_control', [
		'label' => __('Media Kit Link', 'theme-slug'),
		'section' => 'general_info_settings',
		'settings' => 'media_kit_link',
		'type' => 'url',
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

	// --- Cookie Settings ---
	$wp_customize->add_section('cookie_settings', [
		'title' => __('Cookie Settings', 'theme-slug'),
		'priority' => 35,
	]);

	// Short Text
	$wp_customize->add_setting('cookie_short_text', [
		'default' => 'Ми використовуємо cookies для покращення роботи сайту.',
		'sanitize_callback' => 'wp_kses_post',
	]);
	$wp_customize->add_control('cookie_short_text_control', [
		'label' => __('Cookie Short Text', 'theme-slug'),
		'section' => 'cookie_settings',
		'settings' => 'cookie_short_text',
		'type' => 'textarea',
	]);

	// Full Text
	$wp_customize->add_setting('cookie_full_text', [
		'default' => 'Повний текст політики cookies з усіма деталями...',
		'sanitize_callback' => 'wp_kses_post',
	]);
	$wp_customize->add_control('cookie_full_text_control', [
		'label' => __('Cookie Full Text', 'theme-slug'),
		'section' => 'cookie_settings',
		'settings' => 'cookie_full_text',
		'type' => 'textarea',
	]);

	// Accept Button
	$wp_customize->add_setting('cookie_accept_text', [
		'default' => 'Приймаю всі',
		'sanitize_callback' => 'sanitize_text_field',
	]);
	$wp_customize->add_control('cookie_accept_text_control', [
		'label' => __('Accept Button Text', 'theme-slug'),
		'section' => 'cookie_settings',
		'settings' => 'cookie_accept_text',
		'type' => 'text',
	]);

	// Reject Button
	$wp_customize->add_setting('cookie_reject_text', [
		'default' => 'Без додаткових',
		'sanitize_callback' => 'sanitize_text_field',
	]);
	$wp_customize->add_control('cookie_reject_text_control', [
		'label' => __('Reject Button Text', 'theme-slug'),
		'section' => 'cookie_settings',
		'settings' => 'cookie_reject_text',
		'type' => 'text',
	]);
}

add_action('customize_register', 'theme_customize_register');
