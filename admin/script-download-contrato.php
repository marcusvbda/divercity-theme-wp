<?php

require_once(dirname(__FILE__) . '/../../../../wp-load.php');

$festa_id = isset($_GET['festa_id']) ? intval($_GET['festa_id']) : 0;
$festa = get_post($festa_id);
if (!$festa) {
    status_header(404);
    echo 'Erro 404: Festa não encontrada.';
    exit;
}

$modelo_contrato_id = get_post_meta($festa->ID, '_festa_modelo_contrato', true);

if ($festa->post_type !== 'festa' || !$modelo_contrato_id) {
    status_header(404);
    echo 'Erro 404: Festa não encontrada.';
    exit;
}

$modelo = get_post($modelo_contrato_id);
if (!$modelo) {
    status_header(404);
    echo 'Erro 404: Festa não encontrada.';
    exit;
}

$content = $modelo->post_content ?? '';
preg_match_all('/\{(.*?)\}/', $content, $matches);
$values = $matches[1];

foreach ($values as $value) {
    $index = "_festa_$value";
    $indexValue = get_post_meta($festa->ID, $index, true);
    $content = str_replace('{' . $value . '}', $indexValue, $content);
}

echo $content;
