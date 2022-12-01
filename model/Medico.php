<?php

require_once __DIR__ . "/../configs/BancoDados.php";

class Medico
{
    public static function cadastrar($nome, $especialidade)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "INSERT INTO medicos (nome, especialidade) VALUES (?,?)"
            );
            $stmt->execute([$nome, $especialidade]);

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

    public static function listar()
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT * FROM medicos"
            );
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function deletar($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "DELETE FROM medicos WHERE idMedico = ?"
            );
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {

            echo $e->getMessage();
            exit;
            // return false;
        }
    }

    public static function editar($nome, $especialidade, $id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "UPDATE medicos SET nome = ?, especialidade = ? WHERE idMedico = ?"
            );
            $stmt->execute([$nome, $especialidade, $id]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

}