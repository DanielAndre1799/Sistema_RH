<?php
session_start();
include("../conexao.php");

$id_funcionario     = filter_input(INPUT_POST, 'id_funcionario', FILTER_SANITIZE_NUMBER_INT);
$periodo   = filter_input(INPUT_POST, 'periodo', FILTER_SANITIZE_SPECIAL_CHARS);
$nota_media  = filter_input(INPUT_POST, 'nota_media', FILTER_SANITIZE_SPECIAL_CHARS);
$metas_atingidas  = filter_input(INPUT_POST, 'metas_atingidas', FILTER_SANITIZE_SPECIAL_CHARS);
$feedback = filter_input(INPUT_POST, 'feedback', FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "UPDATE relatorio_desempenho SET periodo = :periodo, nota_media = :nota_media, metas_atingidas = :metas_atingidas, feedback_id = :feedback WHERE id_funcionario = :id_funcionario";
$stmt = oci_parse($conexao, $sql);

oci_bind_by_name($stmt, ':id_funcionario', $id_funcionario);
oci_bind_by_name($stmt, ':periodo', $periodo);
oci_bind_by_name($stmt, ':nota_media', $nota_media);
oci_bind_by_name($stmt, ':metas_atingidas', $metas_atingidas);
oci_bind_by_name($stmt, ':feedback', $feedback);

if (oci_execute($stmt)) {
    oci_commit($conexao);
    $_SESSION['msg'] = "Funcionário atualizado com sucesso!";
} else {
    $erro = oci_error($stmt);
    $_SESSION['msg'] = "Erro ao salvar: " . $erro['message'];
}

header("Location: relatorio_desempenho.php");
exit;
?>
