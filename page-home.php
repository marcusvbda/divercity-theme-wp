<?php get_header(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/typer.js"></script>
<?php
$hero = get_field('hero');
$placeholderImageDesktop = $hero["url_video"]["desktop"]["placeholder_image"] ?? null;
$videoUrlDesktop = $hero["url_video"]["desktop"]["url_do_video"] ?? null;

$placeholderImageMobile = $hero['hero']["url_video"]["mobile"]["placeholder_image"] ?? null;
$videoUrlMobile = $hero["url_video"]["mobile"]["url_do_video"] ?? null;

$heroLink = $hero["link"]["texto"] ?? null;
$heroUrl = $hero["link"]["url"] ?? null;

$typingText = array_map(function ($item) {
    return $item['texto'];
}, $hero["textos_digitando"] ?? []);


?>

<body <?php body_class(); ?>>
    <main class="page-content home-page">
        <?php if ($videoUrlDesktop) : ?>
            <video class="w-full hidden md:block" playsinline="" autoplay="" muted="" loop="" <?php if ($placeholderImageDesktop) echo  'poster="' . $placeholderImageDesktop . '"'; ?>>
                <source src="<?php echo $videoUrlDesktop; ?>" type="video/mp4">
            </video>
        <?php endif; ?>
        <?php if ($videoUrlMobile) : ?>
            <video class="w-full md:hidden sm:block" playsinline="" autoplay="" muted="" loop="" <?php if ($placeholderImageMobile) echo  'poster="' . $placeholderImageMobile . '"'; ?>>
                <source src="<?php echo $videoUrlMobile; ?>" type="video/mp4">
            </video>
        <?php endif; ?>
        <div class="navbar-border"></div>
        <div class="max-w-screen-xl mx-auto px-4 absolute inset-0 h-full flex flex-col justify-center items-center">
            <h2 class="text-4xl md:text-[65px] text-white font-bold max-w-[80%] md:max-w-[680px] text-center line-heading-[65px]" id="typewriter-hero"></h2>
            <script>
                var typed = new Typed('#typewriter-hero', {
                    strings: <?php echo json_encode($typingText); ?>,
                    typeSpeed: 30,
                    backSpeed: 10,
                    backDelay: 4000,
                    loop: true,
                });
            </script>
            <?php if ($heroLink) : ?>
                <a class="bg-[var(--primary)] text-white p-[10px_20px] absolute mt-[450px]" href="<?php echo $heroUrl; ?>"><?php echo $heroLink; ?></a>
            <?php endif; ?>
        </div>

        <?php
        $firstFrame = get_field('first_frame');
        $spinCards = $firstFrame['cards_giratorios'] ?? [];
        $description = $firstFrame['descricao'] ?? null;
        ?>
        <!-- first frame -->
        <section class="first-frame relative -top-[60px]">
            <div class="max-w-screen-xl mx-auto px-4 flex flex-col items-center md:flex-row gap-4 md:px-0">
                <?php foreach ($spinCards as $card) : ?>
                    <div class="flip-card w-full md:w-4/12 h-[200px] ">
                        <div class="flip-card-inner">
                            <div class="flip-card-front bg-white">
                                <div class="absolute inset-0 flex flex-col items-center justify-center transition-opacity duration-300 group-hover:opacity-0">
                                    <h4 class="text-xl font-bold mb-6 text-blue-900 px-4"><?php echo $card['titulo']; ?></h4>
                                    <span class="text-sm opacity-50 text-center text-blue-900 px-4"><?php echo $card['descricao']; ?></span>
                                </div>
                            </div>
                            <div class="flip-card-back flex items-center justify-center" style="background-color: <?php echo $card['cor_do_verso']; ?>;">
                                <div class="text-center text-white p-4 px-4">
                                    <?php echo $card['texto_verso']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <div class="max-w-screen-xl mx-auto px-4 md:px-0">
            <?php echo $description; ?>
        </div>


        <!-- atractions -->
        <?php
        $secondFrame = get_field('second_frame');
        $sectionTitle = $secondFrame['titulo_da_sessao'] ?? "";
        $atractions = $secondFrame['list'] ?? [];
        ?>
        <section class="text-gray-600 body-font mt-16">
            <div class="max-w-screen-xl mx-auto px-4 md:px-0 pb-24 pt-12 relative">
                <h5 class="text-4xl md:text-6xl font-medium title-font text-blue-900 mb-10 text-center md:text-left"><?php echo $sectionTitle; ?></h5>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vector.png" class="size-24 absolute right-12 -top-6 hidden md:block">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <?php foreach ($atractions as $key => $atraction) : ?>
                        <div class="flex items-center flex-col pb-6">
                            <div class="h-[300px] w-full bg-gray-200  rounded-md overflow-hidden flex items-center justify-center">
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

        <!-- pricing -->
        <?php
        $thirdFrame = get_field('third_frame');
        $title = $thirdFrame['title'] ?? "";
        $description = $thirdFrame['descricao'] ?? "";
        $disclaimer = $thirdFrame['disclaimer'] ?? "";
        $prices = $thirdFrame['precos'] ?? [];
        ?>
        <section>
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 relative">
                <h5 class="text-4xl md:text-6xl font-medium title-font text-blue-900 mb-2 text-center"><?php echo $title; ?></h5>
                <div class="mb-20 font-light text-gray-500 text-center"><?php echo $description; ?></div>
                <div class="w-full flex flex-col md:flex-row gap-4 justify-center items-center">
                    <?php foreach ($prices as $price) : ?>
                        <div class="w-full md:w-4/12 flex flex-col p-6 mx-auto max-w-lg text-center text-blue-900 bg-white rounded-lg border border-gray-100 shadow xl:p-8">
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
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vector-3.png" class="size-24 absolute right-12 -bottom-8 hidden md:block -rotate-24">
            </div>
        </section>


        <!-- contact -->
        <?php
        $fourthFrame = get_field('fourth_frame');
        $title = $fourthFrame['titulo'] ?? "";
        $description = $fourthFrame['descricao'] ?? "";
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


        <!-- FIVETH FRAME -->
        <?php
        $fivethFrame = get_field('fiveth_frame');
        $title = $fivethFrame['title'] ?? "";
        $description = $fivethFrame['descricao'] ?? "";
        $disclaimer = $fivethFrame['disclaimer'] ?? "";
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