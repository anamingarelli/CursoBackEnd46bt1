# Exercícios teóricos - Parte A

> 1. Conceito de função: Explique com suas palavras o que é uma função e cite duas vantagens de dividir um programa em funções.

- Funções são blocos de código com um nome próprio, normalmente representadas por variáveis ($nome, $texto etc) que fazem uma tarefa específica. Funciona apenas quando você a chama e pode receber dados de entrada para devolver um resultado.
Exemplo: 
```php
function saudar(string $nome): string{
    return "Olá, " . $nome . "!"
};

echo saudar("Carlos"); //Saída: "Olá, Carlos!"
```

Ao usarmos funções, conseguimos reutilizar nosso código, escrevendo-o uma vez e usando-o varias vezes no programa sem repetir linhas e ganhamos organização e manutenção ficando mais fácil de achar erros e mudar parte dos códigos sem estragar o resto do sistemas.