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

<x-forms.field 
    :$label 
    :$name 
    {{ $attributes }}
>  
    @if($type === 'textarea')
        <textarea 
            {{ $attributes($defaults) }} 
            rows="5"
        >
            {{ old($name) }}
        </textarea>

    @elseif ($type === 'password')
        <div 
            x-data="{ show: false,
                       value: '',
                       hasLower() { return /[a-z]/.test(this.value) },
                       hasUpper() { return /[A-Z]/.test(this.value) },
                       hasNumber() { return /[0-9]/.test(this.value) },
                       hasSymbol() { return /[^A-Za-z0-9]/.test(this.value) },
                       longEnough() { return this.value.length >= 8 } 
                    }" 
            x-modelable="value"
            {{ $attributes }}
        >
             <div 
                class='relative'
             >  
                <input
                    :type="show ? 'text' : 'password'"
                    {{ $attributes($defaults) }}
                    x-model="value"
                    class="{{ $defaults['class'] }} pr-12"
                >
                <button
                    type="button"
                    @click="show = !show"
                    class="absolute inset-y-0 right-4 cursor-pointer"
                    tabindex="-1" {{-- tab key won't focus on it --}}
                >
                    <img 
                        x-show="!show" 
                        x-cloak src="{{ asset('icons/eye-show.svg') }}" 
                        class="w-5 h-5"
                    >
                    <img 
                        x-show="show" 
                        x-cloak 
                        src="{{ asset('icons/eye-hide.svg') }}" 
                        class="w-5 h-5"
                    >
                </button>
            </div>

            @if ($strength)
                <div 
                    x-show="value.length" 
                    class="text-sm mt-1 ml-3"
                >
                    <span
                        x-show="!longEnough() || !(hasLower() || hasUpper()) || !hasNumber()"
                        class="text-red-500"
                    >
                        Weak - password must be at least 8 characters, letters, or numbers
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
        <input 
            type="{{ $type }}" 
            {{ $attributes($defaults) }}
        >
    @endif
</x-forms.field>