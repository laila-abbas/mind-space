@props(['label', 'name'])

@php
    $defaults = [
        'type' => 'checkbox',
        'id' => $name,
        'name' => $name,
        'value' => '1'
    ];
@endphp
{{-- @checked would be overriden if used with alpine x-model --}}
<label class='flex items-center p-4 bg-white border border-primary rounded-xl cursor-pointer hover:border-secondary'>
    <input type='hidden' name='{{ $name }}' value='0'>
    <input {{ $attributes($defaults) }} @checked(old($name)) class='h-5 w-5 rounded-lg mr-3 accent-secondary'>
    <span class='font-bold'>{{ $label }}</span>
</label>