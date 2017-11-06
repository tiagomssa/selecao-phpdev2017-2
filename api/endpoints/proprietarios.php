<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '_class/proprietarioDao.php';


$app->post('/proprietarios', function (Request $request, Response $response) {
    $body = $request->getParsedBody();

    $proprietario = new Proprietario();
    $proprietario->setProp_var_nome($body['prop_var_nome']);
 	$proprietario->setProp_var_email($body['prop_var_email']);
 	$proprietario->setProp_var_telefone($body['prop_var_telefone']);

    $data = ProprietarioDao::insert($proprietario);
    $code = ($data['status']) ? 201 : 500;
    if($code == 201){
        return json_encode($data);
    }
	return $response->withJson($data, $code);
});

