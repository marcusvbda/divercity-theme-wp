<?php get_header(); ?>

<body <?php body_class(); ?>>
    <main class="pb-20">
        <?php
        $firstFrame = get_field('first_frame');
        $sectionTitle = $firstFrame['titulo_da_sessao'] ?? "";
        $atractions = $firstFrame['list'] ?? [];
        ?>
        <section class="text-gray-600 body-font">
            <div class="max-w-screen-xl mx-auto px-4 md:px-0 pb-24 pt-12 relative">
                <h5 class="text-4xl md:text-6xl font-medium title-font text-blue-900 mb-10 text-center md:text-left"><?php echo $sectionTitle; ?></h5>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vector.png" class="size-24 absolute right-12 -top-4 hidden md:block">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <?php foreach ($atractions as $key => $atraction) : ?>
                        <div class="flex items-center flex-col pb-6">
                            <div class="h-[300px] w-full bg-gray-200  rounded-md overflow-hidden flex items-center justify-center z-[-1]">
                                <img src="<?php echo $atraction['imagem']; ?>" class="w-full">
                            </div>
                            <div class="flex-col">
                                <h2 class="text-3xl text-[var(--primary)] title-font font-medium mb-4 pt-4">
                                    <?php echo $atraction['titulo']; ?>
                                </h2>
                                <p class="leading-relaxed text-base">
                                    <?php echo $atraction['descricao']; ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vector-2.svg" class="size-24 absolute left-12 -bottom-8 hidden md:block -rotate-24">
            </div>
        </section>

    </main>
</body>


<?php get_footer(); ?>