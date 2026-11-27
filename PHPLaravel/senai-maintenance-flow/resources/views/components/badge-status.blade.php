@props(['status'])

@php
    $config = match(strtoupper((string)$status)) {
        'OPERANDO', 'CONCLUIDA' => ['fundo' => '#166534', 'texto' => '#bbf7d0', 'label' => $status],
        'EM_ANDAMENTO', 'ALERTA' => ['fundo' => '#854d0e', 'texto' => '#fef08a', 'label' => 'EM ANDAMENTO'],
        'MANUTENCAO', 'PARADO', 'CRITICA' => ['fundo' => '#991b1b', 'texto' => '#fecaca', 'label' => $status],
        default => ['fundo' => '#334155', 'texto' => '#cbd5e1', 'label' => $status],
    };
@endphp

<span style="background: {{ $config['fundo'] }}; color: {{ $config['texto'] }}; padding: 3px 10px; border-radius: 4px; font-size: 0.75rem; font-weight: bold;">
    {{ $config['label'] }}
</span>