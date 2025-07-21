<?php include("../templates/header.php");?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-5">
    <h1 class="text-center fw-bold">SISTEMA DE RH</h1>
    <p class="text-center text-muted mb-5">Recursos Humanos</p>

    <h3 class="mb-4">Benefícios</h3>

    <div class="table-responsive">
        <table class="table table-bordered align-middle bg-white">
            <thead class="table-light">
                <tr>
                    <th>Benefício</th>
                    <th>Valor mensal (R$)</th>
                    <th>Tipo de desconto</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $result_usuario = "SELECT * FROM beneficios";
                    $resultado_usuario = oci_parse($conexao, $result_usuario);
                    oci_execute($resultado_usuario);

                    while($usuario = oci_fetch_assoc($resultado_usuario)){
                        $icone = '';
                        switch (strtolower($usuario['NOME'])){
                            case 'plano de saúde':
                                $icone = 'bi-shield-plus';
                                break;
                            case 'vale-alimentação':
                                $icone = 'bi-bag-check';
                                break;
                            case 'vale-transporte':
                                $icone = 'bi-bus-front';
                                break;
                            case 'auxílio educação':
                                $icone = 'bi-mortarboard';
                                break;
                            default:
                                $icone = 'bi-gift';
                                break;
                        }
                        echo "<tr>";
                            echo "<td><i class='bi $icone'></i> " .$usuario['NOME']. "</td>";
                            echo "<td>" .$usuario['VALOR_MENSAL'].  "</td>";
                            echo "<td>" .$usuario['TIPO_DESCONTO']. "</td>";
                        echo "</tr>"; 
                    };
                ?>
                
            </tbody>
        </table>
    </div>
</div>
<?php include("../templates/footer.php"); ?>