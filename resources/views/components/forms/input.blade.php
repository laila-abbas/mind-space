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
        <textarea 
            id="{{ $name }}" 
            name="{{ $name }}" 
            rows="5"
            {{ $attributes($defaults) }}
        >{{ old($name) }}</textarea>
    @else
        <input {{ $attributes($defaults) }}>
    @endif
</x-forms.field>