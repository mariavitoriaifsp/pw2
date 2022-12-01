<?php
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once "configs/utils.php";
require_once "configs/methods.php";
require_once "model/Consulta.php";
require_once "segredo.php";

if (isMetodo("GET")) {
    $resultado = Consulta::listar();
    if ($resultado) {
        responder(200, $resultado);
    } else {
        $msg = ["status" => "Não conseguimos retornar a lista de consultas"];
        responder(502, $msg);
    }
    die;
}

if (isMetodo("POST")) {
    if (parametrosValidos($_POST, ["data", "medico", "paciente"])) {
        $resultado = Consulta::cadastrar($_POST["data"], $_POST["medico"], $_POST["paciente"]);
        if ($resultado) {
            $msg = ["status" => "Consulta cadastrada com sucesso!"];
            responder(200, $msg);
        } else {
            $msg = ["status" => "Erro no cadastro, tente novamente!"];
            responder(502, $resultado);
        }
    } else {
        $msg = ["status" => "Problema na requisição, verifique se não esqueceu nenhum parâmetro!"];
        responder(400, $resultado);
    }
    die;
}

if (isMetodo("PUT")) {
    if (parametrosValidos($_PUT, ["data", "medico", "paciente", "id"])) {
        $resultado = Consulta::editar($_PUT["data"], $_PUT["medico"], $_PUT["paciente"], $_PUT["id"]);
        if ($resultado) {
            $msg = ["status" => "Consulta atualizada com sucesso!"];
            responder(200, $msg);
        } else {
            $msg = ["status" => "Erro ao atualizar, tente novamente!"];
            responder(502, $resultado);
        }
    } else {
        $msg = ["status" => "Problema na requisição, verifique se não esqueceu nenhum parâmetro!"];
        responder(400, $resultado);
    }
    die;
}

if (isMetodo("DELETE")) {
    if (parametrosValidos($_DELETE, ["id"])) {
        $resultado = Consulta::deletar($_DELETE["id"]);
        if ($resultado) {
            $msg = ["status" => "Consulta deletada com sucesso!"];
            responder(200, $msg);
        } else {
            $msg = ["status" => "Erro ao deletar, tente novamente!"];
            responder(502, $resultado);
        }
    } else {
        $msg = ["status" => "Problema na requisição, verifique se não esqueceu nenhum parâmetro!"];
        responder(400, $resultado);
    }
    die;
}