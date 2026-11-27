@props(['nivel'])

@php
    $config = match(strtoupper((string)$nivel)) {
        'CRITICA' => ['fundo' => '#991b1b', 'texto' => '#fecaca', 'label' => 'CRÍTICA'],
        'ALTA'    => ['fundo' => '#854d0e', 'texto' => '#fef08a', 'label' => 'ALTA'],
        'MEDIA'   => ['fundo' => '#075985', 'texto' => '#bae6fd', 'label' => 'MÉDIA'],
        default   => ['fundo' => '#1e293b', 'texto' => '#94a3b8', 'label' => 'BAIXA'],
    };
@endphp

<span style="background: {{ $config['fundo'] }}; color: {{ $config['texto'] }}; padding: 3px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: bold;">
    {{ $config['label'] }}
</span>