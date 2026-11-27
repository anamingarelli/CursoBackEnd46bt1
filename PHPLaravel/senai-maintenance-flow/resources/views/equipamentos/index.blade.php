@extends('layouts.app')

@section('titulo', $titulo)

@section('conteudo')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <div>
            <h2 style="margin: 0;">{{ $titulo }}</h2>
            <p style="color: #94a3b8; font-size: 0.88rem; margin: 4px 0 0;">Relação oficial de ativos sob manutenção produtiva total (TPM).</p>
        </div>
        <a href="{{ route('equipamentos.create') }}" class="btn btn-success">+ Novo Equipamento</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>TAG</th>
                <th>Equipamento</th>
                <th>Setor Fabril</th>
                <th>Criticidade</th>
                <th>Status Operacional</th>
                <th style="text-align: right;">Ações</th>
            </tr>
        </thead>
        <tbody>
            {{-- Uso avançado de @forelse com a variável mágica $loop --}}
            @forelse($equipamentos as $maq)
                <tr style="background: {{ $loop->even ? '#1e293b' : '#0f172a' }};">
                    <td>
                        {{ $loop->iteration }}
                        @if($loop->first)
                            <span style="font-size:0.7rem; color:#38bdf8;">[Top 1]</span>
                        @endif
                    </td>
                    <td><code>{{ $maq->tag }}</code></td>
                    <td><strong>{{ $maq->nome }}</strong></td>
                    <td>{{ $maq->setor }}</td>
                    <td><x-badge-prioridade :nivel="$maq->criticidade" /></td>
                    <td><x-badge-status :status="$maq->status" /></td>
                    <td style="text-align: right; white-space: nowrap;">
                        <a href="{{ route('equipamentos.edit', $maq) }}" class="btn" style="padding: 4px 8px; font-size: 0.75rem;">Editar</a>
                        <form action="{{ route('equipamentos.destroy', $maq) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background: #dc2626; padding: 4px 8px; font-size: 0.75rem;">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 25px; color: #94a3b8;">
                        Nenhum equipamento cadastrado no momento.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection