<?php
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Methods: POST, PUT");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once "configs/utils.php";
require_once "configs/methods.php";
require_once "model/Administrador.php";

require __DIR__ . '/vendor/autoload.php';

function encryptPass($pass) {
    return password_hash($pass, PASSWORD_BCRYPT, ["cost" => 11]);
}

use \Firebase\JWT\JWT;



if (isMetodo("PUT")) {
    if (parametrosValidos($_PUT, ["login", "password"])) {
        $resultado = Administrador::cadastrar($_PUT["login"], encryptPass($_PUT["password"]));
        if ($resultado) {
            $msg = ["status" => "Administrador cadastrado com sucesso!"];
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

if (isMetodo("POST")) {
    if (parametrosValidos($_POST, ["login", "password"])) {
        $resultado = Administrador::validar($_POST["login"]);
        if ($resultado) {
            $validarSenha = password_verify($_POST["password"], $resultado['password']);
            if($validarSenha){


                $chaveSecreta = "chaveSecretaIFSP";
                $agora = new DateTimeImmutable();
                $validade = $agora->modify("+10 minutes")->getTimestamp();
                $servidor = "teste.com";

                $dados_token = [
                    "iat" => $agora->getTimestamp(),
                    "iss" => $servidor,
                    "nbf" => $agora->getTimestamp(),
                    "exp" => $validade,
                    "sub" => $_POST["login"]
                ];

                $token = JWT::encode($dados_token, $chaveSecreta, 'HS512');

                $msg = ["tokenJWT" => $token];    
                responder(200, $msg);
            }
            else {
                $msg = ["status" => "Administrador com senha invalida!"];
                responder(403, $msg);                
            }
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