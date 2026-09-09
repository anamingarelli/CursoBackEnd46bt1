<?php
declare(strict_types=1);

// Procura um cliente pelo nome
function buscarCliente(array $clientes, string $nome): ?array {
    foreach ($clientes as $cliente) {
        if ($cliente["nome"] === $nome) {
            return $cliente;
        }
    }

    return null;
}

// Cadastro dos clientes
$clientes = [
    ["nome" => "Mariana", "idade" => 20],
    ["nome" => "João", "idade" => 22]
];

// Cliente encontrado
$resultado = buscarCliente($clientes, "Mariana");

if ($resultado !== null) {
    echo "Cliente encontrado: " . $resultado["nome"] . "<br>";
} else {
    echo "Cliente não encontrado<br>";
}

// Cliente não encontrado
$resultado = buscarCliente($clientes, "Carlos");

if ($resultado !== null) {
    echo "Cliente encontrado: " . $resultado["nome"];
} else {
    echo "Cliente não encontrado";
}
?>