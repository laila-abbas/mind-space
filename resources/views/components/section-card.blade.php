@props(['center' => false])

<div @class(['flex items-center justify-center min-h-screen' => $center])>
    <div {{ $attributes->merge(['class' => 'w-full bg-white p-8 rounded-2xl shadow-lg border border-primary hover:border-secondary']) }}>
        {{ $slot }}
    </div>
</div>
