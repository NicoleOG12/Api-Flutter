<?php

class Empresa {
    private $cnpj;
    private $nome;
    private $contato;
    private $dataFundacao;
    private $email;

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setContato($contato) {
        $this->contato = $contato;
    }

    public function getContato() {
        return $this->contato;
    }

    public function setDataFundacao($dataFundacao) {
        $this->dataFundacao = $dataFundacao;
    }

    public function getDataFundacao() {
        return $this->dataFundacao;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }
}
?>
