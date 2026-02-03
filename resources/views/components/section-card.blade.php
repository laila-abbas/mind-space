@props(['center' => false])

<div @class(['flex items-center justify-center min-h-screen' => $center])>
    <div {{ $attributes->merge(['class' => 'w-full bg-bg-surface p-8 rounded-2xl shadow-lg border border-brand hover:border-brand-hover']) }}>
        {{ $slot }}
    </div>
</div>
