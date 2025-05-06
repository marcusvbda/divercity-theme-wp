<?php get_header(); ?>

<body <?php body_class(); ?>>
    <main class="page-content home-page">
        <div class="max-w-screen-xl mx-auto px-4 absolute inset-0 h-full flex flex-col justify-center items-center">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    the_title('<h1 class="entry-title">', '</h1>');
                    the_content();
                endwhile;
            else :
                echo '<p>Página não encontrada.</p>';
            endif;
            ?>
        </div>
    </main>
</body>


<?php get_footer(); ?>