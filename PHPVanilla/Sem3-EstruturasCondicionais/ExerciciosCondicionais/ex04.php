<?php
declare(strict_types=1);

//Exercício 4: Autenticação de Sistema (Login Múltiplo)

//Crie as variáveis $cargoUsuario (string) e $senhaDigitada (string).
//Crie uma variável com a senha correta do sistema: $senhaSistema = "SenhaSegura123";.
//O acesso só é liberado SE a senha estiver correta E o cargo for "Diretor" OU "Gerente".
//Exiba "Acesso Liberado" ou "Acesso Negado". (Dica: Cuidado com o uso de parênteses para separar o AND do OR).


$senhaSistema = "SenhaSegura123";
$cargoUsuario = "Auxiliar";
if (($cargoUsuario ==="Diretor" || $cargoUsuario === "Gerente") && $senhaSistema === "SenhaSegura123") {
    echo "Acesso Permitido";
} else {
    echo "Acesso Negado";
}



?>