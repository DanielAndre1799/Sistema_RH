<?php include("../templates/header.php"); ?>
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">SISTEMA DE RH</h1>
        <p class="text-secondary">Recursos Humanos</p>
    </div>
    <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-md-6">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Relatório de Desempenho</h5>
                    <a href="../Relatorio de desempenho e folha de pagamento/relatorio_desempenho.php" class="stretched-link"></a>
                </div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-6">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <i class="fas fa-umbrella-beach fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Folha de Pagamentos</h5>
                    <a href="../Relatorio de desempenho e folha de pagamento/folha_pagamento.php"class="stretched-link"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("../templates/footer.php"); ?>