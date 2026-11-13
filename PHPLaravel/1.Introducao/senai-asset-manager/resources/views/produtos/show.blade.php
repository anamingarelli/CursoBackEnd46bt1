
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Produto</title>
    <style>
        body {
            background-color: #0f172a;
            color: white;
            font-family: Arial, sans-serif;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #1e293b;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            color: #38bdf8;
        }

        p {
            margin: 15px 0;
        }

        a {
            display: inline-block;
            background-color: #0284c7;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalhes do Produto</h1>

        <p><strong>ID:</strong> {{ $produto->id }}</p>
        <p><strong>Nome:</strong> {{ $produto->nome }}</p>
        <p><strong>Descrição:</strong> {{ $produto->descricao }}</p>
        <p><strong>Preço:</strong> R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
        <p><strong>Quantidade:</strong> {{ $produto->quantidade }}</p>
        <p><strong>Setor:</strong> {{ $produto->setor }}</p>

        <a href="{{ route('produtos.index') }}">Voltar</a>
        <a href="{{ route('produtos.edit', $produto->id) }}">Editar</a>
    </div>
</body>
</html>
