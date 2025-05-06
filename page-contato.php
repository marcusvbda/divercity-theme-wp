<?php get_header(); ?>

<body <?php body_class(); ?>>
    <main class="pb-20">
        <?php
        $firstFrame = get_field('first_frame');
        $title = $firstFrame['titulo'] ?? "";
        $description = $firstFrame['titulo'] ?? "";
        ?>
        <section class="py-8 lg:py-16">
            <div class="mx-auto max-w-screen-xl relative">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vector-4.svg" class="size-24 absolute -left-8 -top-24 hidden md:block -rotate-180">
                <div class="px-4 mx-auto max-w-screen-md">
                    <h5 class="text-4xl md:text-6xl font-medium title-font text-blue-900 mb-2 text-center"><?php echo $title; ?></h5>
                    <div class="mb-20 font-light text-gray-500 text-center"><?php echo $description; ?></div>
                    <?php
                    echo do_shortcode('[fluentform id="3"]');
                    ?>
                </div>
            </div>
        </section>
    </main>
</body>


<?php get_footer(); ?>