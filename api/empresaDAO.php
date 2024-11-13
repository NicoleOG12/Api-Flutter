<?php

include "conexao.php";

class EmpresaDAO {

    public function cadastrar(Empresa $e) {
        $sql_empresa = "INSERT INTO empresa (id_empresa, nome_empresa, endereco_empresa, telefone_empresa, email_empresa, data_criacao) 
                        VALUES (?, ?, ?, ?, ?, ?)";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $valor_empresa = $con->prepare($sql_empresa);
        $valor_empresa->bindValue(1, $e->getIdEmpresa());
        $valor_empresa->bindValue(2, $e->getNome());
        $valor_empresa->bindValue(3, $e->getEndereco());
        $valor_empresa->bindValue(4, $e->getTelefone());
        $valor_empresa->bindValue(5, $e->getEmail());
        $valor_empresa->bindValue(6, $e->getDataCriacao());

        if ($valor_empresa->execute()) {
            return "Empresa cadastrada com sucesso";
        } else {
            return "Erro ao cadastrar empresa";
        }
    }

    public function deletar(Empresa $e) {
        $sql_empresa = "DELETE FROM empresa WHERE id_empresa = ?";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $valor_empresa = $con->prepare($sql_empresa);
        $valor_empresa->bindValue(1, $e->getIdEmpresa());

        if ($valor_empresa->execute()) {
            return "Empresa deletada com sucesso";
        } else {
            return "Erro ao deletar empresa";
        }
    }

    public function atualizar(Empresa $e) {
        $sql_empresa = "UPDATE empresa SET nome_empresa=?, endereco_empresa=?, telefone_empresa=?, email_empresa=?, data_criacao=? 
                        WHERE id_empresa = ?";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $valor_empresa = $con->prepare($sql_empresa);
        $valor_empresa->bindValue(1, $e->getNome());
        $valor_empresa->bindValue(2, $e->getEndereco());
        $valor_empresa->bindValue(3, $e->getTelefone());
        $valor_empresa->bindValue(4, $e->getEmail());
        $valor_empresa->bindValue(5, $e->getDataCriacao());
        $valor_empresa->bindValue(6, $e->getIdEmpresa());

        if ($valor_empresa->execute()) {
            return "Empresa atualizada com sucesso";
        } else {
            return "Erro ao atualizar empresa";
        }
    }

    public function consultar() {
        $sql = "SELECT * FROM empresa";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $valor = $con->prepare($sql);
        $valor->execute();

        if ($valor->rowCount() > 0) {
            return $valor->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            return "Nenhuma empresa encontrada";
        }
    }
}
?>
