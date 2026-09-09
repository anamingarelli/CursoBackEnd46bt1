<!-- Exercício 4: Catálogo da Netflix (Filtro) -->

<?php
$filmes = [
    ["titulo" => "Matrix", "genero" => "Ficção", "classificacao_idade" => 16],
    ["titulo" => "Shrek", "genero" => "Animação", "classificacao_idade" => 0],
    ["titulo" => "Deadpool", "genero" => "Ação", "classificacao_idade" => 18],
    ["titulo" => "Procurando Nemo", "genero" => "Animação", "classificacao_idade" => 0],
    ["titulo" => "Vingadores", "genero" => "Ação", "classificacao_idade" => 12]
];
$filmesInfantis = array_filter($filmes, fn($filme) => $filme['classificacao_idade'] <= 12 );
?>

<ul>
    <?php foreach ($filmesInfantis as $filme): ?>
        <li>
            <strong><?= $filme['titulo'] ?></strong> - Gênero: <?= $filme['genero'] ?> 
            (Classificação: <?= $filme['classificacao_idade'] === 0 ? 'Livre' : $filme['classificacao_idade'] . ' anos' ?>)
        </li>
        <?php endforeach; ?>
</ul>