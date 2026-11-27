<?php
declare(strict_types=1);

// Superclasse abstrata contendo o contrato e estados compartilhados entre as contas

abstract class ContaBancaria {
    // Atributos do tipo protected (podem ser acessados pelas classes filhas)
    protected float $saldo;

    // Novos atributos para os exercícios 2 e 3
    protected array $notificadores = [];
    protected array $historico = [];

    // Construtor
    public function __construct(
        public readonly string $agencia,
        public readonly string $numeroConta,
        public readonly Titular $titular,
        float $saldoInicial
    )
    {
        // Validação do saldo inicial
        if ($saldoInicial < 0.0) {
            throw new ValorInvalidoException($saldoInicial);
        }

        $this->saldo = $saldoInicial;
    }

    // Adiciona um canal de notificação
    public function adicionarNotificador(NotificadorInterface $notificador): void {
        $this->notificadores[] = $notificador;
    }

    // Envia notificações para todos os canais cadastrados
    protected function notificar(string $mensagem): void {
        foreach ($this->notificadores as $notificador) {
            $notificador->notificar($this->titular, $mensagem);
        }
    }

    // Registra uma movimentação no histórico
    protected function registrarTransacao(string $tipo, float $valor, bool $sucesso): void {
        $this->historico[] = new Transacao($tipo, $valor, new DateTime(), $sucesso);
    }

    // Retorna o histórico de movimentações
    public function getExtrato(): array {
        return $this->historico;
    }

    // Método depositar
    public function depositar(float $valor): void {
        if ($valor <= 0.0) {
            throw new ValorInvalidoException($valor);
        }

        $this->saldo += $valor;

        $this->registrarTransacao("Depósito", $valor, true);
        $this->notificar("Depósito realizado no valor de R$ " . number_format($valor, 2, ',', '.'));
    }

    // Método abstrato (polimorfismo)
    abstract public function sacar(float $valor): void;

    // Método polimórfico que realiza transferência entre contas
    public function transferir(float $valor, ContaBancaria $contaDestino): void {
        if ($this === $contaDestino) {
            throw new ValorInvalidoException($valor);
        }

        // Primeiro realiza o saque
        $this->sacar($valor);

        // Depois realiza o depósito
        $contaDestino->depositar($valor);
    }

    // Método público de acesso (getter)
    public function getSaldo(): float {
        return $this->saldo;
    }
}
