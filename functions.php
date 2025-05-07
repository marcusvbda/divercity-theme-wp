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

function register_festas_cpt()
{
  $labels = array(
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

  $args = array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'menu_position' => 5,
    'supports' => array('title'),
    'show_in_rest' => false,
  );

  register_post_type('festa', $args);
}
add_action('init', 'register_festas_cpt');

function add_festa_metaboxes()
{
  add_meta_box(
    'festa_representante',
    'Nome do Representante',
    'festa_representante_callback',
    'festa',
    'normal',
    'high'
  );
  add_meta_box(
    'festa_email_representante',
    'Email do Representante',
    'email_representante_callback',
    'festa',
    'normal',
    'high'
  );
}
add_action('add_meta_boxes', 'add_festa_metaboxes');

function festa_representante_callback($post)
{
  $value = get_post_meta($post->ID, '_festa_representante', true);
  echo '<input type="text" name="festa_representante" value="' . esc_attr($value) . '" style="width:100%">';
}

function email_representante_callback($post)
{
  $value = get_post_meta($post->ID, '_email_representante', true); // Corrigido para '_email_representante'
  echo '<input type="email" name="email_representante" value="' . esc_attr($value) . '" style="width:100%">';
}

function save_festa_representante($post_id)
{
  if (array_key_exists('festa_representante', $_POST)) {
    update_post_meta(
      $post_id,
      '_festa_representante',
      sanitize_text_field($_POST['festa_representante'])
    );
  }
}
add_action('save_post', 'save_festa_representante');

function save_email_representante($post_id)
{
  if (array_key_exists('email_representante', $_POST)) {
    update_post_meta(
      $post_id,
      '_email_representante', // Corrigido para '_email_representante'
      sanitize_email($_POST['email_representante']) // Usar sanitize_email
    );
  }
}
add_action('save_post', 'save_email_representante');

function add_festa_contrato_metabox()
{
  add_meta_box(
    'festa_modelo_contrato',
    'Modelo de Contrato',
    'festa_modelo_contrato_callback',
    'festa',
    'normal',
    'default'
  );
}
add_action('add_meta_boxes', 'add_festa_contrato_metabox');

$GLOBALS['contrato_padrao'] = '{festa_representante}, com email {email_representante} solicitou esta festa .... bla bla bla';

function processar_contrato($conteudo, $post_id)
{
  // Obtenha os valores de meta
  $representante = get_post_meta($post_id, '_festa_representante', true);
  $email_representante = get_post_meta($post_id, '_email_representante', true);

  // Substitua os campos no modelo
  $conteudo = str_replace('{festa_representante}', $representante, $conteudo);
  $conteudo = str_replace('{email_representante}', $email_representante, $conteudo);

  return $conteudo;
}

function festa_modelo_contrato_callback($post)
{
  $valor_padrao = $GLOBALS['contrato_padrao'];
  $conteudo = get_post_meta($post->ID, '_festa_modelo_contrato', true);

  if ($post->post_status === 'auto-draft' || $post->post_status === 'draft') {
    // Se for um novo post (ainda não salvo), mostra o modelo padrão não processado
    $conteudo = $valor_padrao;
  }

  // Exibir o editor com o conteúdo atual (sem processar aqui para evitar substituição dupla)
  wp_editor($conteudo, 'festa_modelo_contrato', [
    'textarea_name' => 'festa_modelo_contrato',
    'media_buttons' => false,
    'textarea_rows' => 10,
  ]);
}

function save_festa_modelo_contrato($post_id)
{
  if (array_key_exists('festa_modelo_contrato', $_POST)) {
    // Processar o contrato ao salvar (substituir variáveis por valores reais)
    $conteudo = processar_contrato($_POST['festa_modelo_contrato'], $post_id);

    update_post_meta(
      $post_id,
      '_festa_modelo_contrato',
      wp_kses_post($conteudo)
    );
  }
}
add_action('save_post', 'save_festa_modelo_contrato');
