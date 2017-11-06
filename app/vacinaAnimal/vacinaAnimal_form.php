<?php
$form = new GForm();

function getVacinas(){
    $mysql = new GDbMysql();
    $query = "SELECT vac_int_codigo, vac_var_nome FROM vacina";
    $result = $mysql->executeCombo($query);
    return $result;
};

function getAnimais(){
    $mysql = new GDbMysql();
    $query = "select ani_int_codigo, ani_var_nome from animal where ani_cha_vivo = 'S'";
    $result = $mysql->executeCombo($query);
    return $result;
};

function getUsuarios(){
    $mysql = new GDbMysql();
    $query = "select usu_int_codigo, usu_var_nome from usuario";
    $result = $mysql->executeCombo($query);
    return $result;
};

$vacinas = getVacinas();
$animais = getAnimais();
$usuarios = getUsuarios();

//<editor-fold desc="Header">
$title = '<span class="acaoTitulo"></span>';
$tools = '<a id="f__btn_voltar"><i class="fa fa-arrow-left font-blue-steel"></i> <span class="hidden-phone font-blue-steel bold uppercase">Voltar</span></a>';
$htmlForm .= getWidgetHeader($title, $tools);
//</editor-fold>
//<editor-fold desc="Formulário">
$htmlForm .= $form->open('form', 'form-vertical form');
$htmlForm .= $form->addInput('hidden', 'acao', false, array('value' => 'ins', 'class' => 'acao'), false, false, false);
$htmlForm .= $form->addInput('date', 'anv_dat_programacao', 'Data da Vacina*', array('maxlength' => '100', 'validate' => 'required'));
$htmlForm .= $form->addSelect('vac_cod', $vacinas, '', 'Vacina*', array('validate' => 'required'), false, false, true, '', 'Selecione...');
$htmlForm .= $form->addSelect('ani_cod', $animais, '', 'Animal*', array('validate' => 'required'), false, false, true, '', 'Selecione...');
$htmlForm .= $form->addSelect('usu_cod', $usuarios, '', 'Usuario*', array('validate' => 'required'), false, false, true, '', 'Selecione...');

$htmlForm .= '<div class="form-actions">';
$htmlForm .= getBotoesAcao(true);
$htmlForm .= '</div>';
$htmlForm .= $form->close();
//</editor-fold>
$htmlForm .= getWidgetFooter();

echo $htmlForm;
?>
<script>
    $(function() {

        $('#form').submit(function() {
            var usu_int_codigo = $('#usu_int_codigo').val();
            $('#p__selecionado').val();
            if ($('#form').gValidate()) {
                var method = ($('#acao').val() == 'ins') ? 'POST' : 'PUT';
                var endpoint = ($('#acao').val() == 'ins') ? URL_API + 'vacinaAnimais' : URL_API + 'vacinaAnimais/' + usu_int_codigo;
                $.gAjax.exec(method, endpoint, $('#form').serializeArray(), false, function(json) {
                    if (json.status) {
                        showList(true);
                    }
                });
            }
            return false;
        });

        $('#f__btn_cancelar, #f__btn_voltar').click(function() {
            showList();
            return false;
        });
    });
</script>