@props([
    'label' => null,
    'name' => null,
    'class' => null,
    "required" => false
])

<div class="w-full {{ $class }}">
    @if($label)
        <label for="{{ $name }}" class="font-semibold text-sm">
            {{$label}}@if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    <select
        name="{{ $name }}"
        {{ $attributes->merge(["class" => "mt-1 flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"]) }}
    >
        {{ $slot }}
    </select>
</div>
