@props(['method' => 'POST'])

<form
    method="{{ strtoupper($method) === 'GET' ? 'GET' : 'POST' }}"
    {{ $attributes->except('method')->merge(['class' => 'max-w-2xl mx-auto space-y-6']) }}
>
    @if (strtoupper($method) !== 'GET')
        @csrf
        @method($method)
    @endif

    {{ $slot }}
</form>
