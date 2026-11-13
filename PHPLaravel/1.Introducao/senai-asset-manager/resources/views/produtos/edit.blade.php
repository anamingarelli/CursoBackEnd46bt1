
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
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

        label {
            display: block;
            margin-top: 15px;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
            border-radius: 5px;
            border: none;
        }

        button, a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            border-radius: 5px;
            border: none;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background-color: #0284c7;
            color: white;
        }

        a {
            background-color: #475569;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Produto</h1>

        <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nome:</label>
            <input type="text" name="nome" value="{{ $produto->nome }}" required>

            <label>Descrição:</label>
            <textarea name="descricao" required>{{ $produto->descricao }}</textarea>

            <label>Preço:</label>
            <input type="number" name="preco" step="0.01" value="{{ $produto->preco }}" required>

            <label>Quantidade:</label>
            <input type="number" name="quantidade" value="{{ $produto->quantidade }}" required>

            <label>Setor:</label>
            <select name="setor" required>
                <option value="Autopeças" {{ $produto->setor == 'Autopeças' ? 'selected' : '' }}>Autopeças</option>
                <option value="Usinagem" {{ $produto->setor == 'Usinagem' ? 'selected' : '' }}>Usinagem</option>
                <option value="Robótica" {{ $produto->setor == 'Robótica' ? 'selected' : '' }}>Robótica</option>
                <option value="Siderurgia" {{ $produto->setor == 'Siderurgia' ? 'selected' : '' }}>Siderurgia</option>
            </select>

            <button type="submit">Salvar alterações</button>
            <a href="{{ route('produtos.index') }}">Cancelar</a>
        </form>
    </div>
</body>
</html>
