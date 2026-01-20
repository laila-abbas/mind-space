@props(['label', 'name'])

@php
    $defaults = [
        'type' => 'checkbox',
        'id' => $name,
        'name' => $name,
    ];
@endphp

<label class="flex items-center p-4 bg-white border border-primary rounded-xl cursor-pointer hover:border-secondary">
    <input {{ $attributes($defaults) }} class="h-5 w-5 rounded-lg mr-3 accent-secondary">
    <span class="font-bold">Sign up as an Author</span>
</label>