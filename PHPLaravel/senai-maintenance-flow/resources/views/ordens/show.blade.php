@extends('layouts.app')

@section('titulo', $titulo)

@section('conteudo')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #334155; padding-bottom: 15px;">
        <div>
            <h2 style="margin: 0; color: #38bdf8;">{{ $ordem->codigo }}</h2>
            <span style="color: #94a3b8; font-size: 0.85rem;">
                Abertura em {{ date('d/m/Y', strtotime($ordem->data_abertura)) }} | Prazo: {{ date('d/m/Y', strtotime($ordem->prazo_limite)) }}
            </span>
        </div>
        <div>
            <x-badge-prioridade :nivel="$ordem->prioridade" />
            <x-badge-status :status="$ordem->status" />
        </div>
    </div>

    <div style="margin-top: 20px;">
        <h4 style="color: #cbd5e1; margin-bottom: 6px;">Descrição Técnica do Chamado:</h4>
        <p style="background: #0f172a; padding: 15px; border-radius: 6px; border: 1px solid #334155; margin-top: 0;">
            {{ $ordem->titulo }}
        </p>
        <p style="color: #94a3b8; font-size: 0.88rem;">
            <strong>Tipo:</strong> {{ $ordem->tipo }} | <strong>Técnico Responsável:</strong> {{ $ordem->tecnico }}
        </p>
    </div>

    @if($equipamento)
        <div style="margin-top: 20px; background: #0f172a; padding: 18px; border-radius: 8px; border: 1px solid #334155;">
            <h4 style="margin-top: 0; color: #38bdf8;">Ficha da Máquina Associada:</h4>
            <p style="margin: 5px 0;"><strong>TAG:</strong> {{ $equipamento->tag }} | <strong>Máquina:</strong> {{ $equipamento->nome }}</p>
            <p style="margin: 5px 0;"><strong>Setor Fabril:</strong> {{ $equipamento->setor }} | <strong>Criticidade no Processo:</strong> {{ $equipamento->criticidade }}</p>
        </div>
    @endif

    <div style="margin-top: 25px; display: flex; justify-content: space-between;">
        <a href="{{ route('ordens.index') }}" class="btn">← Voltar às Ordens</a>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('ordens.edit', $ordem) }}" class="btn" style="background: #0284c7;">Editar Ordem</a>
            <button id="btn-imprimir" class="btn" style="background: #475569;">🖨️ Imprimir Ordem</button>
        </div>
    </div>
</div>
@endsection

{{-- Injeção do script no @stack('scripts') do layout mestre --}}
@push('scripts')
<script>
    document.getElementById('btn-imprimir')?.addEventListener('click', function() {
        window.print();
    });
</script>
@endpush