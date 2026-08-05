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
   $salario = 1520.68; //variável numérica - decimal
   $status = null; //variável null

   //Dicas para Criação de Variáveis
   //Não inicie o nome de uma variável com números
   //Não utilize espaços em brancos
   //Não utilize caracteres especiais, apenas o underlaine
   //Crie variáveis com nomes que ajudarão a identificar melhor a mesma
   //Evite utilizar letras maiúsculas.

   echo $nome;
   echo "<br>";
   echo "Idade: +$idade";



    ?>

</body>
</html>