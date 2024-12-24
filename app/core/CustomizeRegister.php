<?php

namespace Aprosglobal\Solarwp\core;

use WP_Customize_Image_Control;
use WP_Customize_Manager;

/**
 * This class is used to register the customizer.
 *
 * @package Aprosglobal\Solarwp\core
 * @author  Aprosglobal <info@apros.global>
 * @license GNU General Public License v2.0+
 * @link    https://github.com/aprosglobal/solarwp
 * @version 0.0.1
 * @since   0.0.1
 */

class CustomizeRegister
{
  public static function init()
  {
    // add_action('customize_register', [__CLASS__, 'crb_customize_register']);
    add_action('customize_register', [__CLASS__, 'swp_customize_register_logo']);
  }

  // static function crb_customize_register($wp_customize)
  // {
  //   $wp_customize->add_section('crb_section', array(
  //     'title'    => __('Crb', 'solarwp'),
  //     'priority' => 20,
  //   ));

  //   $wp_customize->add_setting('crb_text', array(
  //     'default'           => '',
  //     'sanitize_callback' => 'sanitize_text_field',
  //   ));

  //   $wp_customize->add_control(new \WP_Customize_Control($wp_customize, 'crb_text', array(
  //     'label'    => __('Crb', 'solarwp'),
  //     'section'  => 'crb_section',
  //     'settings' => 'crb_text',
  //   )));
  // }

  static function swp_customize_register_logo(WP_Customize_Manager $wp_customize)
  {
    $wp_customize->add_section('title_tagline', array(
      'title'    => __('Identidad del sitio', SWP_TEXTDOMAIN),
      'priority' => 20,
    ));

    $wp_customize->add_setting('second_custom_logo', array(
      'default'           => '',
      'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'second_custom_logo', array(
      'label'    =>  __('Second Logo', SWP_TEXTDOMAIN),
      'section'  => 'title_tagline',
      'settings' => 'second_custom_logo',
      'priority' => 9,
      'preview_size' => array(500, 500),
      'size' => array(500, 500),
      'mime_type' => 'image/*',
      'accept' => 'image/*',
      'description' => __('<code><small>second_custom_logo</small></code>', SWP_TEXTDOMAIN),
    )));
  }
}
