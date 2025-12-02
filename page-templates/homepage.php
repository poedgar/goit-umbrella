<?php
/**
 * Template Name: Homepage
 * Description: Homepage
 */

get_header();

require_once get_template_directory() . '/views/homepage/ecosystem.php';
require_once get_template_directory() . '/views/homepage/impact.php';
require_once get_template_directory() . '/views/homepage/programs.php';
require_once get_template_directory() . '/views/homepage/timeline.php';
require_once get_template_directory() . '/views/homepage/awards.php';
require_once get_template_directory() . '/views/homepage/initiatives.php';
require_once get_template_directory() . '/views/homepage/collaboration.php';

get_footer(); ?>