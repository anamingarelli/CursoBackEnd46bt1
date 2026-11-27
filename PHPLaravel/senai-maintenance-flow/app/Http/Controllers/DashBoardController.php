<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Models\OrdemServico;
use Illuminate\Contracts\View\View;

/**
 * Controller do painel executivo e metricas de confiabilidade industrial.
 */
final class DashboardController extends Controller {
    /**
     * Consulta metricas no banco de dados e renderiza a tela inicial.
     */
    public function index(): View {
        return view('dashboard.index', [
            'totalEquipamentos'    => Equipamento::count(),
            'equipamentosOperando' => Equipamento::where('status', 'OPERANDO')->count(),
            'ordensAbertas'        => OrdemServico::where('status', 'ABERTA')->count(),
            'ordensCriticas'       => OrdemServico::where('prioridade', 'CRITICA')
                ->where('status', '!=', 'CONCLUIDA')
                ->count(),
            'ultimasOrdens'        => OrdemServico::with('equipamento')->latest()->take(3)->get(),
        ]);
    }
}