<?php
declare(strict_types=1);

require_once __DIR__ . '/carregar.php';

$titular = new Titular("Ana Clara", "123.456.789-01");

$conta = new ContaCorrente(
    "0001",
    "1010-1",
    $titular,
    500.00
);

echo "===== TESTE DE ENCAPSULAMENTO =====" . PHP_EOL;

// Teste 1: acesso direto ao saldo.
try {
    $conta->saldo = 10000.00;
} catch (Throwable $erro) {
    echo "Acesso bloqueado: " . $erro->getMessage() . PHP_EOL;
}

// Teste 2: instanciação da classe abstrata.
try {
    $teste = new ContaBancaria(
        "0001",
        "9999-9",
        $titular,
        100.00
    );
} catch (Throwable $erro) {
    echo "Instanciação bloqueada: " . $erro->getMessage() . PHP_EOL;
}

// Teste 3: depósito negativo.
try {
    $conta->depositar(-100.00);
} catch (ValorInvalidoException $erro) {
    echo "Valor bloqueado: " . $erro->getMessage() . PHP_EOL;
}

echo "==================================" . PHP_EOL;
echo "Testes finalizados." . PHP_EOL;
echo "Saldo preservado: R$ ";
echo number_format($conta->getSaldo(), 2, ",", ".");