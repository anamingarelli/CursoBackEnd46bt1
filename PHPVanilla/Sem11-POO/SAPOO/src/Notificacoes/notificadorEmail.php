<?php
declare(strict_types=1);

class NotificadorEmail implements NotificadorInterface
{
    public function notificar(
        Titular $titular,
        string $mensagem
    ): bool {
        echo "E-mail para {$titular->nome}: {$mensagem}" . PHP_EOL;
        return true;
    }
}