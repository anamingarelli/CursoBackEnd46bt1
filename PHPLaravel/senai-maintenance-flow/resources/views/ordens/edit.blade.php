
@extends('layouts.app')

@section('titulo', $titulo)

@section('conteudo')
<div class="card" style="max-width: 650px; margin: 0 auto;">

    <h2>{{ $titulo }}</h2>

    <form action="{{ route('ordens.update', $ordem) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Título da Ocorrência</label>
        <input type="text" name="titulo" value="{{ old('titulo', $ordem->titulo) }}" required>

        <label>Equipamento</label>
        <select name="equipamento_id" required>
            @foreach($equipamentos as $e)
                <option value="{{ $e->id }}" @selected(old('equipamento_id', $ordem->equipamento_id) == $e->id)>
                    {{ $e->tag }} - {{ $e->nome }}
                </option>
            @endforeach
        </select>

        <label>Tipo de Manutenção</label>
        <select name="tipo" required>
            <option value="PREVENTIVA" @selected(old('tipo', $ordem->tipo) == 'PREVENTIVA')>Preventiva</option>
            <option value="CORRETIVA" @selected(old('tipo', $ordem->tipo) == 'CORRETIVA')>Corretiva</option>
            <option value="PREDITIVA" @selected(old('tipo', $ordem->tipo) == 'PREDITIVA')>Preditiva</option>
        </select>

        <label>Prioridade</label>
        <select name="prioridade" required>
            <option value="BAIXA" @selected(old('prioridade', $ordem->prioridade) == 'BAIXA')>Baixa</option>
            <option value="MEDIA" @selected(old('prioridade', $ordem->prioridade) == 'MEDIA')>Média</option>
            <option value="ALTA" @selected(old('prioridade', $ordem->prioridade) == 'ALTA')>Alta</option>
            <option value="CRITICA" @selected(old('prioridade', $ordem->prioridade) == 'CRITICA')>Crítica</option>
        </select>

        <label>Técnico Responsável</label>
        <input type="text" name="tecnico" value="{{ old('tecnico', $ordem->tecnico) }}" required>

        <label>Prazo Limite</label>
        <input type="date" name="prazo_limite" value="{{ old('prazo_limite', $ordem->prazo_limite) }}" required>

        <label>Status</label>
        <select name="status" required>
            <option value="ABERTA" @selected(old('status', $ordem->status) == 'ABERTA')>Aberta</option>
            <option value="EM_ANDAMENTO" @selected(old('status', $ordem->status) == 'EM_ANDAMENTO')>Em andamento</option>
            <option value="CONCLUIDA" @selected(old('status', $ordem->status) == 'CONCLUIDA')>Concluída</option>
        </select>

        <br><br>

        <a href="{{ route('ordens.index') }}">Cancelar</a>
        <button type="submit" class="btn btn-success">Atualizar Ordem</button>

    </form>
</div>
@endsection