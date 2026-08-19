<?php
declare (strict_types=1);
//A Cantina Senai precisa de um pequeno sistema para consultar produtos, montar um pedido e calcular o total da compra. 
// Requisitos obrigatórios mostre as opções:
// 1 — Listar produtos
// 2 — Adicionar produto ao pedido
// 3 — Exibir resumo do pedido
// 4 — Finalizar compra
// 0 — Sair sem finalizar

// Produtos disponíveis na cantina
$produtos = [
    1 => ["nome" => "Coxinha", "preco" => 6.00, "estoque" => 10],
    2 => ["nome" => "Suco", "preco" => 5.00, "estoque" => 8],
    3 => ["nome" => "Sanduíche", "preco" => 12.00, "estoque" => 5],
    4 => ["nome" => "Bolo", "preco" => 7.50, "estoque" => 6]
];

$pedido = [];
$opcao = 0;

// O do-while mantém o menu funcionando até o usuário escolher sair ou finalizar
do {
    echo "\n1 - Listar produtos\n";
    echo "2 - Adicionar produto\n";
    echo "3 - Resumo do pedido\n";
    echo "4 - Finalizar compra\n";
    echo "0 - Sair\n";
  $opcao = (int) readline("Opção: ");

} while ($opcao != 4 && $opcao != 0);

?>