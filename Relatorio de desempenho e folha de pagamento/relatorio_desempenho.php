<?php
include("../templates/header.php");
?>

<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-uppercase">Relatório de Desempenho</h2>
    </div>

    <?php
        if (isset($_SESSION['msg'])) {
            echo '<div class="alert alert-info">' . $_SESSION['msg'] . '</div>';
            unset($_SESSION['msg']);
        }
    ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-person-circle fs-2 text-primary"></i>
                    <span class="fs-5 fw-medium">Funcionários</span>
                </div>
            </div>

            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Périodo</th>
                        <th>Nota_Média</th>
                        <th>Metas_atingidas</th>
                        <th>Feedback</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "  SELECT 
                                    f.id,
                                    f.nome,
                                    rd.id_funcionario,
                                    rd.periodo,
                                    rd.nota_media,
                                    rd.metas_atingidas,
                                    rd.feedback_id
                                FROM relatorio_desempenho rd
                                    JOIN funcionarios_rh f ON (f.id = rd.id_funcionario) ORDER BY f.id";
                    $stmt = oci_parse($conexao, $query);
                    oci_execute($stmt);

                    while ($usuario = oci_fetch_assoc($stmt)) {
                        $modalId = "modalFuncionario" . $usuario['ID'];
                        echo '
                        <tr>
                            <td>' . $usuario['ID_FUNCIONARIO'] . '</td>
                            <td>' . $usuario['NOME'] . '</td>
                            <td>' . $usuario['PERIODO'] . '</td>
                            <td>' . $usuario['NOTA_MEDIA'] . '</td>
                            <td>' . $usuario['METAS_ATINGIDAS'] . '</td>
                            <td>' . $usuario['FEEDBACK_ID'] . '</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#' . $modalId . '">
                                    Detalhes
                                </button>
                            </td>
                        </tr>

                        <!-- Modal de Edição -->
                        <div class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="' . $modalId . 'Label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form method="POST" action="processa_relatorio.php">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="' . $modalId . 'Label">Editar Funcionário</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id_funcionario" value="' . $usuario['ID_FUNCIONARIO'] . '">
                                            <div class="mb-3">
                                                <label>Nome:</label>
                                                <input type="text" name="periodo" class="form-control" value="' . $usuario['PERIODO'] . '" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Cargo:</label>
                                                <input type="text" name="nota_media" class="form-control" value="' . $usuario['NOTA_MEDIA'] . '" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Email:</label>
                                                <input type="text" name="metas_atingidas" class="form-control" value="' . $usuario['METAS_ATINGIDAS'] . '" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Status:</label>
                                                <select name="feedback" class="form-select" required>
                                                    <option value="Positivo" ' . ($usuario['FEEDBACK_ID'] == 'Positivo' ? 'selected' : '') . '>Positivo</option>
                                                    <option value="Negativo" ' . ($usuario['FEEDBACK_ID'] == 'Negativo' ? 'selected' : '') . '>Negativo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-primary">Atualizar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include("../templates/footer.php"); ?>