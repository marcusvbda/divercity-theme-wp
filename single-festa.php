<?php
get_header();

$slug = get_query_var('name');
$step = @$_GET['step'] ? $_GET['step'] : 'form';

$festa = get_page_by_path($slug, OBJECT, 'festa');

if (!$festa || $festa->post_type !== 'festa') {
    echo '<div class="max-w-screen-xl mx-auto text-red-600 text-lg mt-8">Festa não encontrada.</div>';
    get_footer();
    exit;
}

$post_id = $festa->ID;

$nome = get_post_meta($post_id, '_festa_nome_representante', true);
$email = get_post_meta($post_id, '_festa_email_representante', true);

if (isset($_POST['enviar_festa'])) {
    $nome = sanitize_text_field($_POST['nome_representante']);
    $email = sanitize_email($_POST['email_representante']);

    update_post_meta($post_id, '_festa_nome_representante', $nome);
    update_post_meta($post_id, '_festa_email_representante', $email);

    wp_redirect(add_query_arg('step', 'message', get_permalink()));
    exit;
}
?>

<main class="pb-20">
    <section class="max-w-screen-xl mx-auto py-8 lg:py-16 px-4 md:px-0">

        <?php if ($step === 'message') : ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                Festa enviada com sucesso!
            </div>
        <?php endif; ?>

        <?php if ($step === 'form') : ?>
            <h2 class="text-3xl mb-4 font-bold">Solicite sua festa</h2>
            <form method="POST" class="flex flex-col gap-4 bg-white p-6 border rounded-md shadow-md">
                <div>
                    <label class="block mb-1 font-medium">Nome do Representante:</label>
                    <input type="text" name="nome_representante" required class="w-full border border-gray-300 rounded-md p-2"
                        value="<?php echo esc_attr($nome); ?>">
                </div>

                <div>
                    <label class="block mb-1 font-medium">Email do Representante:</label>
                    <input type="email" name="email_representante" required class="w-full border border-gray-300 rounded-md p-2"
                        value="<?php echo esc_attr($email); ?>">
                </div>

                <input type="submit" name="enviar_festa" value="Enviar Festa"
                    class="bg-blue-900 text-white p-2 rounded-md cursor-pointer hover:bg-blue-800 transition">
            </form>
        <?php endif; ?>
    </section>
</main>

<script>
    if (window.history.replaceState) {
        const url = window.location.origin + window.location.pathname;
        window.history.replaceState(null, '', url);
    }
</script>
<?php get_footer(); ?>