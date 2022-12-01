<?php

require __DIR__ . '/vendor/autoload.php';
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;


if (!preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
    http_response_code(400);
    echo json_encode(["status" => "Erro", "msg" => "Bearer não enviado"]);
    exit;
    die;
}


$jwt = $matches[1];
if (!$jwt) {
    http_response_code(400);
    echo json_encode([
        "status" => "Erro",
        "msg" => "Bearer não encontrado com formato correto"
    ]);
    exit;
    die;
}



$secretKey = "chaveSecretaIFSP";

$token = null;
try {
    $token = JWT::decode($jwt, new Key($secretKey, "HS512"));
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        "status" => "Erro",
        "msg" => "Bearer inválido"
    ]);
    exit;
}