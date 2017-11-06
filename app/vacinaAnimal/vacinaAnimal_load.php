<?php

require_once("../_inc/global.php");

$html = '';
$mysql = new GDbMysql();
$form = new GForm();
//------------------------------ Parâmetros ----------------------------------//
$type = $_POST['type'];
$page = $_POST['page'];
$count = $_POST['count'];
$rp = (int) $_POST['rp'];
$start = (($page - 1) * $rp);

function formatDate($date){
    $array = explode('-', $date);
    return $array[2].'/'.$array[1].'/'.$array[0];
}

function formatDateTime($date){
    $array = explode(' ', $date);
    $arrayDate = explode('-', $array[0]);
    return $arrayDate[2].'/'.$arrayDate[1].'/'.$arrayDate[0]. " ". $array[1];
}

try {
    if ($type == 'C') {
        $query = "SELECT count(1) FROM animal_vacina";
        $mysql->execute($query, false);
        if ($mysql->fetch()) {
            $count = ceil($mysql->res[0] / $rp);
        }
        $count = $count == 0 ? 1 : $count;
        echo json_encode(array('count' => $count));
    } else if ($type == 'R') {

        $query = "SELECT anv.anv_int_codigo, anv.ani_int_codigo, 
        anv.vac_int_codigo, anv.anv_dat_programacao, anv.anv_dti_aplicacao, 
        anv.usu_int_codigo, u.usu_var_nome, a.ani_var_nome, v.vac_var_nome
           FROM animal_vacina anv
           INNER JOIN usuario u 
               ON u.usu_int_codigo = anv.usu_int_codigo
           INNER JOIN animal a 
               ON a.ani_int_codigo = anv.ani_int_codigo
           INNER JOIN vacina v 
               ON v.vac_int_codigo = anv.vac_int_codigo;";

        $mysql->execute($query);

        if ($mysql->numRows() > 0) {
            $html .= '<table class="table table-striped table-hover">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Usuario</th>';
            $html .= '<th>Animal</th>';
            $html .= '<th>Vacina</th>';
            $html .= '<th>Data da Vacina</th>';
            $html .= '<th>Aplicacao</th>';
            $html .= '<th class="__acenter hidden-phone" width="100px">Actions</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            while ($mysql->fetch()) {
                if($mysql->res['anv_dti_aplicacao'] != null){
                    $mysql->res['anv_dti_aplicacao'] = formatDateTime($mysql->res['anv_dti_aplicacao']);
                }
                $class = ($_POST['p__selecionado'] == $mysql->res['usu_int_codigo']) ? 'success' : '';
                $html .= '<tr id="' . $mysql->res['anv_int_codigo'] . '" class="linhaRegistro ' . $class . '">';
                $html .= '<td>' . $mysql->res['usu_var_nome'] . '</td>';
                $html .= '<td>' . $mysql->res['ani_var_nome'] . '</td>';
                $html .= '<td>' . $mysql->res['vac_var_nome'] . '</td>';
                $html .= '<td>' . formatDate($mysql->res['anv_dat_programacao']). '</td>';
                $html .= '<td>' . $mysql->res['anv_dti_aplicacao']. '</td>';
                //<editor-fold desc="Actions">
                    $html .= '<td class="__acenter hidden-phone acoes">';
                    $html .= $form->addButton('l__btn_editar', '<i class="fa fa-eyedropper"></i>', array('class' => 'btn btn-small btn-icon-only l__btn_editar', 'title' => 'Vacinar'));
                    $html .= '</td>';
                //</editor-fold>
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
        } else {
            $html .= '<div class="nenhumResultado">Nenhum resultado encontrado.</div>';
        }

        echo $html;
    }
} catch (GDbException $exc) {
    echo $exc->getError();
}
?>