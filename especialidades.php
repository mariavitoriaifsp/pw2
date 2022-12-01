<?php
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once "configs/utils.php";
require_once "configs/methods.php";
require_once "model/Especialidade.php";
require_once "segredo.php";

if (isMetodo("GET")) {
    $resultado = Especialidade::listar();
    if ($resultado) {
        responder(200, $resultado);
    } else {
        $msg = ["status" => "Não conseguimos retornar a lista de especialidades"];
        responder(502, $msg);
    }
    die;
}