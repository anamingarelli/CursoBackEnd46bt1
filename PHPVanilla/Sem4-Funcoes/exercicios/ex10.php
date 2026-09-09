<?php
declare(strict_types=1);

// Retira uma quantidade do estoque
function retirarEstoque(array &$produto, int $quantidade): bool {
    if ($quantidade <= 0 || $quantidade > $produto["estoque"]) {
        return false;
    }

    $produto["estoque"] -= $quantidade;
    return true;
}

// Produto inicial
$produto = [
    "nome" => "Caderno",
    "estoque" => 10
];

// Retirada permitida
if (retirarEstoque($produto, 3)) {
    echo "Retirada realizada. Estoque: " . $produto["estoque"] . "<br>";
} else {
    echo "Retirada recusada.<br>";
}

// Retirada recusada
if (retirarEstoque($produto, 20)) {
    echo "Retirada realizada.";
} else {
    echo "Retirada recusada. Estoque insuficiente.";
}
?>