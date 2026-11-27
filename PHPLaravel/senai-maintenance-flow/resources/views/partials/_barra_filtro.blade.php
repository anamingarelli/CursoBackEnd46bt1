<div style="background: #0f172a; padding: 12px 18px; border-radius: 6px; border: 1px solid #334155; margin-bottom: 20px; display: flex; align-items: center; gap: 12px;">
    <span style="font-size: 0.85rem; color: #94a3b8; font-weight: bold;">Filtrar por Status:</span>
    <a href="{{ route('ordens.index') }}" class="btn" style="padding: 4px 10px; font-size: 0.78rem; background: {{ $filtroAtual === '' ? '#0284c7' : '#334155' }};">Todas</a>
    <a href="{{ route('ordens.index', ['status' => 'aberta']) }}" class="btn" style="padding: 4px 10px; font-size: 0.78rem; background: {{ $filtroAtual === 'aberta' ? '#0284c7' : '#334155' }};">Abertas</a>
    <a href="{{ route('ordens.index', ['status' => 'em_andamento']) }}" class="btn" style="padding: 4px 10px; font-size: 0.78rem; background: {{ $filtroAtual === 'em_andamento' ? '#0284c7' : '#334155' }};">Em Andamento</a>
    <a href="{{ route('ordens.index', ['status' => 'concluida']) }}" class="btn" style="padding: 4px 10px; font-size: 0.78rem; background: {{ $filtroAtual === 'concluida' ? '#0284c7' : '#334155' }};">Concluídas</a>
</div>