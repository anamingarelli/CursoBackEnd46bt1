<!-- Exercício 1: O Boletim Escolar (Cálculo de Média) -->

<?php
$notas = [7.5, 8.0, 6.5, 9.0, 5.5];
$soma = 0;

foreach ($notas as $nota){ 
    $soma += $nota;
}

$quantidade = count($notas);
$media = $soma / $quantidade;

echo "A média final do aluno é: " . number_format($media, 1) . "<br>" ;

if ($media >= 7) {
    echo "Status: <span style='color: green; font-weight: bold;'>Aprovado</span>";
} else {
    echo "Status: <span style='color: red; font-weight: bold;'>Reprovado</span>";
}

?>
