# LISTA DE EXERCÍCIOS DE FIXAÇÃO E PRÁTICA

## Parte A: Questões Teóricas de Fixação

**1. Procedural vs. OO:** Quais são os três principais riscos técnicos de manter regras financeiras críticas implementadas puramente através de `arrays associativos` e `scripts procedurais?`

> R: Os três principais riscos são a ausência de validação de tipos e chaves `(Type Safety)`, o espalhamento da regra de negócio com quebra do encapsulamento e a alta rigidez acompanhada de baixa testabilidade. Em arrays associativos, erros de digitação em chaves criam entradas nulas sem alertas de sintaxe, corrompendo cálculos. Além disso, qualquer trecho do código pode alterar os dados sem passar por validações financeiras, e qualquer mudança na estrutura do array exige refatorar manualmente todo o sistema.

**2. Ciclo de Vida do Objeto:** O que ocorre na memória Heap do servidor quando a instrução `new ContaCorrente(...)` é executada? Qual é o papel do método `__construct()` nesse processo?

> R: Ao executar `new ContaCorrente(...)`, a Zend Engine aloca um bloco de memória na Heap para armazenar os atributos e o estado da nova instância, gerando um identificador único atribuído à variável residente na Stack. Em seguida, o método `__construct()` é disparado automaticamente para inicializar o objeto em um estado válido, atribuindo os valores recebidos aos atributos e executando as validações iniciais obrigatórias.

**3. A Pseudo-Variável `$this`:** Explique por que o comando `$this->saldo` é obrigatório para acessar um atributo dentro da classe, diferenciando-o de uma variável local `$saldo`.

> R:A pseudo-variável `$this` representa o objeto atual dentro de um método não estático. Ela permite acessar os atributos e métodos pertencentes àquela instância.

Já `$saldo` é uma variável local, que existe no escopo do método e não representa automaticamente o atributo do objeto.

Exemplo:

```php
<?php
declare(strict_types=1);

class ContaCorrente
{
    private float $saldo = 0.0;

    public function depositar(float $valor): void
    {
        $saldo = $valor; // Variável local.
        $this->saldo += $saldo; // Atributo do objeto.
    }
}
```

Nesse exemplo, `$saldo` recebe o valor localmente, enquanto `$this->saldo` representa o saldo armazenado na conta.

**4. Encapsulamento e Invariantes:** Por que um desenvolvedor sênior de back-end nunca deve criar um método `public function setSaldo(float $novoSaldo)` para uma conta bancária?

> R: Um desenvolvedor sênior evita o método `setSaldo()` porque ele quebra o encapsulamento e transforma a classe em um modelo anêmico. Esse tipo de *setter* permite que código externo altere o saldo arbitrariamente para qualquer valor, contornando regras de auditoria, limites de crédito e taxas financeiras. O correto é expor apenas métodos comportamentais de domínio, como `sacar()` e `depositar()`, nos quais as alterações do saldo ocorrem como consequência controlada e validada do processo.

**5. Modificadores de Acesso:** Qual é a diferença prática entre os modificadores `private` e `protected` quando subclasses entram em cena através do `extends`?

> R: A diferença prática reside na visibilidade para a hierarquia de herança. Atributos e métodos declarados como private são acessíveis exclusivamente dentro do código da classe onde foram definidos, sendo invisíveis para qualquer subclasse derivada. Já os membros declarados como protected podem ser lidos e modificados tanto pela classe pai quanto por qualquer subclasse que utilize o extends, continuando protegidos contra acesso direto por partes externas da aplicação.

**6. Constructor Property Promotion:** Como o recurso de promoção de propriedades introduzido no PHP 8 reduz o boilerplate e melhora a legibilidade do código?

> R: O recurso do PHP 8 *elimina a repetição* de código ao combinar a declaração dos atributos da classe e a atribuição de seus valores no construtor em uma única linha dentro da própria assinatura do método `__construct()`. Isso descarta a necessidade de declarar os atributos previamente no corpo da classe e fazer atribuições manuais como `$this->campo = $campo`, tornando o código mais conciso e legível.

**7. Propriedades `readonly`:** Explique o mecanismo de segurança proporcionado pela palavra-chave `readonly` em atributos de classes de valor como Titular ou CPF.

> R: A palavra-chave `readonly` garante imutabilidade ao permitir que uma propriedade seja gravada apenas uma única vez, geralmente durante a inicialização do objeto. Qualquer tentativa posterior de modificar esse valor dispara um erro de execução. Para classes de valor como Titular ou CPF, esse mecanismo impede alterações acidentais ou maliciosas nos dados identificadores após a criação do objeto, assegurando a integridade e consistência da informação.

**8. Classes Abstratas:** Por que faz todo sentido no modelo bancário que a classe `ContaBancaria` seja declarada como `abstract` enquanto `ContaCorrente` e `ContaPoupanca` são classes concretas?

> R: Declarar `ContaBancaria` como classe abstrata faz sentido porque ela representa um conceito genérico que não deve ser instanciado diretamente no mundo real, servindo como um modelo que centraliza atributos e regras compartilhadas. Por sua vez, ContaCorrente e ContaPoupanca são classes concretas porque representam os produtos bancários reais com os quais o sistema opera, fornecendo as implementações específicas de regras operacionais, como cobrança de tarifas ou rendimento de juros.

**9. Polimorfismo:** Como o método `transferir(float $valor, ContaBancaria $destino)` consegue operar transferências entre quaisquer tipos de contas filhas sem precisar saber qual é a classe exata da conta de destino?

> R: O método consegue operar transferências devido ao polimorfismo e à tipagem baseada na classe abstrata ancestral `ContaBancaria`. Como todas as contas filhas herdam de `ContaBancaria` e garantem a existência do método `depositar()`, o método `transferir()` precisa apenas chamar esse comportamento na instância de destino. Em tempo de execução, o PHP identifica e executa a implementação específica do método `depositar()` referente à subclasse concreta recebida.


**10. Exceções de Domínio:** Por que é uma péssima prática retornar `false` ou `null` quando uma operação de saque é rejeitada por falta de saldo?

> R:  Retornar *false ou null* é uma péssima prática porque transfere para o código chamador a obrigação de validar o retorno; caso a verificação seja omitida, a aplicação continuará a execução tratando a falha como sucesso. Além disso, esses retornos não fornecem contexto sobre a causa exata do problema. O uso de exceções de domínio interrompe de forma segura o fluxo normal *(mecanismo Fail-Fast)* e obriga o tratamento explícito do erro através de estruturas `try/catch`.
