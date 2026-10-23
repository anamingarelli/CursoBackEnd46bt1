<?php

declare(strict_types=1);

namespace Exercicios;

use DomainException;

// Exceções de domínio para controle de erros operacionais e de regras de negócio
class SaldoInsuficienteException extends DomainException {}
class ValorInvalidoException extends DomainException {}
class OperacaoNaoPermitidaException extends DomainException {}

// Objeto de Valor (Value Object) que representa a entidade Titular
class Titular
{
    public function __construct(
        public readonly string $nome,
        public readonly string $cpf
    ) {}
}

// Classe base abstrata responsável por centralizar o estado e métodos comuns
abstract class ContaBancaria
{
    protected float $saldo = 0.0;

    public function __construct(
        protected Titular $titular
    ) {}

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function getTitular(): Titular
    {
        return $this->titular;
    }

    abstract public function sacar(float $valor): void;
}

// Subclasse concreta que implementa as regras específicas da Conta Salário
class ContaSalario extends ContaBancaria
{
    private int $saquesNoMes = 0;
    private const TAXA_SAQUE_EXCEDENTE = 4.00;

    public function __construct(
        Titular $titular,
        public readonly string $cnpjEmpregador
    ) {
        parent::__construct($titular);
    }

    // Depósito restrito ao CNPJ do empregador previamente cadastrado
    public function depositar(float $valor, string $cnpjOrigem): void
    {
        if ($cnpjOrigem !== $this->cnpjEmpregador) {
            throw new OperacaoNaoPermitidaException("Depósito recusado: CNPJ do pagador diverge do cadastrado.");
        }
        if ($valor <= 0) {
            throw new ValorInvalidoException("O valor do depósito deve ser maior que zero.");
        }
        $this->saldo += $valor;
    }

    // Aplicação da regra de isenção até o 2º saque e cobrança de taxa a partir do 3º
    public function sacar(float $valor): void
    {
        if ($valor <= 0) {
            throw new ValorInvalidoException("O valor do saque deve ser maior que zero.");
        }

        $taxa = ($this->saquesNoMes >= 2) ? self::TAXA_SAQUE_EXCEDENTE : 0.0;
        $valorTotal = $valor + $taxa;

        if ($valorTotal > $this->saldo) {
            throw new SaldoInsuficienteException("Saldo insuficiente incluindo tarifas de saque.");
        }

        $this->saldo -= $valorTotal;
        $this->saquesNoMes++;
    }

    // Restrição de transferência exclusiva para contas sob o mesmo CPF
    public function transferir(float $valor, ContaBancaria $destino): void
    {
        if ($destino->getTitular()->cpf !== $this->titular->cpf) {
            throw new OperacaoNaoPermitidaException("Transferência permitida apenas para o mesmo titular.");
        }
        $this->sacar($valor);
        
        if (method_exists($destino, 'creditar')) {
            $destino->creditar($valor);
        }
    }
}