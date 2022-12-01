<?php

require_once __DIR__ . "/../configs/BancoDados.php";

class Paciente
{
    public static function cadastrar($nome, $cpf)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "INSERT INTO pacientes (nome, cpf) VALUES (?,?)"
            );
            $stmt->execute([$nome, $cpf]);

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
                "SELECT * FROM pacientes"
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
                "DELETE FROM pacientes WHERE idPaciente = ?"
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

    public static function editar($nome, $cpf, $id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "UPDATE pacientes SET nome = ?, cpf = ? WHERE idPaciente = ?"
            );
            $stmt->execute([$nome, $cpf, $id]);

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