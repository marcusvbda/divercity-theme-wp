jQuery(document).ready(function ($) {
    $('select[name="festa_modelo_contrato_id"]').on('change', function () {
        const modeloId = $(this).val();
        const postId = $('#post_ID').val();

        if (!modeloId) return;

        $.post(festaAdmin.ajax_url, {
            action: 'get_modelo_contrato_content',
            modelo_id: modeloId,
            post_id: postId,
            nonce: festaAdmin.nonce,
        }, function (response) {
            if (response.success) {
                $('textarea[name="festa_contrato_preenchido"]').val(response.data);
            }
        });
    });
});
