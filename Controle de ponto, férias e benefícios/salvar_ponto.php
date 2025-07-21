<?php
session_start();
include("../conexao.php");

$id_funcionario = filter_input(INPUT_POST, 'id_funcionario', FILTER_SANITIZE_NUMBER_INT);
$entrada        = filter_input(INPUT_POST, 'entrada', FILTER_SANITIZE_NUMBER_INT);
$saida_almoco   = filter_input(INPUT_POST, 'saida_almoco', FILTER_SANITIZE_NUMBER_INT);
$volta_almoco   = filter_input(INPUT_POST, 'volta_almoco', FILTER_SANITIZE_NUMBER_INT);
$saida          = filter_input(INPUT_POST, 'saida', FILTER_SANITIZE_NUMBER_INT);

$sql = "INSERT INTO controle_ponto (id_funcionario, entrada, saida_almoco, volta_almoco, saida)
        VALUES (:id_funcionario, :entrada, :saida_almoco, :volta_almoco, :saida)";
        
$stmt = oci_parse($conexao, $sql);

oci_bind_by_name($stmt, ':id_funcionario', $id_funcionario);
oci_bind_by_name($stmt, ':entrada', $entrada);
oci_bind_by_name($stmt, ':saida_almoco', $saida_almoco);
oci_bind_by_name($stmt, ':volta_almoco', $volta_almoco);
oci_bind_by_name($stmt, ':saida', $saida);

$executado = oci_execute($stmt);

if ($executado) {
    $_SESSION['msg'] = "<p style='color: green;'>Ponto cadastrado com sucesso!</p>";
} else {
    $erro = oci_error($stmt);
    $_SESSION['msg'] = "<p style='color: red;'>Erro ao salvar ponto: " . $erro['message'] . "</p>";
}

header("Location: controle_ponto.php");
exit;
?>
