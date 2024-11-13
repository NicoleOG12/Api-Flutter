<?php

class Usuario {
    private $cpf;
    private $nome;
    private $contato;
    private $dataNascimento;
    private $email;

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getCpf() {
        return $this->cpf;
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

    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }
}
