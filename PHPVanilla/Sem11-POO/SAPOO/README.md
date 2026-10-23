# Situação de Aprendizagem: SENAI Bank - usando POO

## Montagem da Estrtura de Arquivos

```text
SAPOO/
├── src/
│   ├── Dominio/
│   │   ├── Titular.php                         <- Entidade imutável do correntista
│   │   ├── ContaBancaria.php                   <- Superclasse abstrata
│   │   ├── ContaCorrente.php                   <- Subclasse com cheque especial e taxa
│   │   └── ContaPoupanca.php                   <- Subclasse com rendimento e sem taxa
│   └── Exceptions/
│       ├── ContaException.php                  <- Exceção base do domínio
│       ├── SaldoInsuficienteException.php      <- Falha por fundos insuficientes
│       └── ValorInvalidoException.php          <- Valores negativos ou nulos
├── app_banco.php                               <- Simulador visual de operações bancárias
└── README.md                                   <- Documentação e testes
```

## Criação das Execeções de Domínio

## Entidade de Titularidade com Imutabilidade (`readonly`)

## Criação da SuperClasse Abstrata de Conta Bancária 

## Criação das Classe Hendeiras

## Criação da Tela Visual

Desafios