<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Listar todos os produtos cadastrados
     */
    public function index(): View
    {
        return view("produtos.index", [
            "produtos" => Produto::all(),
            "titulo" => "Produtos Cadastrados"
        ]);
    }

    /**
     * Exibir formulário para cadastro de produtos
     */
    public function create(): View
    {
        return view("produtos.create", [
            "titulo" => "Novo Cadastro de Produto"
        ]);
    }

    /**
     * Salvar os dados do novo produto
     */
    public function store(Request $request): RedirectResponse
    {
        $dados = $request->validate([
            "nome" => "required | min:3",
            "descricao" => "required",
            "preco" => "required | numeric",
            "quantidade" => "required | integer",
            "setor" => "required"
        ]);

        Produto::create($dados);

        return redirect()->route("produtos.index")
            ->with("sucesso", "Produto cadastrado com sucesso");
    }

    /**
     * Exibir detalhes de um produto específico
     */
    public function show(int $id): View
    {
        $produto = Produto::findOrFail($id);

        return view("produtos.show", [
            "produto" => $produto,
            "titulo" => "Detalhes do Produto: {$produto["nome"]}"
        ]);
    }

    /**
     * Exibir formulário para atualizar um produto
     */
    public function edit(string $id): View
    {
        $produto = Produto::findOrFail($id);

        return view("produtos.edit", [
            "produto" => $produto,
            "titulo" => "Editar Produto {$produto["nome"]}"
        ]);
    }

    /**
     * Atualizar os dados do produto
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $dados = $request->validate([
            "nome" => "required | min:3",
            "descricao" => "required",
            "preco" => "required | numeric",
            "quantidade" => "required | integer",
            "setor" => "required"
        ]);

        Produto::findOrFail($id)->update($dados);

        return redirect()->route("produtos.show", $id)
            ->with("sucesso", "Produto atualizado com sucesso");
    }

    /**
     * Excluir um produto
     */
    public function destroy(int $id): RedirectResponse
    {
        Produto::findOrFail($id)->delete();

        return redirect()->route("produtos.index")
            ->with("sucesso", "Produto removido com sucesso");
    }

    /**
     * Filtrar produtos por setor
     */
    public function filtrarPorSetor(?string $setor = null): View
    {
        $consulta = Produto::query();

        if ($setor !== null) {
            $consulta->where("setor", "like", $setor);
        }

        return view("produtos.index", [
            "produtos" => $consulta->get(),
            "titulo" => $setor ? "Setor: " . ucfirst($setor) : "Todos os Setores"
        ]);
    }
}
