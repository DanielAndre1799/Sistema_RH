<?php 
include("templates/header.php");

?>
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">SISTEMA DE RH</h1>
        <p class="text-secondary">Recursos Humanos</p>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <i class="bi bi-person-fill display-5 text-primary mb-3"></i>
                    <h5 class="card-title">Cadastro e gerenciamento de funcionários</h5>
                    <a href="cadastro_funcionario.php" class="stretched-link"></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <i class="bi bi-clock-history display-5 text-primary mb-3"></i>
                    <h5 class="card-title">Controle de ponto, férias e benefícios</h5>
                    <a href="Controle de ponto, férias e benefícios/principal.php" class="stretched-link"></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <i class="bi bi-bar-chart-line-fill display-5 text-primary mb-3"></i>
                    <h5 class="card-title">Relatórios de desempenho e folha de pagamento</h5>
                    <a href="Relatorio de desempenho e folha de pagamento/principal.php" class="stretched-link"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("templates/footer.php"); ?>