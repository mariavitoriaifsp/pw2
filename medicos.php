<?php
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once "configs/utils.php";
require_once "configs/methods.php";
require_once "model/Medico.php";
require_once "segredo.php";

if (isMetodo("GET")) {
    $resultado = Medico::listar();
    if ($resultado) {
        responder(200, $resultado);
    } else {
        $msg = ["status" => "Não conseguimos retornar a lista de medicos"];
        responder(502, $msg);
    }
    die;
}

if (isMetodo("POST")) {
    if (parametrosValidos($_POST, ["nome", "especialidade"])) {
        $resultado = Medico::cadastrar($_POST["nome"], $_POST["especialidade"]);
        if ($resultado) {
            $msg = ["status" => "Medico cadastrado com sucesso!"];
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
    if (parametrosValidos($_PUT, ["nome", "especialidade", "id"])) {
        $resultado = Medico::editar($_PUT["nome"], $_PUT["especialidade"], $_PUT["id"]);
        if ($resultado) {
            $msg = ["status" => "Medico atualizado com sucesso!"];
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
        $resultado = Medico::deletar($_DELETE["id"]);
        if ($resultado) {
            $msg = ["status" => "Medico deletado com sucesso!"];
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