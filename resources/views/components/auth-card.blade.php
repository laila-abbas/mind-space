<div class="min-h-screen flex items-center justify-center">
    <div {{ $attributes->merge(['class' => 'w-full max-w-md bg-white p-8 rounded-2xl shadow-lg border border-primary']) }}>
        {{ $slot }}
    </div>
</div>