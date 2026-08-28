<?php
declare(strict_types=1);

// Calcula o total dos produtos
function calcularCarrinho(array $produtos): float {
    $total = 0;

    foreach ($produtos as $produto) {
        $total += $produto["preco"] * $produto["quantidade"];
    }

    return $total;
}

// Produtos do carrinho
$produtos = [
    ["nome" => "Caderno", "preco" => 25.00, "quantidade" => 2],
    ["nome" => "Caneta", "preco" => 3.50, "quantidade" => 4]
];

// Mostra o total
echo "Total da compra: R$ " . number_format(calcularCarrinho($produtos), 2, ",", ".");
?>