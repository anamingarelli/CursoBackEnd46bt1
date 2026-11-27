<?php
declare(strict_types=1);

class NotificadorWhatsApp implements NotificadorInterface
{
    public function notificar(
        Titular $titular,
        string $mensagem
    ): bool {
        echo "WhatsApp para {$titular->nome}: {$mensagem}" . PHP_EOL;
        return true;
    }
}