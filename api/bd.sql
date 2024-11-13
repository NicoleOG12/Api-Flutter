CREATE DATABASE cadastro;
USE cadastro;

CREATE TABLE Usuario (
  cpf CHAR(14) PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  contato CHAR(11),
  dataNascimento CHAR(8),
  email CHAR(50)
);

CREATE TABLE Empresa (
  cnpj CHAR(14) PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  contato CHAR(11),
  dataFundacao CHAR(8),
  email CHAR(50)
);
