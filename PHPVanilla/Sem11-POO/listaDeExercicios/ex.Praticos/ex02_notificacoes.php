<?php

declare(strict_types=1);

namespace Exercicios;

use DomainException;

class SaldoInsuficienteException extends DomainException {}
class ValorInvalidoException extends DomainException {}

class Titular
{
    public function __construct(
        public readonly string $nome,
        public readonly string $email,
        public readonly string $telefone
    ) {}
}

// Interface que define o contrato estrito para os serviços de notificação
interface NotificadorInterface
{
    public function notificar(Titular $titular, string $mensagem): bool;
}

// Implementação concreta do serviço de notificação por E-mail
class NotificadorEmail implements NotificadorInterface
{
    public function notificar(Titular $titular, string $mensagem): bool
    {
        echo "[E-MAIL] Para {$titular->email}: {$mensagem}" . PHP_EOL;
        return true;
    }
}

// Implementação concreta do serviço de notificação por SMS
class NotificadorSMS implements NotificadorInterface
{
    public function notificar(Titular $titular, string $mensagem): bool
    {
        echo "[SMS] Para {$titular->telefone}: {$mensagem}" . PHP_EOL;
        return true;
    }
}

// Implementação concreta do serviço de notificação por WhatsApp
class NotificadorWhatsApp implements NotificadorInterface
{
    public function notificar(Titular $titular, string $mensagem): bool
    {
        echo "[WHATSAPP] Para {$titular->telefone}: {$mensagem}" . PHP_EOL;
        return true;
    }
}

abstract class ContaBancaria
{
    protected float $saldo = 0.0;
    
    /** @var NotificadorInterface[] Coleção de canais de notificação registrados */
    protected array $notificadores = [];

    public function __construct(protected Titular $titular) {}

    public function adicionarNotificador(NotificadorInterface $notificador): void
    {
        $this->notificadores[] = $notificador;
    }

    // Disparo polimórfico de mensagens para todos os notificadores cadastrados
    protected function dispararNotificacoes(string $mensagem): void
    {
        foreach ($this->notificadores as $notificador) {
            $notificador->notificar($this->titular, $mensagem);
        }
    }

    public function depositar(float $valor): void
    {
        if ($valor <= 0) {
            throw new ValorInvalidoException("O valor do depósito deve ser maior que zero.");
        }
        $this->saldo += $valor;
        $this->dispararNotificacoes("Depósito de R$ " . number_format($valor, 2, ',', '.') . " realizado.");
    }

    abstract public function sacar(float $valor): void;
}

class ContaCorrente extends ContaBancaria
{
    public function __construct(Titular $titular)
    {
        parent::__construct($titular);
    }

    public function sacar(float $valor): void
    {
        if ($valor <= 0) {
            throw new ValorInvalidoException("O valor do saque deve ser maior que zero.");
        }
        if ($valor > $this->saldo) {
            throw new SaldoInsuficienteException("Saldo insuficiente para o saque.");
        }
        $this->saldo -= $valor;
        $this->dispararNotificacoes("Saque de R$ " . number_format($valor, 2, ',', '.') . " realizado.");
    }