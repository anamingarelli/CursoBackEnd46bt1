@extends('layouts.app')

@section('titulo', 'Painel Geral — SENAI Maintenance Flow')

@section('conteudo')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 style="color: #38bdf8; margin: 0;">Monitoramento de Manutenção Fabril</h2>
            <p style="color: #94a3b8; font-size: 0.88rem; margin-top: 4px;">
                Visão unificada de confiabilidade e disponibilidade do parque de máquinas.
            </p>
        </div>
        <a href="{{ route('ordens.create') }}" class="btn btn-success">+ Abrir Ordem de Serviço</a>
    </div>

    {{-- Utilização de Componentes Blade para os KPIs --}}
    <div class="grid-stats">
        <x-card-kpi titulo="Total de Máquinas" :valor="$totalEquipamentos" subtitulo="Cadastradas na planta" />
        <x-card-kpi titulo="Em Operação" :valor="$equipamentosOperando" cor="#4ade80" subtitulo="Disponibilidade ativa" />
        <x-card-kpi titulo="O.S. Abertas" :valor="$ordensAbertas" cor="#f59e0b" subtitulo="Aguardando atendimento" />
        <x-card-kpi titulo="Chamados Críticos" :valor="$ordensCriticas" cor="#f87171" subtitulo="Risco imediato" />
    </div>

    <h3 style="margin-top: 30px; border-bottom: 1px solid #334155; padding-bottom: 8px;">Chamados Recentes</h3>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Título do Chamado</th>
                <th>Prioridade</th>
                <th>Responsável</th>
                <th>Prazo</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ultimasOrdens as $ordem)
                <tr>
                    <td><strong>{{ $ordem->codigo }}</strong></td>
                    <td>{{ $ordem->titulo }}</td>
                    <td><x-badge-prioridade :nivel="$ordem->prioridade" /></td>
                    <td>{{ $ordem->tecnico }}</td>
                    <td>{{ date('d/m/Y', strtotime($ordem->prazo_limite)) }}</td>
                </tr>
            @empty
                <tr><td colspan="5" style="text-align:center; color:#94a3b8;">Nenhuma ordem registrada.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
