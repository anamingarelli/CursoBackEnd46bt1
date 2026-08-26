# Exercícios teóricos - Parte A

> 1. Conceito de função: Explique com suas palavras o que é uma função e cite duas vantagens de dividir um programa em funções.

- Funções são blocos de código com um nome próprio que realizam uma tarefa específica. Elas só são executadas quando são chamadas e podem receber dados de entrada e devolver um resultado.
Exemplo: 
```php
function saudar(string $nome): string{
    return "Olá, " . $nome . "!";
}
echo saudar("Carlos"); //Saída: "Olá, Carlos!"
```

Ao usarmos funções, conseguimos reutilizar nosso código, escrevendo-o uma vez e usando-o varias vezes no programa sem repetir linhas e ganhamos organização e manutenção ficando mais fácil de achar erros e mudar parte dos códigos sem estragar o resto do sistemas.

> 2. Princípio DRY: Por que repetir o mesmo bloco de código em várias partes do sistema pode causar problemas de manutenção? Como uma função ajuda a evitar essa repetição?

- Repetir o mesmo código em vários lugares dificulta a manutenção, porque qualquer alteração precisa ser feita em todos os lugares. Uma função permite escrever o código uma vez e reutilizá-lo várias vezes.

> 3. Parâmetros e retorno: Explique a diferença entre um parâmetro e um valor retornado por uma função. Use a função abaixo como exemplo:

- Os parâmetros são os valores que a função recebe para realizar seu trabalho. O retorno é o resultado que a função devolve.

Na função:

```php
function calcularTotal(float $preco, int $quantidade): float {
    return $preco * $quantidade;
}
```
 *Obs -> `$preco` e `$quantidade` são os parâmetros, enquanto o resultado da multiplicação é o valor retornado pela função.*

 > 4. Tipagem: Identifique o tipo de cada elemento na declaração
 `function cadastrar(string $nome, int $idade): bool`

 - `string`: tipo do parâmetro $nome.
 - `int`: tipo do parâmetro $idade.
 - `bool`: tipo do valor que a função deve retornar.


 > 5. `void` e `return`: Qual é a diferença entre uma função que retorna `string` e uma função que retorna void? Dê um exemplo de uso para cada uma.

 - Uma função que retorna `string` deve devolver um texto usando `return`.

Exemplo:

```php
function saudacao(): string {
    return "Olá!";
}
```
Uma função `void` não retorna um valor.

Exemplo:

```php
function mostrarMensagem(): void {
    echo "Olá!";
}
```
> 6. Escopo: Por que a função abaixo não consegue acessar $cliente diretamente? Explique duas formas de corrigir o código e indique qual é a mais recomendada.


A função não consegue acessar $cliente porque essa variável foi criada fora da função e pertence ao escopo global.

Uma forma é usar global:
```php
$cliente = "Mariana";

function exibirCliente(): string {
    global $cliente;
    return $cliente;
}
```
Outra forma, mais recomendada, é passar a variável como parâmetro:

```php
$cliente = "Mariana";

function exibirCliente(string $cliente): string {
    return $cliente;
}
```

A segunda opção é mais recomendada porque deixa a função independente de variáveis globais.

> 7. Referência: O que muda quando um parâmetro é declarado como `float &$valor`? Explique a diferença entre alterar uma cópia e alterar a variável original.


- Quando declaramos `float &$void`, o símbolo `&` faz com que o PHP passe a variável por **referência**, enquanto `float` exige um número decimal. A diferença prática é que alterar uma cópia (passagem por valor padrão) cria uma réplica isolada na memória, mantendo a variável original intacta fora da função. Já alterar a variável original (passagem por referência com &) faz a função mexer direto no mesmo endereço de memória, modificando permanentemente o valor inicial de forma definitiva.


> 8. Funções nativas: Escolha cinco funções da tabela deste material e descreva: categoria, finalidade, parâmetros principais e valor retornado.

| Função | Categoria | Finalidade | Parâmetro | Retorno |
|---|---|---|---|---|
| `strlen()` | String | Conta caracteres | String | `int` |
| `strtolower()` | String | Converte para minúsculas | String | `string` | 
| `trim` | String | Remove espaços do início ao e fim | String | `string |
| `count()` | Array | Conta elementos | Array | `int` |
| `max()` | Matemática/ Array | Encontra maior valor | Valores ou array | Valor maior |

> 9. Previsão de saída: Qual será o resultado exibido pelo código abaixo? Explique o motivo.
```php
function aplicarDesconto(float $preco): float {
    return $preco * 0.90;
}

$valor = 100.00;
echo aplicarDesconto($valor);
echo $valor;
```

- O resultado será:  `90100`, porque a função recebe `100`, calcula 90% desse valor e retorna `90`. Porém, ela não altera `$valor`. Por isso, depois da função, `$valor` continua sendo `100`.

> 10. Documentação: Pesquise na documentação oficial do PHP a função `strlen()` e anote sua sintaxe, o parâmetro recebido e o tipo de retorno.

Sintaxe: 

```php
 strlen(string $string): int
``` 
Parâmetro: `String` 
Retorno: `int`, representando a quantidade de caracteres da string.


