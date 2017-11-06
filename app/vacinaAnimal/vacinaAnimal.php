<?php
require_once '../_inc/global.php';

$form = new GForm();

$header = new GHeader('Agendar vacina e aplicar vacina');
$header->addLib(array('paginate'));
$header->show(false, 'vacinaAnimal/vacinaAnimal.php');
// ---------------------------------- Header ---------------------------------//


$html .= '<div id="divTable" class="row">';
$html .= getWidgetHeader();

$html .= getBotaoAgendarVacina();

$paginate = new GPaginate('vacinaAnimal', 'vacinaAnimal_load.php', SYS_PAGINACAO);
$html .= $paginate->get();
$html .= '</div>'; //divTable
$html .= getWidgetFooter();
echo $html;

echo '<div id="divForm" class="row divForm">';
include 'vacinaAnimal_form.php';
echo '</div>';

// ---------------------------------- Footer ---------------------------------//
$footer = new GFooter();
$footer->show();
?>
<script>
    var pagCrud = 'vacinaAnimal_crud.php';
    var pagView = 'vacinaAnimal_view.php';
    var pagLoad = 'vacinaAnimal_load.php';

    function filtrar(page) {
        vacinaAnimalLoad('', '', '', $('#filter').serializeObject(), page);
        return false;
    }

    $(function() {
        filtrar(1);
        $('#filter select').change(function() {
            filtrar(1);
            return false;
        });
        $('#filter').submit(function() {
            filtrar(1);
            return false;
        });
        $('#p__btn_limpar').click(function() {
            clearForm('#filter');
            filtrar(1);
        });
        $(document).on('click', '#p__btn_adicionar', function() {
            scrollTop();
            unselectLines();

            showForm('divForm', 'ins', 'Adicionar');
        });
        $(document).on('click', '.l__btn_editar, tr.linhaRegistro td:not([class~="acoes"])', function() {
            var anv_int_codigo = $(this).parents('tr.linhaRegistro').attr('id');

            scrollTop();
            selectLine(anv_int_codigo);
            $.ajax({
                url: 'http://localhost/selecao-phpdev2017-2/api/vacinaAnimais/'+anv_int_codigo,
                type: 'PUT',
                data: "name=John&location=Boston",
                success: function(data) {
                    if(data.status){
                        alert(data.msg);
                        location.reload();
                    } 
                    else
                        alert(data.msg);
                    }
            });
        });
    });
</script>