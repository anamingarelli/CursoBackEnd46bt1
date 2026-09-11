<?php
declare(strict_types=1);

// 1. Catálogo mockado com 6 produtos e preços em formato float
$produtos = [
    ['nome' => 'iPhone 17', 'categoria' => 'Smartphones (Celulares)', 'preco' => 7999.00],
    ['nome' => 'MacBook Air (com chip M5)', 'categoria' => 'Computadores Portáteis (Notebooks)', 'preco' => 15999.00],
    ['nome' => 'iPad Air (com chip M4)', 'categoria' => 'Tablets', 'preco' => 9999.00],
    ['nome' => 'Apple Watch Series 11', 'categoria' => 'Relógios Inteligentes (Smartwatches)', 'preco' => 5499.00],
    ['nome' => 'AirPods Max 2', 'categoria' => 'Áudio e Fones de Ouvido', 'preco' => 6590.00],
    ['nome' => 'Mac mini (com chip M6/M5 Pro)', 'categoria' => 'Desktops (Computadores de Mesa)', 'preco' => 10799.00],
];

// 2. Captura dos filtros via GET
$buscaProduto = trim((string) ($_GET["produto"] ?? "")); 
$precoMaximoTexto = trim((string) ($_GET["preco_maximo"] ?? ""));

$produtosFiltrados = $produtos; 

// 3. Filtragem usando array_filter
if ($buscaProduto !== "" || $precoMaximoTexto !== "") {
    $produtosFiltrados = array_filter(
        $produtos,
        function (array $produto) use ($buscaProduto, $precoMaximoTexto): bool {
            $nomeCorrespondente = true;
            $precoCorrespondente = true;
            
            if ($buscaProduto !== "") {
                $nomeCorrespondente = str_contains(
                    strtolower($produto["nome"]),
                    strtolower($buscaProduto)
                );
            }

            if ($precoMaximoTexto !== "") {
                $precoMaximo = filter_var($precoMaximoTexto, FILTER_VALIDATE_FLOAT);
                $precoCorrespondente = $precoMaximo !== false && $produto["preco"] <= $precoMaximo;
            }
            
            return $nomeCorrespondente && $precoCorrespondente;
        }
    );
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Produtos - Apple</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h1>Catálogo de Produtos</h1>

        <section>
            <form action="" method="GET">
                <label for="produto">Nome do produto</label>
                <input type="text" name="produto" id="produto" value="<?= htmlspecialchars($buscaProduto, ENT_QUOTES, "UTF-8") ?>" placeholder="Ex: iPhone, MacBook...">

                <label for="preco_maximo">Preço Máximo</label>
                <input type="number" name="preco_maximo" id="preco_maximo" step="0.01" value="<?= htmlspecialchars($precoMaximoTexto) ?>" placeholder="8000">

                <button type="submit">Pesquisar</button>
                <a href="?" class="btn-limpar">Limpar Filtros</a>
            </form>

            <h2>Produtos Encontrados</h2>

            <?php if ($produtosFiltrados === []): ?>
                <p class="vazio">Nenhum produto encontrado para os filtros aplicados.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Categoria</th>
                            <th>Preço</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtosFiltrados as $produto): ?>
                            <tr>
                                <td><?= htmlspecialchars($produto['nome']) ?></td>
                                <td><?= htmlspecialchars($produto['categoria']) ?></td>
                                <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
