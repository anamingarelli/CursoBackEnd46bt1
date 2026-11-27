<?php
declare(strict_types=1);

require_once __DIR__ . '/carregar.php';

class ContaInvestimento extends ContaBancaria
{
    public function __construct(
        string $agencia,
        string $numeroConta,
        Titular $titular,
        float $saldoInicial,
        private ContaCorrente $contaCorrente,
        private int $diasAplicacao
    ) {
        parent::__construct(
            $agencia,
            $numeroConta,
            $titular,
            $saldoInicial
        );
    }

    public function sacar(float $valor): void
    {
        $this->debitar($valor);
        $this->registrar("Saque", $valor);
    }

    public function taxaAdministracao(): float
    {
        if ($this->saldo >= 10000) {
            return 0.005;
        }

        if ($this->saldo >= 5000) {
            return 0.01;
        }

        return 0.015;
    }

    private function taxaIR(): float
    {
        if ($this->diasAplicacao <= 180) {
            return 0.225;
        }

        if ($this->diasAplicacao <= 360) {
            return 0.20;
        }

        if ($this->diasAplicacao <= 720) {
            return 0.175;
        }

        return 0.15;
    }

    private function taxaIOF(): float
    {
        return $this->diasAplicacao < 30 ? 0.10 : 0.00;
    }

    public function resgatar(float $valor): void
    {
        $this->validarValor($valor);
        $this->debitar($valor);

        $taxas = $this->taxaAdministracao()
            + $this->taxaIOF()
            + $this->taxaIR();

        $liquido = $valor * (1 - $taxas);
        $this->contaCorrente->depositar($liquido);

        $this->registrar("Resgate", $valor);
        $this->notificar("Resgate realizado com sucesso.");
    }
}

// Teste do exercício.
$titular = new Titular("Ana Clara", "123.456.789-01");

$contaCorrente = new ContaCorrente(
    "0001",
    "1010-1",
    $titular,
    500.00
);

$investimento = new ContaInvestimento(
    "0001",
    "4040-1",
    $titular,
    5000.00,
    $contaCorrente,
    200
);

try {
    $investimento->resgatar(1000.00);

    echo "Saldo do investimento: R$ ";
    echo number_format($investimento->getSaldo(), 2, ",", ".");

    echo PHP_EOL . "Saldo da conta corrente: R$ ";
    echo number_format($contaCorrente->getSaldo(), 2, ",", ".");
} catch (Throwable $erro) {
    echo "Erro: " . $erro->getMessage();
}