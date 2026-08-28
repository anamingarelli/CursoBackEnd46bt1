<?php
declare(strict_types=1);

// Calcula a média das notas
function calcularMedia(array $notas): float {
    return array_sum($notas) / count($notas);
}

// Verifica se o aluno foi aprovado
function verificarAprovacao(float $media): string {
    if ($media >= 7) {
        return "Aprovado";
    } else {
        return "Reprovado";
    }
}

// Notas do aluno
$notas = [8, 7, 6, 9];

$media = calcularMedia($notas);

echo "Média: " . number_format($media, 2) . "<br>";
echo "Situação: " . verificarAprovacao($media) . "<br>";
echo "Maior nota: " . max($notas) . "<br>";
echo "Menor nota: " . min($notas);
?>