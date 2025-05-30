<?php
get_header();
?>

<main class="pb-20">
    <section class="max-w-screen-xl mx-auto py-8 lg:py-16 px-4 md:px-0">
        <!-- Conteúdo aqui -->
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post(); ?>
                <article class="mb-10">
                    <div class="prose max-w-none whitespace-pre-wrap">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>
    </section>
</main>

<?php
get_footer();
?>