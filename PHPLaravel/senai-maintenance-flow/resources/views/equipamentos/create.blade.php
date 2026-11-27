{{-- resources/views/equipamentos/create.blade.php --}}
@extends('layouts.app')

@section('titulo', $titulo)

@section('conteudo')
<div class="card" style="max-width: 650px; margin: 0 auto;">
    <h2>{{ $titulo }}</h2>
    <form action="{{ route('equipamentos.store') }}" method="POST">
        @csrf
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 5px;">TAG do Patrimônio</label>
            <input type="text" name="tag" value="{{ old('tag') }}" required placeholder="Ex.: CNC-01" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #475569; background: #0f172a; color: #f8fafc; box-sizing: border-box;">
        </div>
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 5px;">Nome do Equipamento</label>
            <input type="text" name="nome" value="{{ old('nome') }}" required placeholder="Ex.: Torno CNC 5 Eixos Romi" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #475569; background: #0f172a; color: #f8fafc; box-sizing: border-box;">
        </div>
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 5px;">Setor Fabril</label>
            <input type="text" name="setor" value="{{ old('setor') }}" required placeholder="Ex.: Usinagem" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #475569; background: #0f172a; color: #f8fafc; box-sizing: border-box;">
        </div>
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 5px;">Criticidade</label>
            <select name="criticidade" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #475569; background: #0f172a; color: #f8fafc; box-sizing: border-box;">
                @foreach(['BAIXA', 'MEDIA', 'ALTA', 'CRITICA'] as $nivel)
                    <option value="{{ $nivel }}" @selected(old('criticidade') === $nivel)>{{ $nivel }}</option>
                @endforeach
            </select>
        </div>
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 5px;">Status Operacional</label>
            <select name="status" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #475569; background: #0f172a; color: #f8fafc; box-sizing: border-box;">
                @foreach(['OPERANDO', 'MANUTENCAO', 'PARADO'] as $st)
                    <option value="{{ $st }}" @selected(old('status', 'OPERANDO') === $st)>{{ $st }}</option>
                @endforeach
            </select>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 25px;">
            <a href="{{ route('equipamentos.index') }}" style="color: #94a3b8; text-decoration: none;">← Cancelar</a>
            <button type="submit" class="btn btn-success">Salvar Equipamento</button>
        </div>
    </form>
</div>
@endsection
