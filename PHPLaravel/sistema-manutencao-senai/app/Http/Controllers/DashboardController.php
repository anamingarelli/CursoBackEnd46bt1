<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Models\OrdemServico;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class DahboardController extends Controller
{
    //Display do apinel executivo e metricas do controle de manutenção
    public function index(): View
    {
        $equipamentos = Equipamento::todos(); //criando um vetor com todos os euqipamento
        $ordens = OrdemServico::todas(); //criando um vetor com todas as ordens de serviços

        //métricas
        $totalEquipamentos = count($equipamentos); //contando quanto equipamento tem no vetor acima
        $equipamentoOperando = count(array_filter($equipamentos, fn($e) => $e->status ==="OPERANDO" ));
        $ordensAbertas = count(array_filter($ordens, fn($o) => $o->status === "ABERTA"));
        $ordensCriticas = count(array_filter($ordens, fn($o) => $o->prioridade === "CRITICA" && $o->status !== "CONCLUIDA"));

        //fazer o view
        return view("dashboard.indes", [
            "totalEquipamentos" => $totalEquipamentos,
            "equipamentosOperando" => $equipamentoOperando,
            "ordensAbertas" => $ordensAbertas,
            "ordensCriticas" => $ordensCriticas,
            "ultimasOrdens" => array_slice($ordens, 0, 3),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
