@props(['label', 'name', 'errorBag' => 'default'])

<div>
    @if ($label)
        <x-forms.label :$name :$label :asterisk="$attributes->has('asterisk')" />
    @endif

    <div class="mt-1">
        {{ $slot }}

        @if ($errorBag === 'default')
            <x-forms.error :error="$errors->first($name)" />
        @else
            <x-forms.error :error="$errors->{$errorBag}->first($name)" />
        @endif
    </div>
</div>