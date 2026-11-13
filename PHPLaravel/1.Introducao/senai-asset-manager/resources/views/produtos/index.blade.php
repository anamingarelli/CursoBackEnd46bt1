
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $titulo }}</title>

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #0f172a;
            margin: 0;
            color: #f8fafc;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: #1e293b;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #334155;
        }

        h1 {
            color: #38bdf8;
        }

        .btn {
            display: inline-block;
            background: #0284c7;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #334155;
        }

        th {
            color: #38bdf8;
        }

        a {
            color: #38bdf8;
        }

        .mensagem {
            background: #166534;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="card">

        <h1>📦 {{ $titulo }}</h1>

        @if(session('sucesso'))
            <div class="mensagem">
                {{ session('sucesso') }}
            </div>
        @endif

        <a href="{{ route('produtos.create') }}" class="btn">
            + Cadastrar Produto
        </a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Setor</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse($produtos as $produto)
                    <tr>
                        <td>{{ $produto->id }}</td>
                        <td>{{ $produto->nome }}</td>
                        <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                        <td>{{ $produto->quantidade }}</td>
                        <td>{{ $produto->setor }}</td>
                        <td>
                            <a href="{{ route('produtos.show', $produto->id) }}">
                                Ver detalhes
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            Nenhum produto cadastrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

</body>
</html>
