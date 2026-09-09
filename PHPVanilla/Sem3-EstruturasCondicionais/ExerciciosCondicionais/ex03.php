<?php 

declare (strict_types=1);

//Exercício 3: Clínica Médica (Cálculo de IMC)

//Crie as variáveis $peso (ex: 85.5) e $altura (ex: 1.75).
//Calcule o IMC usando a fórmula: IMC = Peso / (Altura * Altura).
//Use if / elseif / else para exibir a classificação exata:
//Abaixo de 18.5 ➔ "Abaixo do Peso"
//De 18.5 a 24.9 ➔ "Peso Normal"
//De 25.0 a 29.9 ➔ "Sobrepeso"
//De 30.0 a 34.9 ➔ "Obesidade Grau I"
//35.0 ou mais ➔ "Obesidade Grau II ou III"

$peso = 73.3;
$altura = 1.83;

$imc = $peso / ($altura * $altura); 
//$imc = $peso/ $altura**2;

if ($imc < 18.5) {
    $classificacao = "Abaixo do peso";
} elseif ($imc < 25) {
    $classificacao = "Peso normal";
} elseif ($imc >= 25 && $imc < 30) {
    $classificacao = "Sobrepeso";
} elseif ($imc >= 30 && $imc < 35) {
    $classificacao = "Obesidade grau I";
} elseif ($imc >= 35 && $imc < 40) {
    $classificacao = "Obesidade grau II";
} else {
    $classificacao = "Obesidade grau III";
}

echo "Peso: $peso kg<br>";
echo "Altura: $altura m<br>";
echo "IMC: " . number_format($imc, 2, ',', '.');
echo "Classificação: $classificacao";

?>