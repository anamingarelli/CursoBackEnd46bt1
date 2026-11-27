@extends('layouts.app')

@section('titulo', $titulo)

@section('conteudo')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>{{ $titulo }}</h2>
        <a href="{{ route('ordens.create') }}" class="btn btn-success">+ Nova Ordem</a>
    </div>

    {{-- Inclusão de Sub-view/Partial para a barra de filtros --}}
    @include('partials._barra_filtro', ['filtroAtual' => $filtroAtivo])

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Descrição do Problema</th>
                <th>Tipo</th>
                <th>Prioridade</th>
                <th>Status</th>
                <th>Prazo</th>
                <th style="text-align: right;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ordens as $o)
                <tr style="background: {{ $loop->even ? '#1e293b' : '#0f172a' }};">
                    <td><strong>{{ $o->codigo }}</strong></td>
                    <td>{{ $o->titulo }}</td>
                    <td>{{ $o->tipo }}</td>
                    <td><x-badge-prioridade :nivel="$o->prioridade" /></td>
                    <td><x-badge-status :status="$o->status" /></td>
                    <td>{{ date('d/m/Y', strtotime($o->prazo_limite)) }}</td>
                    <td style="text-align: right; white-space: nowrap;">
                        <a href="{{ route('ordens.show', $o) }}" class="btn" style="padding: 4px 8px; font-size: 0.75rem;">Ver Ficha</a>
                        <a href="{{ route('ordens.edit', $o) }}" class="btn" style="background: #475569; padding: 4px 8px; font-size: 0.75rem;">Editar</a>
                        <form action="{{ route('ordens.destroy', $o) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background: #dc2626; padding: 4px 8px; font-size: 0.75rem;">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 30px; color: #94a3b8;">
                        Nenhuma ordem de serviço localizada com os critérios selecionados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection