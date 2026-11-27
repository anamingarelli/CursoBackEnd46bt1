<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'SENAI Maintenance Flow — TPM Industrial')</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #0f172a; margin: 0; color: #f8fafc; }
        header { background: #1e293b; padding: 14px 28px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #334155; }
        header h1 { font-size: 1.15rem; color: #38bdf8; margin: 0; }
        nav a { color: #94a3b8; text-decoration: none; font-weight: 600; font-size: 0.9rem; margin-left: 18px; }
        nav a:hover, nav a.ativo { color: #38bdf8; }
        .container { max-width: 1100px; margin: 30px auto; padding: 0 20px; }
        .card { background: #1e293b; border-radius: 8px; padding: 25px; border: 1px solid #334155; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.3); }
        .grid-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin: 25px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 0.88rem; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #334155; }
        th { color: #94a3b8; font-weight: 600; background: #0f172a; }
        .btn { display: inline-block; background: #0284c7; color: white; padding: 8px 14px; border-radius: 5px; text-decoration: none; font-weight: bold; font-size: 0.85rem; border: none; cursor: pointer; }
        .btn:hover { background: #0369a1; }
        .btn-success { background: #059669; }
        .btn-success:hover { background: #047857; }
        footer { text-align: center; padding: 25px 0; color: #64748b; font-size: 0.8rem; border-top: 1px solid #1e293b; margin-top: 50px; }
    </style>
    @stack('styles')
</head>
<body>
    <header>
        <h1>🛠️ SENAI Maintenance Flow</h1>
        <nav>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'ativo' : '' }}">Dashboard</a>
            <a href="{{ route('equipamentos.index') }}" class="{{ request()->routeIs('equipamentos.*') ? 'ativo' : '' }}">Equipamentos</a>
            <a href="{{ route('ordens.index') }}" class="{{ request()->routeIs('ordens.*') ? 'ativo' : '' }}">Ordens de Serviço</a>
        </nav>
    </header>

    <main class="container">
        {{-- Injeção do bloco de alertas globais via sessão --}}
        @if(session('mensagem_sucesso'))
            <x-alert tipo="success">
                {{ session('mensagem_sucesso') }}
            </x-alert>
        @endif

        {{-- Ponto de injeção principal das views filhas --}}
        @yield('conteudo')
    </main>

    <footer>
        SENAI-SP — Habilitação Técnica em Desenvolvimento de Sistemas | Módulo 3: Framework Laravel 11 & Blade Templates
    </footer>

    @stack('scripts')
</body>
</html>