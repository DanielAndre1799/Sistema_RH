<?php
session_start();
include("../conexao.php");

$id     = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$data_saida_ferias   = filter_input(INPUT_POST, 'data_saida_ferias', FILTER_SANITIZE_SPECIAL_CHARS);
$data_retorno_ferias  = filter_input(INPUT_POST, 'data_retorno_ferias', FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "UPDATE funcionarios_rh SET data_saida_ferias = :data_saida_ferias, data_retorno_ferias = :data_retorno_ferias  WHERE id = :id";
$stmt = oci_parse($conexao, $sql);
oci_bind_by_name($stmt, ':id', $id);


oci_bind_by_name($stmt, ':data_saida_ferias', $data_saida_ferias);
oci_bind_by_name($stmt, ':data_retorno_ferias', $data_retorno_ferias);

if (oci_execute($stmt)) {
    oci_commit($conexao);
    $_SESSION['msg'] = "Funcionário salvo com sucesso!";
} else {
    $erro = oci_error($stmt);
    $_SESSION['msg'] = "Erro ao salvar: " . $erro['message'];
}

header("Location: ferias.php");
exit;
?>
