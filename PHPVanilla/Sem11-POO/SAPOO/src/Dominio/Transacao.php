<?php
declare(strict_types=1);

// Classe que representa uma movimentação bancária
class Transacao {
    public function __construct(
        public readonly string $tipo,
        public readonly float $valor,
        public readonly DateTime $dataHora,
        public readonly bool $sucesso
    ) {
    }
}
