<?php
session_start();
include("conexao.php");

$id     = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$nome   = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$cargo  = filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_SPECIAL_CHARS);
$email  = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_SPECIAL_CHARS);

if ($id) {
    // Atualizar
    $sql = "UPDATE funcionarios_RH SET nome = :nome, cargo = :cargo, email = :email, status = :status WHERE id = :id";
    $stmt = oci_parse($conexao, $sql);
    oci_bind_by_name($stmt, ':id', $id);
} else {
    // Inserir
    $sql = "INSERT INTO funcionarios_RH (nome, cargo, email, status) VALUES (:nome, :cargo, :email, :status)";
    $stmt = oci_parse($conexao, $sql);
}

oci_bind_by_name($stmt, ':nome', $nome);
oci_bind_by_name($stmt, ':cargo', $cargo);
oci_bind_by_name($stmt, ':email', $email);
oci_bind_by_name($stmt, ':status', $status);

if (oci_execute($stmt)) {
    oci_commit($conexao);
    $_SESSION['msg'] = "Funcionário salvo com sucesso!";
} else {
    $erro = oci_error($stmt);
    $_SESSION['msg'] = "Erro ao salvar: " . $erro['message'];
}

header("Location: cadastro_funcionario.php");
exit;
?>
