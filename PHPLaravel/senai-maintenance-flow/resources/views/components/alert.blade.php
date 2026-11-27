@props(['tipo' => 'info'])

@php
    $estilos = match($tipo) {
        'danger'  => ['borda' => '#dc2626', 'fundo' => '#7f1d1d', 'texto' => '#fecaca'],
        'warning' => ['borda' => '#d97706', 'fundo' => '#78350f', 'texto' => '#fef3c7'],
        'success' => ['borda' => '#16a34a', 'fundo' => '#14532d', 'texto' => '#bbf7d0'],
        default   => ['borda' => '#0284c7', 'fundo' => '#0c4a6e', 'texto' => '#bae6fd'],
    };
@endphp

<div style="border-left: 4px solid {{ $estilos['borda'] }}; background: {{ $estilos['fundo'] }}; color: {{ $estilos['texto'] }}; padding: 12px 16px; border-radius: 4px; margin-bottom: 20px; font-size: 0.88rem;">
    {{ $slot }}
</div>