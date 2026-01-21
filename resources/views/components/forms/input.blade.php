@props(['label', 'name', 'type' => 'text', 'strength' => false])

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

<x-forms.field :$label :$name {{ $attributes }}>  
    @if($type === 'textarea')
        <textarea {{ $attributes($defaults) }} rows="5">{{ old($name) }}</textarea>
    @elseif ($type === 'password')
        <div x-data="{ show: false,
                       password: '',
                       hasLower() { return /[a-z]/.test(this.password) },
                       hasUpper() { return /[A-Z]/.test(this.password) },
                       hasNumber() { return /[0-9]/.test(this.password) },
                       hasSymbol() { return /[^A-Za-z0-9]/.test(this.password) },
                       longEnough() { return this.password.length >= 8 } 
                     }" 
             class="relative">
            <input
                :type="show ? 'text' : 'password'"
                {{ $attributes($defaults) }}
                x-model="password"
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

            @if ($strength)
                <div x-show="password.length" class="text-sm mt-1, ml-3">
                    <span
                        x-show="!longEnough() || !(hasLower() || hasUpper()) || !hasNumber()"
                        class="text-red-500"
                    >
                        Weak - use at least 8 characters, letters, and numbers
                    </span>
                    <span
                        x-show="
                            longEnough()
                            && (hasLower() || hasUpper())
                            && hasNumber()
                            && !(hasLower() && hasUpper() && hasSymbol())
                        "
                        class="text-yellow-500"
                    >
                        Medium - add symbols and mixed case
                    </span>
                    <span
                        x-show="
                            longEnough()
                            && hasLower()
                            && hasUpper()
                            && hasNumber()
                            && hasSymbol()
                        "
                        class="text-green-500"
                    >
                        Strong - meets recommended strength
                    </span>
                </div>
            @endif
        </div>
    @else
        <input type="{{ $type }}" {{ $attributes($defaults) }}>
    @endif
</x-forms.field>