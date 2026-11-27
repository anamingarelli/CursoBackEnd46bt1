<?php
declare(strict_types=1);

require_once __DIR__ . '/carregar.php';

class ContaSalario extends ContaBancaria
{
    private int $saquesNoMes = 0;
    private string $mesReferencia = "";

    public function __construct(
        string $agencia,
        string $numeroConta,
        Titular $titular,
        public readonly string $cnpjEmpregador
    ) {
        parent::__construct(
            $agencia,
            $numeroConta,
            $titular,
            0.0
        );
    }

    public function depositar(
        float $valor,
        ?string $cnpjOrigem = null
    ): void {
        if ($cnpjOrigem !== $this->cnpjEmpregador) {
            throw new ContaException("Empregador não autorizado.");
        }

        parent::depositar($valor);
    }

    public function sacar(float $valor): void
    {
        $this->validarValor($valor);
        $mes = date("Y-m");

        if ($mes !== $this->mesReferencia) {
            $this->saquesNoMes = 0;
            $this->mesReferencia = $mes;
        }

        $taxa = $this->saquesNoMes >= 2 ? 4.00 : 0.00;
        $total = $valor + $taxa;

        $this->debitar($total);
        $this->saquesNoMes++;
        $this->registrar("Saque", $total);
        $this->notificar("Saque realizado: R$ " . $total);
    }

    public function transferir(
        float $valor,
        ContaBancaria $contaDestino
    ): void {
        if ($this->titular->cpf !== $contaDestino->titular->cpf) {
            throw new ContaException("Transferência não permitida.");
        }

        parent::transferir($valor, $contaDestino);
    }

    protected function debitar(float $valor): void
    {
        $this->validarValor($valor);

        if ($valor > $this->saldo) {
            throw new SaldoInsuficienteException($this->saldo, $valor);
        }

        $this->saldo -= $valor;
    }
}

// Teste do exercício.
$titular = new Titular("Ana Clara", "123.456.789-01");

$conta = new ContaSalario(
    "0001",
    "3030-1",
    $titular,
    "12345678000199"
);

try {
    $conta->depositar(1500.00, "12345678000199");

    $conta->sacar(100.00);
    $conta->sacar(100.00);
    $conta->sacar(100.00);

    echo "Saldo final: R$ ";
    echo number_format($conta->getSaldo(), 2, ",", ".");
} catch (Throwable $erro) {
    echo "Erro: " . $erro->getMessage();
}