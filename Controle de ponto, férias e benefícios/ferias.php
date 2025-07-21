<?php
include("../templates/header.php");
?>

<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-uppercase"> Férias dos Funcionários</h2>
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
                        <th>Cargo</th>
                        <th>Data da Contratação</th>
                        <th>Saída Férias</th>
                        <th>Retorno Férias</th>
                        <th>Alterar Férias</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT id, nome, cargo, data_contratacao, data_saida_ferias, data_retorno_ferias FROM funcionarios_rh ORDER BY ID ";
                    $stmt = oci_parse($conexao, $query);
                    oci_execute($stmt);

                    while ($usuario = oci_fetch_assoc($stmt)) {
                        $modalId = "modalFuncionario" . $usuario['ID'];
                        echo '
                        <tr>
                            <td>' . $usuario['ID'] . '</td>
                            <td>' . $usuario['NOME'] . '</td>
                            <td>' . $usuario['CARGO'] . '</td>
                            <td>' . $usuario['DATA_CONTRATACAO'] . '</td>
                            <td>' . $usuario['DATA_SAIDA_FERIAS'] . '</td>
                            <td>' . $usuario['DATA_RETORNO_FERIAS'] . '</td>
                            <td><button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#' . $modalId . '"> Detalhes </button></td>
                        </tr>

                        <!-- Modal de Edição -->
                        <div class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="' . $modalId . 'Label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form method="POST" action="processa_ferias.php">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="' . $modalId . 'Label">Editar Funcionário</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="' . $usuario['ID'] . '">
                                            <div class="mb-3">
                                                <label>Nome:</label>
                                                <input type="text" name="nome" class="form-control" value="' . $usuario['NOME'] . '" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>SAÍDA FÉRIAS:</label>
                                                <input type="text" name="data_saida_ferias" class="form-control" value="' . $usuario['DATA_SAIDA_FERIAS'] . '" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>RETORNO FÉRIAS:</label>
                                                <input type="text" name="data_retorno_ferias" class="form-control" value="' . $usuario['DATA_RETORNO_FERIAS'] . '" required>
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