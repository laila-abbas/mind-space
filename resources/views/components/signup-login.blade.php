@props(['center' => false])

@php
    $extraClass = $center ? 'text-center' : '';
@endphp

<a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-brand-accent text-bg-surface font-semibold hover:bg-brand-accent-hover transition {{ $extraClass }}">
    {{ __('home.signup') }}
</a>
<a href="{{ route('login') }}" class="px-4 py-2 rounded-lg border border-brand-accent text-brand-accent font-semibold hover:bg-brand-accent hover:text-bg-surface transition duration-300 {{ $extraClass }}">
    {{ __('home.login') }}
</a>
