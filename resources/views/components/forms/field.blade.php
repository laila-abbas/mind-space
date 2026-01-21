@props(['label', 'name'])

@php
    $isRequired = $attributes->has('req');
@endphp

<div>
    @if ($label)
        <x-forms.label :$name :$label :req="$isRequired" />
    @endif

    <div class="mt-1">
        {{ $slot }}

        <x-forms.error :error="$errors->first($name)" />
    </div>
</div>