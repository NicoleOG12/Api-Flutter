<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header("Content-Type: application/json; charset=UTF-8");

include "usuario.php";
include "usuarioDAO.php";
include "empresa.php";
include "empresaDAO.php";

$usuario = new Usuario();
$usuarioDAO = new UsuarioDAO();
$empresa = new Empresa();
$empresaDAO = new EmpresaDAO();

//Usuario
if (isset($_GET['getUsuario'])) {
    echo json_encode($usuarioDAO->consultar());
} else if (isset($_GET['cadUsuario'])) {
    $usuario->setCpf(filter_input(INPUT_POST, 'cpf'));
    $usuario->setNome(filter_input(INPUT_POST, 'nome'));
    $usuario->setContato(filter_input(INPUT_POST, 'contato'));
    $usuario->setDataNascimento(filter_input(INPUT_POST, 'dataNascimento'));
    $usuario->setEmail(filter_input(INPUT_POST, 'email'));
    echo json_encode($usuarioDAO->cadastrar($usuario));
} else if (isset($_GET['delUsuario'])) {
    $usuario->setCpf(filter_input(INPUT_POST, 'cpf'));
    echo json_encode($usuarioDAO->deletar($usuario));
} else if (isset($_GET['atuUsuario'])) {
    $usuario->setCpf(filter_input(INPUT_POST, 'cpf'));
    $usuario->setNome(filter_input(INPUT_POST, 'nome'));
    $usuario->setContato(filter_input(INPUT_POST, 'contato'));
    $usuario->setDataNascimento(filter_input(INPUT_POST, 'dataNascimento'));
    $usuario->setEmail(filter_input(INPUT_POST, 'email'));
    echo json_encode($usuarioDAO->atualizar($usuario));

//Empresa
} else if (isset($_GET['getEmpresa'])) {
    echo json_encode($empresaDAO->consultar());
} else if (isset($_GET['cadEmpresa'])) {
    $empresa->setCnpj(filter_input(INPUT_POST, 'cnpj'));
    $empresa->setNome(filter_input(INPUT_POST, 'nome'));
    $empresa->setContato(filter_input(INPUT_POST, 'contato'));
    $empresa->setDataFundacao(filter_input(INPUT_POST, 'dataFundacao'));
    $empresa->setEmail(filter_input(INPUT_POST, 'email'));
    echo json_encode($empresaDAO->cadastrar($empresa));
} else if (isset($_GET['delEmpresa'])) {
    $empresa->setCnpj(filter_input(INPUT_POST, 'cnpj'));
    echo json_encode($empresaDAO->deletar($empresa));
} else if (isset($_GET['atuEmpresa'])) {
    $empresa->setCnpj(filter_input(INPUT_POST, 'cnpj'));
    $empresa->setNome(filter_input(INPUT_POST, 'nome'));
    $empresa->setContato(filter_input(INPUT_POST, 'contato'));
    $empresa->setDataFundacao(filter_input(INPUT_POST, 'dataFundacao'));
    $empresa->setEmail(filter_input(INPUT_POST, 'email'));
    echo json_encode($empresaDAO->atualizar($empresa));
}
?>
