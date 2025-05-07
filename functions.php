<?php

function dd($var)
{
  var_dump($var);
  exit;
}

add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
  add_theme_support('custom-logo', [
    'height'      => 100,
    'width'       => 300,
    'flex-height' => true,
    'flex-width'  => true,
  ]);
  register_nav_menus(
    array(
      'main-menu' => __('Menu Principal'),
    )
  );
});

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('my-theme-fonts', get_template_directory_uri() . '/fonts.css');
  wp_enqueue_style('my-theme-style', get_stylesheet_uri());
});

add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);

add_action('customize_register', function ($wp_customize) {
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

  $wp_customize->add_setting('my_theme_address', ['default' => '', 'transport' => 'refresh']);
  $wp_customize->add_control('my_theme_address_control', [
    'label'    => __('Endereço', 'my-theme'),
    'section'  => 'my_theme_contact_section',
    'settings' => 'my_theme_address',
    'type'     => 'text',
  ]);

  $wp_customize->add_setting('my_theme_complement', ['default' => '', 'transport' => 'refresh']);
  $wp_customize->add_control('my_theme_complement_control', [
    'label'    => __('Complemento', 'my-theme'),
    'section'  => 'my_theme_contact_section',
    'settings' => 'my_theme_complement',
    'type'     => 'text',
  ]);

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
});

add_action('init', function () {
  remove_post_type_support('page', 'editor');

  $labelsFesta = array(
    'name' => 'Festas',
    'singular_name' => 'Festa',
    'add_new' => 'Adicionar Nova',
    'add_new_item' => 'Adicionar Nova Festa',
    'edit_item' => 'Editar Festa',
    'new_item' => 'Nova Festa',
    'view_item' => 'Ver Festa',
    'search_items' => 'Buscar Festas',
    'not_found' => 'Nenhuma festa encontrada',
    'not_found_in_trash' => 'Nenhuma festa encontrada na lixeira',
  );

  $argsFesta = array(
    'labels' => $labelsFesta,
    'public' => true,
    'has_archive' => true,
    'menu_position' => 5,
    'supports' => array('title'),
    'show_in_rest' => false,
    'rewrite' => [
      'slug' => 'festa',
      'with_front' => false,
    ],
    'rewrite' => [
      'slug' => 'festa',
      'with_front' => false,
    ],
  );

  register_post_type('festa', $argsFesta);

  $labelsModelos = array(
    'name' => 'Modelos de Contrato',
    'singular_name' => 'Modelo de Contrato',
    'add_new' => 'Adicionar Novo',
    'add_new_item' => 'Adicionar Novo Modelo',
    'edit_item' => 'Editar Modelo',
    'new_item' => 'Novo Modelo',
    'view_item' => 'Ver Modelo',
    'search_items' => 'Buscar Modelos',
    'not_found' => 'Nenhum modelo encontrado',
    'not_found_in_trash' => 'Nenhum modelo encontrado na lixeira',
    'rewrite' => [
      'slug' => 'modelo-contrato',
      'with_front' => false,
    ],
  );

  $argsModelos = array(
    'labels' => $labelsModelos,
    'public' => true,
    'has_archive' => true,
    'menu_position' => 6,
    'supports' => array('title', 'editor'),
    'show_in_rest' => true,
  );

  register_post_type('modelo_contrato', $argsModelos);
});

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

add_action('add_meta_boxes', function () {
  remove_meta_box('wpseo_meta', 'festa', 'normal');
  remove_meta_box('litespeed_meta_boxes', 'festa', 'side');
  remove_meta_box('wpseo_meta', 'modelo_contrato', 'normal');
  remove_meta_box('litespeed_meta_boxes', 'modelo_contrato', 'side');
}, 99);

add_action('add_meta_boxes', function () {
  add_meta_box(
    'festa_custom_fields',
    'Campos de Festa',
    'festa_custom_fields_callback',
    'festa',
    'normal',
    'default'
  );
});

function festa_custom_fields_callback($post)
{
  // Nome do Representante
  $nome_representante = get_post_meta($post->ID, '_festa_nome_representante', true);
  echo '<p><label for="festa_nome_representante">Nome do Representante</label>';
  echo '<input type="text" id="festa_nome_representante" name="festa_nome_representante" value="' . esc_attr($nome_representante) . '" style="width:100%;" /></p>';

  // Email do Representante
  $email_representante = get_post_meta($post->ID, '_festa_email_representante', true);
  echo '<p><label for="festa_email_representante">Email do Representante</label>';
  echo '<input type="email" id="festa_email_representante" name="festa_email_representante" value="' . esc_attr($email_representante) . '" style="width:100%;" /></p>';

  // Modelo de Contrato
  $modelos = get_posts(array(
    'post_type' => 'modelo_contrato',
    'posts_per_page' => -1,
  ));
  $selected_modelo = get_post_meta($post->ID, '_festa_modelo_contrato', true);
  echo '<p><label for="festa_modelo_contrato">Modelo de Contrato</label>';
  echo '<select name="festa_modelo_contrato" style="width:100%;">';
  echo '<option value="">Selecione um modelo de contrato</option>';
  foreach ($modelos as $modelo) {
    $selected = ($selected_modelo == $modelo->ID) ? 'selected' : '';
    echo '<option value="' . $modelo->ID . '" ' . $selected . '>' . $modelo->post_title . '</option>';
  }
  echo '</select></p>';
}

add_action('save_post', function ($post_id) {
  if (isset($_POST['festa_nome_representante'])) {
    update_post_meta($post_id, '_festa_nome_representante', sanitize_text_field($_POST['festa_nome_representante']));
  }

  if (isset($_POST['festa_email_representante'])) {
    update_post_meta($post_id, '_festa_email_representante', sanitize_email($_POST['festa_email_representante']));
  }

  if (isset($_POST['festa_modelo_contrato'])) {
    update_post_meta($post_id, '_festa_modelo_contrato', sanitize_text_field($_POST['festa_modelo_contrato']));
  }
});

add_action('edit_form_after_title', function ($post) {
  if ($post->post_type === 'festa') {
    $modelo_contrato_id = get_post_meta($post->ID, '_festa_modelo_contrato', true);
    if (!$modelo_contrato_id) {
      echo "";
    } else {
      $url = get_template_directory_uri() . '/admin/script-download-contrato.php?festa_id=' . $post->ID;
      echo '<div style="margin-top:10px; padding:10px; background:#f1f1f1; border:1px solid #ccc;">';
      echo '<a href="' . esc_url($url) . '" target="_blank" style="font-weight:bold; text-decoration:none;">⬇️ Baixar contrato preenchido com dados do cadastro</a>';
      echo '</div>';
    }
  }
});

// add_action('init', function () {
//   flush_rewrite_rules();
// }, 99);
