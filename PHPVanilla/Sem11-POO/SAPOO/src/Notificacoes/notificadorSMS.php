<?php
declare(strict_types=1);

class NotificadorSMS implements NotificadorInterface
{
    public function notificar(
        Titular $titular,
        string $mensagem
    ): bool {
        echo "SMS para {$titular->nome}: {$mensagem}" . PHP_EOL;
        return true;
    }
}