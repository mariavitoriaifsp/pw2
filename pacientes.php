<?php
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once "configs/utils.php";
require_once "configs/methods.php";
require_once "model/Paciente.php";
require_once "segredo.php";


if (isMetodo("GET")) {
    $resultado = Paciente::listar();
    if ($resultado) {
        responder(200, $resultado);
    } else {
        $msg = ["status" => "Não conseguimos retornar a lista de pacientes"];
        responder(502, $msg);
    }
    die;
}

if (isMetodo("POST")) {
    if (parametrosValidos($_POST, ["nome", "cpf"])) {
        $resultado = Paciente::cadastrar($_POST["nome"], $_POST["cpf"]);
        if ($resultado) {
            $msg = ["status" => "Paciente cadastrado com sucesso!"];
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
    if (parametrosValidos($_PUT, ["nome", "cpf", "id"])) {
        $resultado = Paciente::editar($_PUT["nome"], $_PUT["cpf"], $_PUT["id"]);
        if ($resultado) {
            $msg = ["status" => "Paciente atualizado com sucesso!"];
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
        $resultado = Paciente::deletar($_DELETE["id"]);
        if ($resultado) {
            $msg = ["status" => "Paciente deletado com sucesso!"];
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