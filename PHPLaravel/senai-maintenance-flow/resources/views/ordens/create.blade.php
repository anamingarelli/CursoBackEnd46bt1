@extends('layouts.app')

@section('titulo', $titulo)

@section('conteudo')
<div class="card" style="max-width: 650px; margin: 0 auto;">
    <h2>{{ $titulo }}</h2>
    <p style="color: #94a3b8; font-size: 0.85rem;">Preencha os dados técnicos para formalizar a intervenção de manutenção.</p>

    <form action="{{ route('ordens.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 5px;">Título da Ocorrência</label>
            <input type="text" name="titulo" required placeholder="Ex.: Superaquecimento do mancal frontal" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #475569; background: #0f172a; color: #f8fafc; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 5px;">Equipamento Alvo</label>
            <select name="equipamento_id" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #475569; background: #0f172a; color: #f8fafc; box-sizing: border-box;">
                <option value="">-- Selecione a Máquina --</option>
                @foreach($equipamentos as $e)
                    <option value="{{ $e->id }}">{{ $e->tag }} - {{ $e->nome }} ({{ $e->setor }})</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 5px;">Tipo de Manutenção</label>
            <select name="tipo" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #475569; background: #0f172a; color: #f8fafc; box-sizing: border-box;">
                <option value="PREVENTIVA">Preventiva</option>
                <option value="CORRETIVA">Corretiva</option>
                <option value="PREDITIVA">Preditiva</option>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 5px;">Grau de Prioridade</label>
            <select name="prioridade" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #475569; background: #0f172a; color: #f8fafc; box-sizing: border-box;">
                <option value="BAIXA">Baixa (Rotina preventiva)</option>
                <option value="MEDIA">Média (Atendimento em até 48h)</option>
                <option value="ALTA">Alta (Risco potencial de parada)</option>
                <option value="CRITICA">Crítica (Linha parada / Emergência)</option>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 5px;">Técnico Responsável</label>
            <input type="text" name="tecnico" value="{{ old('tecnico') }}" required placeholder="Ex.: Carlos Eduardo" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #475569; background: #0f172a; color: #f8fafc; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 5px;">Prazo Limite</label>
            <input type="date" name="prazo_limite" value="{{ old('prazo_limite') }}" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #475569; background: #0f172a; color: #f8fafc; box-sizing: border-box;">
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 25px;">
            <a href="{{ route('ordens.index') }}" style="color: #94a3b8; text-decoration: none; font-size: 0.9rem;">← Cancelar</a>
            <button type="submit" class="btn btn-success">Registrar Chamado</button>
        </div>
    </form>
</div>
@endsection
