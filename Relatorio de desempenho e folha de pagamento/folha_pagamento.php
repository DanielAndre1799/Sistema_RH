<?php include("../templates/header.php");?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-5">
    <h1 class="text-center fw-bold">SISTEMA DE RH</h1>
    <p class="text-center text-muted mb-5">Recursos Humanos</p>

    <h3 class="mb-4">Folha de Pagamento</h3>

    <div class="table-responsive">
        <table class="table table-bordered align-middle bg-white">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Funcionarios</th>
                    <th>Mês</th>
                    <th>Salário Bruto</th>
                    <th>Descontos</th>
                    <th>Benefícios</th>
                    <th>Salário Líquido</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $result_usuario = "SELECT 
                                            f.id,
                                            f.nome,
                                            fp.mes_referencia,
                                            fp.salario_bruto,
                                            fp.descontos,
                                            fp.beneficios,
                                            fp.salario_liquido
                                        FROM folha_pagamento fp
                                        JOIN funcionarios_rh f ON (f.id = fp.id_funcionario) ORDER BY f.id";
                    $resultado_usuario = oci_parse($conexao, $result_usuario);
                    oci_execute($resultado_usuario);

                    while($usuario = oci_fetch_assoc($resultado_usuario)){
                        echo "<tr>";
                            echo "<td>" .$usuario['ID'].  "</td>";
                            echo "<td>" .$usuario['NOME']. "</td>";
                            echo "<td>" .$usuario['MES_REFERENCIA']. "</td>";
                            echo "<td>" .$usuario['SALARIO_BRUTO']. "</td>";
                            echo "<td>" .$usuario['DESCONTOS']. "</td>";
                            echo "<td>" .$usuario['BENEFICIOS']. "</td>";
                            echo "<td>" .$usuario['SALARIO_LIQUIDO']. "</td>";
                        echo "</tr>"; 
                    };
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php include("../templates/footer.php"); ?>