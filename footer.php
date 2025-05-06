<?php
$instagram = get_theme_mod('my_theme_instagram');
$facebook  = get_theme_mod('my_theme_facebook');
$whatsapp  = get_theme_mod('my_theme_whatsapp');
$week_hours = get_theme_mod('my_theme_hours_week');
$sunday_hours = get_theme_mod('my_theme_hours_sunday');
$address = get_theme_mod('my_theme_address');
$complement = get_theme_mod('my_theme_complement');
?>

<footer class="p-4 bg-white sm:p-6">
  <div class="mx-auto max-w-screen-xl">
    <div class="md:flex justify-between gap-4">
      <div class="flex flex-col gap-2 mb-8 items-center md:items-start">
        <div class="text-2xl mb-4 text-center md:text-left text-blue-900">Funcionamento</div>
        <p class="text-sm"><strong>Segunda a Sábado : </strong><span class="text-[var(--primary)]"><?php echo $week_hours; ?></span></p>
        <p class="text-sm"><strong>Domingos e feriados : </strong><span class="text-[var(--primary)]"><?php echo $sunday_hours; ?></span></p>
      </div>
      <div class="flex flex-col gap-2 mb-8">
        <div class="text-2xl mb-4 text-center text-blue-900">Onde estamos</div>
        <div class="flex items-center justify-center">
          <div class="text-[var(--primary)] text-sm"><?php echo $address; ?></div>
        </div>
        <div class="flex items-center justify-center text-sm">
          <?php echo $complement; ?>
        </div>
      </div>
      <div class="flex gap-2 items-center justify-center">
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
    </div>
    <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
    <div class="sm:flex items-center justify-between">
      <div class="text-sm text-gray-500 text-center">© <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos direitos reservados.
      </div>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/flowbite.js"></script>