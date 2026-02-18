@props(['mobile' => true])

@php
    $extraClass = $mobile ? '' : 'text-sm font-medium text-text-muted';    
@endphp

<form method="POST" action="/logout">
    @csrf
    <button 
        type="submit"
        class="group flex items-center gap-2 w-full text-start px-4 py-2.5 hover:bg-red-50 hover:text-red-500 rounded-lg transition-all duration-200 cursor-pointer {{ $extraClass }}"
    >
        <x-lucide-log-out class="w-4 h-4"/>
        <span>{{ __('home.logout') }}</span>
    </button>
</form>