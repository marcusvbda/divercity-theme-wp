<?php get_header(); ?>

<body <?php body_class(); ?>>
    <main class="pb-20">
        <?php
        $firstFrame = get_field('first_frame');
        $title = $firstFrame['title'] ?? "";
        $description = $firstFrame['descricao'] ?? "";
        $disclaimer = $firstFrame['disclaimer'] ?? "";
        $prices = $firstFrame['precos'] ?? [];
        ?>
        <section>
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 relative">
                <h5 class="text-4xl md:text-6xl font-medium title-font text-blue-900 mb-2 text-center"><?php echo $title; ?></h5>
                <div class="mb-20 font-light text-gray-500 text-center"><?php echo $description; ?></div>
                <div class="w-full flex flex-col md:flex-row gap-4 justify-center items-center">
                    <?php foreach ($prices as $price) : ?>
                        <div class="w-full md:w-4/12 flex flex-col p-6 mx-auto max-w-lg text-center text-blue-900 bg-white rounded-lg border border-gray-100 shadow xl:p-8 z-[-1]">
                            <h3 class="mb-4 text-2xl font-semibold"><?php echo $price['titulo']; ?></h3>
                            <p class="font-light text-gray-500 sm:text-lg"><?php echo $price['descricao']; ?></p>
                            <?php foreach ($price['opcoes'] as $option) : ?>
                                <div class="flex justify-center items-baseline my-8">
                                    <span class="mr-2 text-5xl font-extrabold text-[var(--primary)]"><?php echo $option['preco']; ?></span>
                                    <span class="text-gray-500"><?php echo $option['tempo']; ?></span>
                                </div>
                                <ul role="list" class="mb-8 space-y-4 text-left">
                                    <li class="flex items-center space-x-3">
                                        <?php echo $option['descricao']; ?>
                                    </li>
                                </ul>

                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="w-full my-8"><?php echo $disclaimer; ?></div>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vector-4.svg" class="size-24 absolute left-12 -bottom-18 hidden md:block -rotate-180">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vector-3.png" class="size-24 absolute right-12 -bottom-4 hidden md:block -rotate-24">
            </div>
        </section>
    </main>
</body>


<?php get_footer(); ?>