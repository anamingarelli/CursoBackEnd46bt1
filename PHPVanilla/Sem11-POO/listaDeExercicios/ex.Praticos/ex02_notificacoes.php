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

// Cadastro dos notificadores.
$conta->adicionarNotificador(new NotificadorEmail());
$conta->adicionarNotificador(new NotificadorSMS());
$conta->adicionarNotificador(new NotificadorWhatsApp());

try {
    $conta->depositar(200.00);
    $conta->sacar(100.00);

    echo PHP_EOL . "Saldo atual: R$ ";
    echo number_format($conta->getSaldo(), 2, ",", ".");
} catch (Throwable $erro) {
    echo "Erro: " . $erro->getMessage();
}