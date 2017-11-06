<?php
require_once '../_inc/global.php';

$form = new GForm();

$header = new GHeader('Proprietarios');
$header->show(false, 'proprietario/proprietario.php');
// ---------------------------------- Header ---------------------------------//


$html .= '<div id="divTable" class="row">';
$html .= getWidgetHeader();

$html .= getBotaoAdicionar();
$html .= $form->close();
//</editor-fold>
//Carregar proprietarios
try {
    $mysql = new GDbMysql();
    $query = "SELECT prop_int_codigo, prop_var_nome, prop_var_email, prop_var_telefone FROM proprietario ";
    $con = $mysql->link;
    $retorno = $con->query($query);

    if ($retorno->field_count > 0) {
        $html .= '<table class="table table-striped table-hover">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>Nome</th>';
        $html .= '<th>Email</th>';
        $html .= '<th>Telefone</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        while ($registro = $retorno->fetch_array()) {
            $class = ($_POST['p__selecionado'] == $mysql->res['ani_int_codigo']) ? 'success' : '';
            $html .= '<tr id="' . $registro['ani_int_codigo'] . '" class="linhaRegistro ' . $class . '">';
            $html .= '<td>' . $registro['prop_var_nome'] . '</td>';
            $html .= '<td>' . $registro['prop_var_email'] . '</td>';
            $html .= '<td>' . $registro['prop_var_telefone'] . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        } else {
            $html .= '<div class="nenhumResultado">Nenhum resultado encontrado.</div>';
        }
} catch (GDbException $exc) {
    echo $exc->getError();
}
$html .= '</div>'; //divTable
$html .= getWidgetFooter();
echo $html;

echo '<div id="divForm" class="row divForm">';
include 'proprietario_form.php';
echo '</div>';

// ---------------------------------- Footer ---------------------------------//
$footer = new GFooter();
$footer->show();
?>
<script>

    $(function() {
        $(document).on('click', '#p__btn_adicionar', function() {
            scrollTop();
            unselectLines();

            showForm('divForm', 'ins', 'Adicionar');
        });
    });
</script>