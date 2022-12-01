<?php

require_once __DIR__ . "/../configs/BancoDados.php";

class Especialidade
{
    public static function listar()
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT * FROM especialidades"
            );
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}