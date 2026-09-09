
<!-- Exercício 6: Dashboard Financeiro (Extrato Bancário) -->

<?php

$extrato = [
    ["data" => "2026-09-01", "descricao" => "Salário", "tipo" => "Entrada", "valor" => 4000.00],
    ["data" => "2026-09-02", "descricao" => "Supermercado", "tipo" => "Saida", "valor" => 450.50],
    ["data" => "2026-09-05", "descricao" => "Pix João", "tipo" => "Entrada", "valor" => 200.00],
    ["data" => "2026-09-10", "descricao" => "Conta de Luz", "tipo" => "Saida", "valor" => 120.00],
    ["data" => "2026-09-12", "descricao" => "Cinema", "tipo" => "Saida", "valor" => 65.00]
];


$totalEntradas = 0;
$totalSaidas = 0;


foreach ($extrato as $t) {
    if ($t['tipo'] === 'Entrada') {
        $totalEntradas += $t['valor'];
    } else {
        $totalSaidas += $t['valor'];
    }
}


$saldoAtual = $totalEntradas - $totalSaidas;
$corSaldo = ($saldoAtual >= 0) ? "green" : "red";


$gastosAltos = array_filter($extrato, fn($t) => $t['tipo'] === 'Saida' && $t['valor'] > 100);
?>


<div style="display: flex; gap: 20px;">
    <div>
        <h3>Entradas</h3>
        <p>R$ <?= number_format($totalEntradas, 2, ',', '.') ?></p>
    </div>
    <div>
        <h3>Saídas</h3>
        <p>R$ <?= number_format($totalSaidas, 2, ',', '.') ?></p>
    </div>
    <div>
        <h3>Saldo Atual</h3>
        <p style="color: <?= $corSaldo ?>;">R$ <?= number_format($saldoAtual, 2, ',', '.') ?></p>
    </div>
</div>


<h3>Extrato Bancário</h3>
<table border="1">
    <tr>
        <th>Data</th>
        <th>Descrição</th>
        <th>Tipo</th>
        <th>Valor</th>
    </tr>
    <?php foreach ($extrato as $t): ?>
        <tr>
            <td><?= $t['data'] ?></td>
            <td><?= $t['descricao'] ?></td>
            <td><?= $t['tipo'] ?></td>
            <td>R$ <?= number_format($t['valor'], 2, ',', '.') ?></td>
        </tr>
    <?php endforeach; ?>
</table>


<h3>⚠️ Atenção: Gastos Altos do Mês</h3>
<table border="1">
    <tr>
        <th>Descrição</th>
        <th>Valor</th>
    </tr>
    <?php foreach ($gastosAltos as $g): ?>
        <tr>
            <td><?= $g['descricao'] ?></td>
            <td>R$ <?= number_format($g['valor'], 2, ',', '.') ?></td>
        </tr>
    <?php endforeach; ?>
</table>
