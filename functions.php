<?php

function my_theme_setup()
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
  add_theme_support('custom-logo', [
    'height'      => 100,
    'width'       => 300,
    'flex-height' => true,
    'flex-width'  => true,
  ]);

  register_nav_menus([
    'main-menu' => 'Main Menu',
  ]);
}
add_action('after_setup_theme', 'my_theme_setup');

function my_theme_assets()
{
  wp_enqueue_style('my-theme-fonts', get_template_directory_uri() . '/fonts.css');
  wp_enqueue_style('my-theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'my_theme_assets');

add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);

function my_theme_customize_register($wp_customize)
{
  // Seção de Redes Sociais e Contato
  $wp_customize->add_section('my_theme_contact_section', [
    'title'    => __('Contato, Redes Sociais e localização', 'my-theme'),
    'priority' => 40,
  ]);

  $wp_customize->add_setting('my_theme_instagram', ['default' => '', 'transport' => 'refresh']);
  $wp_customize->add_control('my_theme_instagram_control', [
    'label'    => __('Instagram URL', 'my-theme'),
    'section'  => 'my_theme_contact_section',
    'settings' => 'my_theme_instagram',
    'type'     => 'url',
  ]);

  $wp_customize->add_setting('my_theme_facebook', ['default' => '', 'transport' => 'refresh']);
  $wp_customize->add_control('my_theme_facebook_control', [
    'label'    => __('Facebook URL', 'my-theme'),
    'section'  => 'my_theme_contact_section',
    'settings' => 'my_theme_facebook',
    'type'     => 'url',
  ]);

  $wp_customize->add_setting('my_theme_whatsapp', ['default' => '', 'transport' => 'refresh']);
  $wp_customize->add_control('my_theme_whatsapp_control', [
    'label'    => __('WhatsApp (somente números com DDD e país)', 'my-theme'),
    'section'  => 'my_theme_contact_section',
    'settings' => 'my_theme_whatsapp',
    'type'     => 'text',
  ]);

  // Novo campo: Endereço
  $wp_customize->add_setting('my_theme_address', ['default' => '', 'transport' => 'refresh']);
  $wp_customize->add_control('my_theme_address_control', [
    'label'    => __('Endereço', 'my-theme'),
    'section'  => 'my_theme_contact_section',
    'settings' => 'my_theme_address',
    'type'     => 'text',
  ]);

  // Novo campo: Complemento
  $wp_customize->add_setting('my_theme_complement', ['default' => '', 'transport' => 'refresh']);
  $wp_customize->add_control('my_theme_complement_control', [
    'label'    => __('Complemento', 'my-theme'),
    'section'  => 'my_theme_contact_section',
    'settings' => 'my_theme_complement',
    'type'     => 'text',
  ]);

  // Seção de Horário de Funcionamento
  $wp_customize->add_section('my_theme_hours_section', [
    'title'    => __('Horário de Funcionamento', 'my-theme'),
    'priority' => 45,
  ]);

  $wp_customize->add_setting('my_theme_hours_week', ['default' => '', 'transport' => 'refresh']);
  $wp_customize->add_control('my_theme_hours_week_control', [
    'label'    => __('Segunda a Sábado', 'my-theme'),
    'section'  => 'my_theme_hours_section',
    'settings' => 'my_theme_hours_week',
    'type'     => 'text',
  ]);

  $wp_customize->add_setting('my_theme_hours_sunday', ['default' => '', 'transport' => 'refresh']);
  $wp_customize->add_control('my_theme_hours_sunday_control', [
    'label'    => __('Domingos e Feriados', 'my-theme'),
    'section'  => 'my_theme_hours_section',
    'settings' => 'my_theme_hours_sunday',
    'type'     => 'text',
  ]);
}
add_action('customize_register', 'my_theme_customize_register');

function my_remove_content_editor()
{
  remove_post_type_support('page', 'editor');
}
add_action('init', 'my_remove_content_editor');

function dd($var)
{
  var_dump($var);
  exit;
}

function register_my_menus()
{
  register_nav_menus(
    array(
      'main-menu' => __('Menu Principal'),
    )
  );
}
add_action('after_setup_theme', 'register_my_menus');

add_filter('show_admin_bar', '__return_false');

add_filter('nav_menu_css_class', function ($classes, $item, $args, $depth) {
  if (!empty($args->li_class)) {
    $classes[] = $args->li_class;
  }
  return $classes;
}, 10, 4);

add_filter('nav_menu_link_attributes', function ($atts, $item, $args, $depth) {
  if (!empty($args->a_class)) {
    $atts['class'] = $args->a_class;
  }
  return $atts;
}, 10, 4);
