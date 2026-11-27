<?php
declare(strict_types=1);

require_once __DIR__ . '/carregar.php';

$titular = new Titular("Ana Clara", "123.456.789-01");

$conta = new ContaCorrente(
    "0001",
    "1010-1",
    $titular,
    1000.00
);

try {
    $conta->depositar(200.00);
    $conta->sacar(100.00);
    $conta->depositar(50.00);
} catch (Throwable $erro) {
    echo "Erro: " . $erro->getMessage() . PHP_EOL;
}

// Montagem do extrato.
echo "========== EXTRATO BANCÁRIO ==========" . PHP_EOL;

echo str_pad("TIPO", 15);
echo str_pad("VALOR", 15);
echo "DATA E HORA" . PHP_EOL;

foreach ($conta->getExtrato() as $transacao) {
    echo str_pad($transacao->tipo, 15);
    echo str_pad(
        "R$ " . number_format($transacao->valor, 2, ",", "."),
        15
    );
    echo $transacao->dataHora->format("d/m/Y H:i:s");
    echo PHP_EOL;
}

echo "--------------------------------------" . PHP_EOL;
echo "Saldo final: R$ ";
echo number_format($conta->getSaldo(), 2, ",", ".");