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
<label class='flex items-center p-4 bg-bg-surface border border-brand rounded-xl cursor-pointer hover:border-brand-hover'>
    <input type='hidden' name='{{ $name }}' value='0'>
    <input {{ $attributes($defaults) }} @checked(old($name)) class='h-5 w-5 rounded-lg ltr:mr-3 rtl:ml-3 accent-brand-hover'>
    <span class='font-bold'>{{ $label }}</span>
</label>