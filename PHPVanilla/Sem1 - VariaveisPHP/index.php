<?php 
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudo de Variaveis</title>
</head>
<body>
    <h1>Estudo de Variáveis</h1>
    <hr>
    <?php
    //Para criar variáveis em PHP, basta colocaar o sinal de $
    //Variáveis em php são NÃO típadas, ou seja, NÃO precisa declarar o tipo (Texto, números, booleanos)
   // ao atribuir valor para a variável, a tipagem é automática
   $nome = "João"; //Criação da variável nome com o valor textual "João"
   $idade = 25; //Criação da variável idade com o valor numérico 25
   $ativo = true; //criação da variável ativo com o valor booleano true
   $salario = 1520.68; //variável numérica - decimal (float - double)
   $status = null; //variável null
   //$endereço; //Variável Undefined, não é possível declarar uma variavel sem atribuir uma valor a ela, não existe Undefined em PHP

   //Dicas para Criação de Variáveis:
   //Não inicie o nome de uma variável com números
   //Não utilize espaços em brancos
   //Não utilize caracteres especiais, apenas o underlaine
   //Crie variáveis com nomes que ajudarão a identificar melhor a mesma
   //Evite utilizar letras maiúsculas.

  //Exibir as variáveis na tela
   echo "Nome: $nome <br>";
   echo "Idade: $idade <br>";
   echo "Ativo: $ativo <br>";
   echo "Salario: $salario <br>";
   echo "Status: $status <br>";
   
   echo "<br><h3> Constantes </h3><br>"; 
   // Constantes são representadadas pela palavras "const" ou define" seguidas do nome da constante.
   //Exemplos de constantes:
   const PI = 3.14; // Constante do tipo Number (Float)
   const EMPRESA = "Google"; //Constante do Tipo String 
   define("SITE", "www.google.com"); // Declaração de Constante do tipo String usando "define"
   // Uma boa prática é utilizar letras maiúsculaspara nomear constantes, para diferenciar das variáveis.

   // Exibir as constantes na tela
   echo "Valor de PI: " . PI . "<br>";
   echo "Nome da Empresa" . EMPRESA . "<br>";
   echo "Site: " . SITE . "<br>";

   // Tentar alterar o valor de uma constante, isso irá geral um erro de código, pois constantes não podem ser alteradas
   // PI = 3.14159; //Isso é um erro
   // redeclarar umas constante também orá gerar umm erro 
   // const SITE = "www.google;com.br; " Isso é um erro

   //*Regra de Ouro:* Sempre coloque a instrução "declare(strict_types=1);" no início do seu código PHP,
   // isso blindará o seu sistema contra mistura acidentais de tipos de dados.


   // Utilização de Texto (Concatenação Vs Interpolação)

   //Exemplo de Concatenação => Juntar duas ou mais Strings utilizando o operador "."(ponto)
   echo "Olá, ".$nome ."! Seja bem-vindo ao nosso site! <br>";
   
   // Exemplo de Interpolação => Utilização de variáveis dentro de um texto, utilizando aspas duplas no texto.
  echo "$nome, tem $idade anos e seu salário é R$ $salario reais. <br>";//forma mais correta de misturar texto e variáveis



    ?>

</body>
</html>
