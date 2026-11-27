<?php
declare(strict_types=1);

final class Transacao
{
    public function __construct(
        public readonly string $tipo,
        public readonly float $valor,
        public readonly DateTimeImmutable $dataHora,
        public readonly bool $sucesso
    ) {
    }
}