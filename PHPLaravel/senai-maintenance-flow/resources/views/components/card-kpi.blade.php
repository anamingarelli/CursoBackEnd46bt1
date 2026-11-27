@props([
    'titulo',
    'valor',
    'subtitulo' => '',
    'cor' => '#38bdf8'
])

<div style="background: #0f172a; padding: 18px; border-radius: 8px; border: 1px solid #334155; text-align: center;">
    <span style="font-size: 0.78rem; color: #94a3b8; text-transform: uppercase; font-weight: bold; letter-spacing: 0.05em;">
        {{ $titulo }}
    </span>
    <strong style="display: block; font-size: 1.9rem; color: {{ $cor }}; margin-top: 8px;">
        {{ $valor }}
    </strong>
    @if(!empty($subtitulo))
        <small style="font-size: 0.75rem; color: #64748b; margin-top: 4px; display: block;">
            {{ $subtitulo }}
        </small>
    @endif
</div>