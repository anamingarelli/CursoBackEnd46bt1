<?php
// aplicação de página unica de variaveis superglobais ($_POST, $_SERVER)
declare(strict_types=1);

//Declarar Variáveis de Controle (Padrão das suas atividades)
$mensagemSucesso = "";
$erro = [];

$valorVeiculoTexto = "";
$valorEntradaTexto = "";
$numParcelasTexto = "";
$opcoesParcelas = "";

// opções permitidas para o número de parcelas (Requisito)
$opcoesParcelas = [12, 24, 36, 48, 60];

// variáveis para a memória de cálculo
$valorFinanciado = 0.0;
$totalJuros = 0.0;
$valorParcela = 0.0;

//Processamento do POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //Recuperar os Dados do Formulário
    $valorVeiculoTexto = trim((string) ($_POST["valor_veiculo"] ?? ""));
    $valorEntradaTexto = trim((string) ($_POST["valor_entrada"] ?? ""));
    $numParcelasTexto = trim((string) ($_POST["numero_parcelas"] ?? ""));

    // Validações dos valores numéricos
    $valorVeiculo = filter_var($valorVeiculoTexto, FILTER_VALIDATE_FLOAT);
    if ($valorVeiculo === false || $valorVeiculo <= 0) {
        $erro["valor_veiculo"] = "Informe um valor de veículo válido e maior que zero";
    }

    $valorEntrada = filter_var($valorEntradaTexto, FILTER_VALIDATE_FLOAT);
    if ($valorEntrada === false || $valorEntrada < 0) {
        $erro["valor_entrada"] = "Informe um valor de entrada válido";
    }

    $numeroParcelas = filter_var($numParcelasTexto, FILTER_VALIDATE_INT);
    // Requisito: O número de parcelas deve ser uma das opções permitidas no select
    if ($numeroParcelas === false || !in_array($numeroParcelas, $opcoesParcelas, true)) {
        $erro["numero_parcelas"] = "Selecione uma quantidade de parcelas válida";
    }

    // REQUISITO: A entrada deve ser de pelo menos 20% do valor total do veículo
    if ($valorVeiculo !== false && $valorEntrada !== false && $erro === []) {
        $entradaMinima = $valorVeiculo * 0.20;
        if ($valorEntrada < $entradaMinima) {
            $erro["valor_entrada"] = "A entrada deve ser de pelo menos 20% do valor do veículo (R$ " . number_format($entradaMinima, 2, ',', '.') . ")";
        }
    }

    // se não existir erros, realiza o cálculo de negócio
    if ($erro === []) {
        // Regra de Negócio: Saldo financiado
        $valorFinanciado = $valorVeiculo - $valorEntrada;
        
        // regra de negócio: Juros Simples de 1.5% ao mês sobre o saldo financiado -> se fosse composto usaria um laço de repetição (FOR)
        $taxaJurosMensal = 0.015; 
        $totalJuros = $valorFinanciado * $taxaJurosMensal * $numeroParcelas;
        
        // Montante total com juros dividido pelo número de parcelas
        $montanteTotal = $valorFinanciado + $totalJuros;
        $valorParcela = $montanteTotal / $numeroParcelas;

        $mensagemSucesso = "Simulação realizada com sucesso!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financiamento Automotivo</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <h1>Simulador de Financiamento</h1>

        <section>
            <h2>Dados da Simulação</h2>
            <p>Insira os valores abaixo para calcular as parcelas do veículo</p>

            <!-- REQUISITO: Exibição da memória de cálculo formatada em Real (R$) -->
            <?php if ($mensagemSucesso !== "") : ?>
                <div class="sucesso" style="background: #f8f5c4; color: #000000; padding: 16px; margin-bottom: 20px; border-left: 5px solid #e1db74; border-radius: 4px;">
                    <h3 style="margin-bottom: 10px; color: #09111d;"><?= $mensagemSucesso ?></h3>
                    <p style="color: #000; margin-bottom: 5px;"><strong>Valor Financiado:</strong> R$ <?= number_format($valorFinanciado, 2, ',', '.') ?></p>
                    <p style="color: #000; margin-bottom: 5px;"><strong>Total de Juros (1.5% a.m.):</strong> R$ <?= number_format($totalJuros, 2, ',', '.') ?></p>
                    <p style="color: #000; margin-bottom: 0;"><strong>Valor de Cada Parcela (<?= $numeroParcelas ?>x):</strong> R$ <?= number_format($valorParcela, 2, ',', '.') ?></p>
                </div>
            <?php endif; ?>

            <!-- Formulário POST com dados mantidos preenchidos (Sticky) -->
            <form action="" method="POST" novalidate>
                
                <label for="valor_veiculo">Valor do Veículo (R$)</label>
                <input type="number" name="valor_veiculo" id="valor_veiculo" step="0.01" placeholder="Ex: 50000.00" value="<?= htmlspecialchars($valorVeiculoTexto) ?>">
                <?php if (isset($erro["valor_veiculo"])): ?>
                    <div class="erro"><?= $erro["valor_veiculo"] ?></div>
                <?php endif; ?>

                <label for="valor_entrada">Valor de Entrada (R$)</label>
                <input type="number" name="valor_entrada" id="valor_entrada" step="0.01" placeholder="Ex: 10000.00" value="<?= htmlspecialchars($valorEntradaTexto) ?>">
                <?php if (isset($erro["valor_entrada"])): ?>
                    <div class="erro"><?= $erro["valor_entrada"] ?></div>
                <?php endif; ?>

                <label for="numero_parcelas">Número de Parcelas</label>
                <!-- REQUISITO: Select com opções estruturadas -->
                <select name="numero_parcelas" id="numero_parcelas" style="width: 100%; padding: 10px; margin-top: 5px; box-sizing: border-box; font-size: 1rem;">
                    <option value="">Selecione a quantidade...</option>
                    <?php foreach ($opcoesParcelas as $opcao): ?>
                        <option value="<?= $opcao ?>" <?= $numParcelasTexto === (string)$opcao ? 'selected' : '' ?>>
                            <?= $opcao ?> parcelas
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($erro["numero_parcelas"])): ?>
                    <div class="erro"><?= $erro["numero_parcelas"] ?></div>
                <?php endif; ?>

                <button type="submit">Simular Parcelas</button>
            </form>
        </section>
    </main>
</body>

</html>
