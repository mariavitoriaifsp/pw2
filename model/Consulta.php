<?php

require_once __DIR__ . "/../configs/BancoDados.php";

class Consulta
{
    public static function cadastrar($data, $medico, $paciente)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "INSERT INTO consultas (data, idMedico, idPaciente) VALUES (?,?,?)"
            );
            $stmt->execute([$data, $medico, $paciente]);

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
                "SELECT * FROM consultas"
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
                "DELETE FROM consultas WHERE idConsulta = ?"
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

    public static function editar($data, $medico, $paciente, $id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "UPDATE consultas  SET data = ?, idMedico = ?, idPaciente = ? WHERE idConsulta = ?"
            );
            $stmt->execute([$data, $medico, $paciente, $id]);

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
