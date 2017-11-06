<?php 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '_class/animalVacinaDao.php';

$app->get('/vacinaAnimais/{aniv_int_codigo}', function (Request $request, Response $response) {
    $aniv_int_codigo = $request->getAttribute('aniv_int_codigo');
    
    $animalVacina = new AnimalVacina();
    $animalVacina->setAnv_int_codigo($aniv_int_codigo);

    $data = AnimalVacinaDao::selectByIdForm($usuario);
    $code = count($data) > 0 ? 200 : 404;
    if ($code == 200)
    {
        return json_encode($data);
    }
	return $response->withJson($data, $code);
});

$app->post('/vacinaAnimais', function (Request $request, Response $response) {
    $body = $request->getParsedBody();

    $animalVacina = new AnimalVacina();
    $animalVacina->setAnimalCod($body['ani_cod']);
    $animalVacina->setVacinaCod($body['vac_cod']);
    $animalVacina->setAnv_dat_programacao($body['anv_dat_programacao']);
    $animalVacina->setUsuarioCod($body['usu_cod']);

    $data = AnimalVacinaDao::insert($animalVacina);
    $code = ($data['status']) ? 201 : 500;

	return $response->withJson($data, $code);
});

$app->put('/vacinaAnimais/{anv_int_codigo}', function (Request $request, Response $response) {
    $body = $request->getParsedBody();
	$anv_int_codigo = $request->getAttribute('anv_int_codigo');
    
    $animalVacina = new AnimalVacina();
    $animalVacina->setAnv_int_codigo($anv_int_codigo);


    $data = AnimalVacinaDao::update($animalVacina);
    $code = ($data['status']) ? 200 : 203;
    
	return $response->withJson($data, $code);
});

