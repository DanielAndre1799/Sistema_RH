<?php
include("templates/header.php");
?>

<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-uppercase">Cadastro e gerenciamento de funcionários</h2>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNovoFuncionario">
                    <i class="bi bi-plus-lg"></i> Adicionar Funcionário
                </button>
            </div>

            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Cargo</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM funcionarios_RH ORDER BY ID";
                    $stmt = oci_parse($conexao, $query);
                    oci_execute($stmt);

                    while ($usuario = oci_fetch_assoc($stmt)) {
                        $modalId = "modalFuncionario" . $usuario['ID'];
                        echo '
                        <tr>
                            <td>' . $usuario['ID'] . '</td>
                            <td>' . $usuario['NOME'] . '</td>
                            <td>' . $usuario['CARGO'] . '</td>
                            <td>' . $usuario['EMAIL'] . '</td>
                            <td>' . $usuario['STATUS'] . '</td>
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
                                    <form method="POST" action="processa.php">
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
                                                <label>Cargo:</label>
                                                <input type="text" name="cargo" class="form-control" value="' . $usuario['CARGO'] . '" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Email:</label>
                                                <input type="email" name="email" class="form-control" value="' . $usuario['EMAIL'] . '" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Status:</label>
                                                <select name="status" class="form-select" required>
                                                    <option value="Ativo" ' . ($usuario['STATUS'] == 'Ativo' ? 'selected' : '') . '>Ativo</option>
                                                    <option value="Inativo" ' . ($usuario['STATUS'] == 'Inativo' ? 'selected' : '') . '>Inativo</option>
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

<!-- Modal de Novo Funcionário -->
<div class="modal fade" id="modalNovoFuncionario" tabindex="-1" aria-labelledby="modalNovoFuncionarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="processar.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalNovoFuncionarioLabel">Adicionar Novo Funcionário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nome:</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Cargo:</label>
                        <input type="text" name="cargo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Status:</label>
                        <select name="status" class="form-select" required>
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("templates/footer.php"); ?>
