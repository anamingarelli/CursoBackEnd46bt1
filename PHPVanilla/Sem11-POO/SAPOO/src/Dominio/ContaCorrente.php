<?php
declare(strict_types=1);

// Classe ContaCorrente que é uma subclasse de ContaBancaria
// Permite cheque especial e cobra tarifa de saque de R$ 1,50

final class ContaCorrente extends ContaBancaria {

    // Atributos específicos da conta corrente
    public const TARIFA_SAQUE = 1.50;

    // Construtor
    public function __construct(
        string $agencia,
        string $numeroConta,
        Titular $titular,
        float $saldoInicial,
        private float $limiteChequeEspecial = 500.00
    )
    {
        parent::__construct($agencia, $numeroConta, $titular, $saldoInicial);
    }

    // Implementação do método sacar
    #[Override]
    public function sacar(float $valor): void
    {
        if ($valor <= 0) {
            throw new ValorInvalidoException($valor);
        }

        $custoTotal = $valor + self::TARIFA_SAQUE;
        $saldoTotalDisponivel = $this->saldo + $this->limiteChequeEspecial;

        if ($custoTotal > $saldoTotalDisponivel) {
            $this->registrarTransacao("Saque", $valor, false);
            throw new SaldoInsuficienteException($saldoTotalDisponivel, $custoTotal);
        }

        $this->saldo -= $custoTotal;

        // Registra o saque no histórico
        $this->registrarTransacao("Saque", $valor, true);

        // Envia notificação do saque
        $this->notificar(
            "Saque realizado no valor de R$ " . number_format($valor, 2, ',', '.')
        );
    }

    // Método de acesso ao cheque especial
    public function getLimiteChequeEspecial(): float {
        return $this->limiteChequeEspecial;
    }
}