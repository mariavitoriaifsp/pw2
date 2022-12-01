<?php

require_once __DIR__ . "/../configs/BancoDados.php";

class Administrador
{
    public static function cadastrar($login, $password)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "INSERT INTO administradores (login, password) VALUES (?,?)"
            );
            $stmt->execute([$login, $password]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function validar($password)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT password FROM administradores WHERE login = ?"
            );
            $stmt->execute([$password]);

            if ($stmt->rowCount() > 0) {
                return $stmt->fetch();
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}