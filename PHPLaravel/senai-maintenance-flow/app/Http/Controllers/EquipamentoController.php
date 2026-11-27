<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Equipamento;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Controller CRUD para gerenciamento do catalogo de maquinas industriais.
 */
final class EquipamentoController extends Controller {
    /**
     * Lista todos os equipamentos cadastrados no banco de dados.
     */
    public function index(): View {
        return view('equipamentos.index', [
            'equipamentos' => Equipamento::query()->latest()->get(),
            'titulo'       => 'Parque de Máquinas e Equipamentos Industriais',
        ]);
    }

    /**
     * Exibe o formulario de cadastro de equipamento.
     */
    public function create(): View {
        return view('equipamentos.create', [
            'titulo' => 'Cadastrar Equipamento',
        ]);
    }

    /**
     * Valida e persiste um novo equipamento no banco de dados.
     */
    public function store(Request $request): RedirectResponse {
        Equipamento::create($this->validar($request));

        return redirect()->route('equipamentos.index')
            ->with('mensagem_sucesso', 'Equipamento cadastrado com sucesso!');
    }

    /**
     * Exibe o formulario de edicao de um equipamento existente.
     */
    public function edit(Equipamento $equipamento): View {
        return view('equipamentos.edit', [
            'equipamento' => $equipamento,
            'titulo'      => 'Editar Equipamento',
        ]);
    }

    /**
     * Valida e atualiza os dados do equipamento no banco de dados.
     */
    public function update(Request $request, Equipamento $equipamento): RedirectResponse {
        $equipamento->update($this->validar($request, $equipamento->id));

        return redirect()->route('equipamentos.index')
            ->with('mensagem_sucesso', 'Equipamento atualizado com sucesso!');
    }

    /**
     * Remove um equipamento do banco de dados.
     */
    public function destroy(Equipamento $equipamento): RedirectResponse {
        $equipamento->delete();

        return redirect()->route('equipamentos.index')
            ->with('mensagem_sucesso', 'Equipamento removido com sucesso!');
    }

    /**
     * Centraliza as regras de validacao de equipamentos.
     */
    private function validar(Request $request, ?int $id = null): array {
        $regraTag = 'required|string|max:255|unique:equipamentos,tag' . ($id ? ",{$id}" : '');

        return $request->validate([
            'tag'         => $regraTag,
            'nome'        => 'required|string|max:255',
            'setor'       => 'required|string|max:255',
            'criticidade' => 'required|in:BAIXA,MEDIA,ALTA,CRITICA',
            'status'      => 'required|in:OPERANDO,MANUTENCAO,PARADO',
        ]);
    }
}