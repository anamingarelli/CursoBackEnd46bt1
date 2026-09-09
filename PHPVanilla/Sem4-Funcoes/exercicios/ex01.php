<!-- Exercícios Práticos - Parte B -->

<?php
declare(strict_types=1);

// Calcula e retorna o IMC
function calcularIMC(float $peso, float $altura): float {
    return $peso / ($altura * $altura);
}

// Testes
$imc1 = calcularIMC(60, 1.65);
$imc2 = calcularIMC(70, 1.75);
$imc3 = calcularIMC(90, 1.80);

// Mostra os resultados com duas casas decimais
echo "IMC 1: " . number_format($imc1, 2) . "<br>";
echo "IMC 2: " . number_format($imc2, 2) . "<br>";
echo "IMC 3: " . number_format($imc3, 2);
?>