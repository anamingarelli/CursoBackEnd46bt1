<!-- Exercício 5: Black Friday no E-commerce (Mapeamento) -->

<?php

$carrinho = [
    ["produto" => "Notebook", "preco" => 4000.00],
    ["produto" => "Mouse", "preco" => 150.00],
    ["produto" => "Teclado", "preco" => 300.00]
];


$carrinhoBlackFriday = array_map(function($item) {
    $item['preco'] = $item['preco'] * 0.80; // aplica 20% de desconto
    return $item; 
}
, $carrinho);
?>

<ul>
    <?php foreach ($carrinhoBlackFriday as $item): ?>
        <li><?= $item['produto'] ?> - Preço Black Friday:  R$ <?= number_format($item['preco'], 2, ',', '.') ?></li>
    <?php endforeach; ?>
</ul>
