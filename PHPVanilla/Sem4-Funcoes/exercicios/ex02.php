<?php
declare(strict_types=1);

// Classifica o IMC
function classificarIMC(float $imc): string {
    if ($imc < 18.5) {
        return "Abaixo do peso";
    } elseif ($imc <= 24.9) {
        return "Peso normal";
    } elseif ($imc <= 29.9) {
        return "Sobrepeso";
    } else {
        return "Obesidade";
    }
}

// Testes
echo classificarIMC(17.5) . "<br>";
echo classificarIMC(22.0) . "<br>";
echo classificarIMC(27.0) . "<br>";
echo classificarIMC(31.0);
?>