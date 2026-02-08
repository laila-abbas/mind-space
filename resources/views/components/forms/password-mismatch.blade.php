<p
    x-show="password && passwordConfirmation && password !== passwordConfirmation"
    x-transition.opacity
    class="text-sm text-red-500 mt-1 ml-3"
    {{-- for screen reader --}}
    role="alert"
    aria-live="polite"
>
    {{ __('passwords.mismatch') }}
</p>