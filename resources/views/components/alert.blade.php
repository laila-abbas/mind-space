@props(['type' => 'success', 'message' => session('status'), 'center' => true, 'show' => true])

@php
    $colors = [
        'success' => 'bg-green-100 text-green-700',
        'error' => 'bg-red-100 text-red-700',
        'warning' => 'bg-yellow-100 text-yellow-700',
        'info' => 'bg-blue-100 text-blue-700',
        'default' => 'bg-gray-100 text-gray-700'
    ];

    $classes = $colors[$type] ?? $colors['default'];
    $alignment = $center ? 'text-center' : '';
@endphp

@if($show && $message)
    <div class="{{ $classes }} p-3 rounded mb-4 {{ $alignment }}">
        {{ $message }}
    </div>
@endif
