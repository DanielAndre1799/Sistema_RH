<?php include("../templates/header.php");
$result_usuario = "SELECT id, nome FROM funcionarios_RH WHERE status = 'Ativo'";
$resultado_usuario = oci_parse($conexao, $result_usuario);
oci_execute($resultado_usuario);

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<div class="container my-5">
    <h3 class="mb-4 text-center">Controle de Ponto</h3>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow text-center h-100 rounded-4 p-3">
                <h5 class="card-title mb-3">Funcionários Ativos</h5> 
                <form method="post" action="salvar_ponto.php">
                    <div class="mb-3 text-start">
                        <select name="id_funcionario" class="form-select" required>
                            <option>Selecione um funcionário</option>
                                <?php 
                                    while($usuario = oci_fetch_assoc($resultado_usuario)){
                                       echo '<option value="' . $usuario['ID'] . '">' . $usuario['NOME'] . ' - Id: ' . $usuario['ID'] . '</option>';
                                    }
                                ?>
                        </select>
                    </div>
                    <?php
                        $campos = [
                            'entrada' => 'Entrada:',
                            'saida_almoco' => 'Saída Almoço:',
                            'volta_almoco' => 'Volta Almoço:',
                            'saida' => 'Saída:'
                        ];
                        foreach ($campos as $name => $label): ?>
                            <div class="row align-items-center mb-2 gx-2">
                                <div class="col-4 text-start">
                                    <label class="form-label mb-0 small"><?= $label ?></label>
                                </div>
                                <div class="col-4">
                                    <input type="time" class="form-control form-control-sm" name="<?= $name ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <button type="submit" class="btn btn-primary w-100 btn-sm mt-3">Salvar Ponto</button>
                </form>

                <!-- Botão que abre o modal -->
                <button type="button" class="btn btn-secondary w-100 btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#modalPonto">
                    Mostrar Ponto
                </button>

            </div>
        </div>
    </div>
</div>

<!-- Modal Bootstrap -->
<div class="modal fade" id="modalPonto" tabindex="-1" aria-labelledby="modalPontoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPontoLabel">Ponto do Funcionário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
        <div class="modal-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Data_Registro</th>
                        <th>Entrada</th>
                        <th>Saída_Almoço</th>
                        <th>Volta_Almoço</th>
                        <th>Saída</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $result_usuario = " SELECT 
                                                f.id,
                                                f.nome,
                                                fp.data_registre,
                                                LPAD(SUBSTR(TO_CHAR(fp.entrada, 'FM0000'), 1, 2), 2, '0') || ':' || 
                                                SUBSTR(TO_CHAR(fp.entrada, 'FM0000'), 3, 2) AS entrada,
                                                LPAD(SUBSTR(TO_CHAR(fp.saida_almoco, 'FM0000'), 1, 2), 2, '0') || ':' || 
                                                SUBSTR(TO_CHAR(fp.saida_almoco, 'FM0000'), 3, 2) AS saida_almoco,
                                                LPAD(SUBSTR(TO_CHAR(fp.volta_almoco, 'FM0000'), 1, 2), 2, '0') || ':' || 
                                                SUBSTR(TO_CHAR(fp.volta_almoco, 'FM0000'), 3, 2) AS volta_almoco,
                                                LPAD(SUBSTR(TO_CHAR(fp.saida, 'FM0000'), 1, 2), 2, '0') || ':' || 
                                                SUBSTR(TO_CHAR(fp.saida, 'FM0000'), 3, 2) AS saida
                                            FROM controle_ponto fp
                                            JOIN funcionarios_rh f ON f.id = fp.id_funcionario ORDER BY f.id
                                            ";
                        $resultado_usuario = oci_parse($conexao, $result_usuario);
                        oci_execute($resultado_usuario);
                        while($usuario = oci_fetch_assoc($resultado_usuario)){
                                echo "<tr>";
                                    echo "<td>" .$usuario['ID'].  "</td>";
                                    echo "<td>" .$usuario['NOME']. "</td>";
                                    echo "<td>" .$usuario['DATA_REGISTRE']. "</td>";
                                    echo "<td>" .$usuario['ENTRADA']. "</td>";
                                    echo "<td>" .$usuario['VOLTA_ALMOCO']. "</td>";
                                    echo "<td>" .$usuario['SAIDA_ALMOCO']. "</td>";
                                    echo "<td>" .$usuario['SAIDA']. "</td>";
                                echo "</tr>"; 
                            };
                    ?>
                </tbody>
            </table>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<?php include("../templates/footer.php"); ?>
