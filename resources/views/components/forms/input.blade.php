@props(['label', 'name', 'type' => 'text'])

@php
    $defaults = [
        'type' => 'text',
        'id' => $name,
        'name' => $name,
        'class' => 'rounded-xl bg-white border border-primary px-5 py-4 w-full 
                    focus:ring-2 focus:ring-secondary focus:ring-opacity-30 outline-none',
        'value' => old($name),
        'placeholder' => $label,
    ];
@endphp

<x-forms.field :$label :$name>  
    @if($type === 'textarea')
        <textarea {{ $attributes($defaults) }} rows="5">{{ old($name) }}</textarea>
    @elseif ($type === 'password')
        <div x-data="{ show: false }" class="relative">
            <input
                :type="show ? 'text' : 'password'"
                {{ $attributes($defaults) }}
                class="{{ $defaults['class'] }} pr-12"
            >

            <button
                type="button"
                @click="show = !show"
                class="absolute inset-y-0 right-4 flex items-center text-gray-500 cursor-pointer"
                tabindex="-1"
            >
                <img x-show="!show" x-cloak src="{{ asset('icons/eye-show.svg') }}" class="w-5 h-5 text-gray-500">
                <img x-show="show" x-cloak src="{{ asset('icons/eye-hide.svg') }}" class="w-5 h-5 text-gray-500">
            </button>
        </div>
    @else
        <input type="{{ $type }}" {{ $attributes($defaults) }}>
    @endif
</x-forms.field>