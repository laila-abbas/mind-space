@props(['name', 'label', 'asterisk' => false])

<div class="inline-flex items-center gap-x-2">
    <span class="w-2 h-2 bg-brand-accent-2 dark:bg-brand-accent inline-block"></span>
    <label class="font-bold" for="{{ $name }}">
        {{ $label }}
    
        @if ($asterisk)
            <span class="text-red-500" aria-hidden="true">*</span>
            <span class="sr-only">(required)</span> {{-- for screen readers would read "required" instead of asterisk --}}
        @endif
    </label>
</div>