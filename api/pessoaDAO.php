<?php

include "conexao.php";

class UsuarioDAO {

    public function cadastrar(Usuario $u) {
        $sql_usuario = "INSERT INTO usuario (cpf_usuario, nome_usuario, telefone_usuario, email_usuario, data_nascimento) 
                        VALUES (?, ?, ?, ?, ?)";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $valor_usuario = $con->prepare($sql_usuario);
        $valor_usuario->bindValue(1, $u->getCpf());
        $valor_usuario->bindValue(2, $u->getNome());
        $valor_usuario->bindValue(3, $u->getTelefone());
        $valor_usuario->bindValue(4, $u->getEmail());
        $valor_usuario->bindValue(5, $u->getDataNascimento());

        if ($valor_usuario->execute()) {
            return "Usuário cadastrado com sucesso";
        } else {
            return "Erro ao cadastrar usuário";
        }
    }

    public function deletar(Usuario $u) {
        $sql_usuario = "DELETE FROM usuario WHERE cpf_usuario = ?";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $valor_usuario = $con->prepare($sql_usuario);
        $valor_usuario->bindValue(1, $u->getCpf());

        if ($valor_usuario->execute()) {
            return "Usuário deletado com sucesso";
        } else {
            return "Erro ao deletar usuário";
        }
    }

    public function atualizar(Usuario $u) {
        $sql_usuario = "UPDATE usuario SET nome_usuario=?, telefone_usuario=?, email_usuario=?, data_nascimento=? 
                        WHERE cpf_usuario = ?";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $valor_usuario = $con->prepare($sql_usuario);
        $valor_usuario->bindValue(1, $u->getNome());
        $valor_usuario->bindValue(2, $u->getTelefone());
        $valor_usuario->bindValue(3, $u->getEmail());
        $valor_usuario->bindValue(4, $u->getDataNascimento());
        $valor_usuario->bindValue(5, $u->getCpf());

        if ($valor_usuario->execute()) {
            return "Usuário atualizado com sucesso";
        } else {
            return "Erro ao atualizar usuário";
        }
    }

    public function consultar() {
        $sql = "SELECT * FROM usuario";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $valor = $con->prepare($sql);
        $valor->execute();

        if ($valor->rowCount() > 0) {
            return $valor->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            return "Nenhum usuário encontrado";
        }
    }
}
?>
