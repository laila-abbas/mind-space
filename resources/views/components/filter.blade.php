@props(['label', 'name', 'type' => 'text', 'options' => [], 'value' => null])

<div class="flex flex-col gap-1">
    
    <label class="text-xs font-semibold text-text-muted uppercase">
        {{ $label }}
    </label>

    @if ($type === 'select')
        <select
            name="{{ $name }}"
            class="rounded-sm bg-bg-page border border-border-soft px-2 py-1.5 text-sm focus:ring-2 focus:ring-brand-accent focus:outline-none"
        >
            <option value="">All {{ strtolower($label) }}</option>

            @foreach ($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}"
                    {{ request($name) == $optionValue ? 'selected' : '' }}>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>
    @else
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            value="{{ request($name) }}"
            class="rounded-sm bg-bg-page border border-border-soft px-2 py-1.5 text-sm focus:ring-2 focus:ring-brand-accent focus:outline-none"
            {{ $attributes }}
        >
    @endif

</div>