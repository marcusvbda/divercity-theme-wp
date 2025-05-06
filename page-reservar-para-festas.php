<?php get_header(); ?>

<body <?php body_class(); ?>>
    <main class="pb-20">
        <?php
        $firstFrame = get_field('first_frame');
        $title = $firstFrame['title'] ?? "";
        $description = $firstFrame['descricao'] ?? "";
        $disclaimer = $firstFrame['disclaimer'] ?? "";
        ?>
        <section>
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                <h5 class="text-4xl md:text-6xl font-medium title-font text-blue-900 text-center mb-10"><?php echo $title; ?></h5>
                <div class="mb-4 font-light text-gray-500 text-center"><?php echo $description; ?></div>
                <div class="mb-20 font-light text-[var(--primary)] text-center"><?php echo $disclaimer; ?></div>
                <div class="w-full flex flex-col md:flex-row gap-4 justify-center items-center">
                    <?php
                    echo do_shortcode('[fluentform type="conversational" id="4"]');
                    ?>
                </div>
            </div>
        </section>
    </main>
</body>


<?php get_footer(); ?>