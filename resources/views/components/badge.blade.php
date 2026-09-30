@php
    $class = match ($status) {
        'Aman' => 'bg-success',
        'Menipis' => 'bg-warning text-dark',
        'Habis' => 'bg-danger',
        default => 'bg-secondary',
    };
@endphp

<span class="badge {{ $class }}">
    {{ $status }}
</span>