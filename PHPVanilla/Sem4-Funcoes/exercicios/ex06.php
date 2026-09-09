<?php
declare(strict_types=1);

// Aplica o desconto diretamente no preço original
function aplicarDesconto(float &$preco, float $porcentagem): void {
    $preco -= $preco * ($porcentagem / 100);
}

// Preço inicial
$preco = 200.00;

echo "Antes: R$ " . number_format($preco, 2, ",", ".") . "<br>";

// Aplica 15% de desconto
aplicarDesconto($preco, 15);

echo "Depois: R$ " . number_format($preco, 2, ",", ".");
?>