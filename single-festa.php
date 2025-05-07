<?php
get_header();
$campos = [
    'nome_representante' => ["type" => "text", "label" => 'Nome do Representante', "required" => true],
    'email_representante' => ["type" => "text", "label" => 'Email do Representante', "required" => true],
    'rg' => ["type" => "text", "label" => 'RG', "required" => true],
    'cpf' => ["type" => "text", "label" => 'CPF', "required" => true],
    'cep' => ["type" => "text", "label" => 'CEP', "required" => true],
    'cidade' => ["type" => "text", "label" => 'Cidade', "required" => true],
    'endereco' => ["type" => "text", "label" => 'Endereço', "required" => true],
    'numero' => ["type" => "text", "label" => 'Número', "required" => true],
    'bairro' => ["type" => "text", "label" => 'Bairro', "required" => true],
    'complemento' => ["type" => "text", "label" => 'Complemento', "required" => false],
    'data_evento' => ["type" => "date", "label" => 'Data do Evento', "required" => true],
    'horario_inicio' => ["type" => "time", "label" => 'Horário de Início', "required" => true],
    'horario_termino' => ["type" => "time", "label" => 'Horário de Término (no máximo até 21:30h)', "required" => true],
    'telefone' => ["type" => "text", "label" => 'Telefone', "required" => true],
    'qtd_adultos' => ["type" => "number", "label" => 'Quantidade de Adultos (mínimo 2)', "min" => 2, "required" => true],
    'qtd_criancas' => ["type" => "number", "label" => 'Quantidade de Crianças (mínimo 10)', "min" => 10, "required" => true],
];
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
    foreach ($campos as $key => $field) {
        $input_name = 'festa_' . $key;
        if (!isset($_POST[$input_name])) continue;

        $raw_value = $_POST[$input_name];
        $sanitized_value = '';

        switch ($field['type']) {
            case 'email':
                $sanitized_value = sanitize_email($raw_value);
                break;
            case 'number':
                $sanitized_value = intval($raw_value);
                break;
            case 'text':
            case 'date':
            case 'time':
            default:
                $sanitized_value = sanitize_text_field($raw_value);
                break;
        }

        update_post_meta($post_id, "_festa_$key", $sanitized_value);
    }
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
                <?php foreach ($campos as $key => $field) : ?>
                    <?php
                    $valor = get_post_meta($post->ID, "_festa_$key", true);
                    $type = isset($field['type']) ? $field['type'] : 'text';
                    $label = $field['label'];

                    $min = isset($field['min']) ? 'min="' . $field['min'] . '"' : '';
                    $max = isset($field['max']) ? 'max="' . $field['max'] . '"' : '';
                    $maxlength = isset($field['maxlength']) ? 'maxlength="' . $field['maxlength'] . '"' : '';
                    echo '<p><label class="block mb-1 font-medium" for="festa_' . $key . '">' . $label . '</label>';
                    $required = $field['required'] ? 'required' : '';
                    echo "<input $required class='w-full border border-gray-300 rounded-md p-2' type='{$type}' id='festa_{$key}' name='festa_{$key}' value='" . esc_attr($valor) . "' style='width:100%;' {$min} {$max} {$maxlength} />";
                    ?>
                <?php endforeach; ?>
                <input type="submit" name="enviar_festa" value="Enviar Festa"
                    class="bg-blue-900 text-white p-2 rounded-md cursor-pointer hover:bg-blue-800 transition mt-10">
            </form>
        <?php endif; ?>
    </section>
</main>

<script>
    if (window.history.replaceState) {
        const url = window.location.origin + window.location.pathname;
        window.history.replaceState(null, '', url);
    }
    document.addEventListener('DOMContentLoaded', function() {
        const rgInput = document.querySelector('#festa_rg');
        const cpfInput = document.querySelector('#festa_cpf');

        function maskRG(value) {
            return value
                .replace(/\D/g, '') // Remove tudo que não é número
                .replace(/^(\d{2})(\d)/, '$1.$2') // Coloca ponto depois dos 2 primeiros dígitos
                .replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3') // Outro ponto
                .replace(/\.(\d{3})(\d)/, '.$1-$2') // Hífen
                .replace(/(-\d{1})\d+?$/, '$1'); // Limita ao padrão
        }

        function maskCPF(value) {
            return value
                .replace(/\D/g, '')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})\.(\d{3})(\d)/, '$1.$2.$3')
                .replace(/(\d{3})\.(\d{3})\.(\d{3})(\d)/, '$1.$2.$3-$4')
                .replace(/(-\d{2})\d+?$/, '$1');
        }

        if (rgInput) {
            rgInput.addEventListener('input', () => {
                rgInput.value = maskRG(rgInput.value);
            });
        }

        if (cpfInput) {
            cpfInput.addEventListener('input', () => {
                cpfInput.value = maskCPF(cpfInput.value);
            });
        }


        const cepInput = document.querySelector('#festa_cep');

        if (cepInput) {
            cepInput.addEventListener('blur', function() {
                const cep = cepInput.value.replace(/\D/g, '');

                if (cep.length === 8) {
                    fetch(`https://viacep.com.br/ws/${cep}/json/`)
                        .then(response => response.json())
                        .then(data => {
                            if (!data.erro) {
                                const enderecoInput = document.querySelector('#festa_endereco');
                                const bairroInput = document.querySelector('#festa_bairro');
                                const cidadeInput = document.querySelector('#festa_cidade');
                                const complementoInput = document.querySelector('#festa_complemento');

                                if (enderecoInput) enderecoInput.value = data.logradouro || '';
                                if (bairroInput) bairroInput.value = data.bairro || '';
                                if (cidadeInput) cidadeInput.value = data.localidade || '';
                                if (complementoInput) complementoInput.value = data.complemento || '';
                            } else {
                                alert('CEP não encontrado.');
                            }
                        })
                        .catch(() => {
                            alert('Erro ao consultar o CEP.');
                        });
                }
            });
        }
    });
</script>
<?php get_footer(); ?>