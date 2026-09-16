<?php
declare(strict_types=1);

// Exibe erros na tela durante o desenvolvimento
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Autoatendimento e Cotação de Fornecedores
// Aplicação de página única usando GET, POST e SERVER

// DADOS SIMULADOS
$cotacoes = [
    [
        'id' => 1,
        'fornecedor' => 'Eletro Parts Ltda',
        'email' => 'contato@eletroparts.com.br',
        'categoria' => 'Eletrônicos',
        'descricao' => 'Bobinas de cobre 2mm - 100kg',
        'valor' => 4500.00,
        'prazo' => 7,
        'condicao' => '30 dias',
        'data' => '10/09/2026'
    ],
    [
        'id' => 2,
        'fornecedor' => 'Peças Mecânicas do Brasil',
        'email' => 'vendas@pecasmec.com.br',
        'categoria' => 'Mecânica',
        'descricao' => 'Rolamentos de esferas NSK 6204',
        'valor' => 1250.50,
        'prazo' => 5,
        'condicao' => 'À Vista',
        'data' => '12/09/2026'
    ],
    [
        'id' => 3,
        'fornecedor' => 'Supply Express',
        'email' => 'compras@supplyexpress.com.br',
        'categoria' => 'Consumíveis',
        'descricao' => 'Óleo hidráulico ISO 46 - 200L',
        'valor' => 2100.00,
        'prazo' => 3,
        'condicao' => '60 dias',
        'data' => '15/09/2026'
    ],
    [
        'id' => 4,
        'fornecedor' => 'Serviços Técnicos SENAI',
        'email' => 'servicos@senaigeral.com.br',
        'categoria' => 'Serviços',
        'descricao' => 'Manutenção preventiva - 40h',
        'valor' => 3200.00,
        'prazo' => 1,
        'condicao' => '30 dias',
        'data' => '14/09/2026'
    ],
    [
        'id' => 5,
        'fornecedor' => 'Eletrônicos Avançados SA',
        'email' => 'vendas@eletravanc.com.br',
        'categoria' => 'Eletrônicos',
        'descricao' => 'Transformador 10kVA 220/110',
        'valor' => 8750.00,
        'prazo' => 15,
        'condicao' => '90 dias',
        'data' => '11/09/2026'
    ],
    [
        'id' => 6,
        'fornecedor' => 'Plásticos Industriais',
        'email' => 'venda@plasticosindustriais.com.br',
        'categoria' => 'Consumíveis',
        'descricao' => 'Tubos PVC 75mm - 50 metros',
        'valor' => 650.00,
        'prazo' => 2,
        'condicao' => 'À Vista',
        'data' => '13/09/2026'
    ],
    [
        'id' => 7,
        'fornecedor' => 'Automação Industrial Plus',
        'email' => 'suporte@autoplus.com.br',
        'categoria' => 'Eletrônicos',
        'descricao' => 'CLP Siemens S7-1200',
        'valor' => 15800.00,
        'prazo' => 21,
        'condicao' => '60 dias',
        'data' => '09/09/2026'
    ],
    [
        'id' => 8,
        'fornecedor' => 'Consultoria Técnica Premium',
        'email' => 'info@consultoriatech.com.br',
        'categoria' => 'Serviços',
        'descricao' => 'Auditoria de processos - 3 dias',
        'valor' => 5600.00,
        'prazo' => 5,
        'condicao' => '30 dias',
        'data' => '08/09/2026'
    ]
];

$mensagemSucesso = "";
$erro = [];

// Variáveis do formulário
$nome = "";
$email = "";
$categoria = "";
$descricao = "";
$valor = "";
$prazo = "";
$condicao = "";

// PROCESSAMENTO DO GET
$buscaFornecedor = trim((string) ($_GET["fornecedor"] ?? ""));
$valorMaximoTexto = trim((string) ($_GET["valor_max"] ?? ""));

// FILTRO DAS COTAÇÕES
$cotacoesFiltradas = array_filter($cotacoes, function ($item) use ($buscaFornecedor, $valorMaximoTexto) {
    // Filtra por nome do fornecedor (busca parcial sem diferenciar maiúsculas/minúsculas)
    if ($buscaFornecedor !== '' && stripos($item['fornecedor'], $buscaFornecedor) === false) {
        return false;
    }
    // Filtra por valor máximo
    if ($valorMaximoTexto !== '' && is_numeric($valorMaximoTexto)) {
        if ($item['valor'] > (float)$valorMaximoTexto) {
            return false;
        }
    }
    return true;
});
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoatendimento e Cotação de Fornecedores</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f9; color: #333; }
        h1, h2 { color: #2c3e50; }
        .box { background: #fff; padding: 20px; margin-bottom: 20px; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .form-inline { display: flex; gap: 10px; align-items: flex-end; flex-wrap: wrap; }
        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-size: 14px; margin-bottom: 4px; font-weight: bold; }
        input[type="text"], input[type="number"] { padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        button, .btn-clear { padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; font-size: 14px; }
        button { background-color: #007bff; color: white; }
        button:hover { background-color: #0056b3; }
        .btn-clear { background-color: #6c757d; color: white; line-height: 20px; display: inline-block; }
        .btn-clear:hover { background-color: #5a6268; }
        table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border-radius: 6px; overflow: hidden; }
        th, td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; }
        th { background-color: #343a40; color: white; }
        tr:hover { background-color: #f1f1f1; }
    </style>
</head>
<body>

    <h1>Painel de Cotações</h1>

    <!-- FORMULÁRIO DE FILTRO (GET) -->
    <div class="box">
        <h2>Filtrar Cotações</h2>
        <form method="GET" action="" class="form-inline">
            <div class="form-group">
                <label for="fornecedor">Fornecedor:</label>
                <input type="text" id="fornecedor" name="fornecedor" value="<?= htmlspecialchars($buscaFornecedor) ?>" placeholder="Ex: Eletro">
            </div>

            <div class="form-group">
                <label for="valor_max">Valor Máximo (R$):</label>
                <input type="number" step="0.01" id="valor_max" name="valor_max" value="<?= htmlspecialchars($valorMaximoTexto) ?>" placeholder="Ex: 5000">
            </div>

            <button type="submit">Buscar</button>
            <a href="?" class="btn-clear">Limpar Filtros</a>
        </form>
    </div>

    <!-- TABELA DE RESULTADOS -->
    <h2>Resultados Encontrados (<?= count($cotacoesFiltradas) ?>)</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fornecedor</th>
                <th>E-mail</th>
                <th>Categoria</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Prazo</th>
                <th>Condição</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($cotacoesFiltradas)): ?>
                <?php foreach ($cotacoesFiltradas as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars((string)$c['id']) ?></td>
                        <td><?= htmlspecialchars($c['fornecedor']) ?></td>
                        <td><?= htmlspecialchars($c['email']) ?></td>
                        <td><?= htmlspecialchars($c['categoria']) ?></td>
                        <td><?= htmlspecialchars($c['descricao']) ?></td>
                        <td>R$ <?= number_format($c['valor'], 2, ',', '.') ?></td>
                        <td><?= htmlspecialchars((string)$c['prazo']) ?> dias</td>
                        <td><?= htmlspecialchars($c['condicao']) ?></td>
                        <td><?= htmlspecialchars($c['data']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" style="text-align: center; color: #888;">Nenhuma cotação encontrada com os filtros informados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>