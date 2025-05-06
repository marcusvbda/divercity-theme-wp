<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php
$instagram = get_theme_mod('my_theme_instagram');
$facebook  = get_theme_mod('my_theme_facebook');
$whatsapp  = get_theme_mod('my_theme_whatsapp');
$week_hours = get_theme_mod('my_theme_hours_week');
$sunday_hours = get_theme_mod('my_theme_hours_sunday');
$address = get_theme_mod('my_theme_address');
$complement = get_theme_mod('my_theme_complement');
?>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/tailwind/output.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
</head>

<header>
  <nav class="bg-transparent main-navigation w-full z-20 top-0 start-0">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <h1 class="site-title">
        <a href="<?php echo esc_url(home_url('/')); ?>">
          <?php
          if (has_custom_logo()) {
            the_custom_logo();
          } else {
            bloginfo('name');
          }
          ?>
        </a>
      </h1>

      <?php
      $menuItems = wp_get_nav_menu_object('main-menu') ?? [];
      ?>


      <button
        data-collapse-toggle="navbar-solid-bg"
        type="button"
        class="fixed md:hidden items-center right-5 top-10 p-2 size-14 justify-center menu-hamburger"
        aria-controls="navbar-solid-bg"
        aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="size-8 icon-open" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
        </svg>
        <div id="menu-overlay" class="fixed inset-0 bg-black/50 z-10 icon-close">
          <svg
            class="size-10 fixed right-5 top-10 z-10"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24">
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12" />
          </svg>
        </div>

      </button>
      <svg
        class="size-8 hidden icon-close"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24">
        <path
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M6 18L18 6M6 6l12 12" />
      </svg>
      <div
        id="navbar-solid-bg"
        class="hidden md:block desktop-menu bg-white md:bg-transparent fixed md:relative top-0 md:top-unset w-[80%] md:w-auto left-0 md:left-unset h-[100vh] z-2 md:z-auto md:h-auto">
        <?php
        wp_nav_menu([
          'theme_location' => 'main-menu',
          'menu_class' => 'flex flex-col font-medium mt-4 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 bg-transparent p-4 md:p-0',
        ]);
        ?>
      </div>
    </div>

    <div class="gap-2 items-center justify-center fixed z-1 right-2 top-2 hidden md:flex">
      <?php if ($instagram): ?>
        <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener" aria-label="Instagram">
          <img class="size-8" src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram.webp" alt="Instagram">
        </a>
      <?php endif; ?>
      <?php if ($facebook): ?>
        <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener" aria-label="Facebook">
          <img class="size-8" src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook.webp" alt="Facebook">
        </a>
      <?php endif; ?>
      <?php if ($whatsapp): ?>
        <a href="https://wa.me/<?php echo esc_attr(preg_replace('/\D/', '', $whatsapp)); ?>" target="_blank" rel="noopener" aria-label="WhatsApp">
          <img class="size-8" src="<?php echo get_template_directory_uri(); ?>/assets/images/wpp.webp" alt="Whatsapp">
        </a>
      <?php endif; ?>
    </div>
  </nav>
</header>