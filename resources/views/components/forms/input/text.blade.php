@props([
    "name" => "field",
    "label" => "Label",
    "value" => "",
    "validated" => false,
    "update" => "submit",
    "showLoading" => false
])
<div>
    <div class="flex justify-between items-center">
        <label for="{{ $name }}" class="cr-form-label">{{ $label }}</label>
        {{ $upperControls ?? "" }}
    </div>
    <div
        class="
            cr-form-input
            @error($name)
                cr-state-invalid
            @elseif($validated && $validated !== "false")
                cr-state-success
            @elseif($validated === "false")
                cr-state-invalid
            @enderror
        "
        {{--wire:loading.class.remove="cr-state-invalid"--}}
        wire:dirty.class="cr-dirty"
        wire:target="{{ $name }}"
    >
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $attributes->merge(["type" => "text"]) }}
            @if($update === "submit")
                wire:model="{{ $name }}"
            @elseif($update === "blur")
                wire:model.blur="{{ $name }}"
            @endif
            value="{{ $value }}"
        />
        @isset($icon)
            <div class="cr-icon">
                <span class="inline-flex" @if($showLoading) wire:loading.remove wire:target="{{ $name }}" @endif >
                    @if($validated && $validated !== "false")
                        <span class="inline-flex" wire:dirty.remove wire:target="{{ $name }}">
                            @isset($iconValidated)
                                {{ $iconValidated }}
                            @else
                                <i class="fa-solid fa-check"></i>
                            @endisset
                        </span>
                        <span class="cr-hidden" wire:dirty.class="cr-dirty" wire:target="{{ $name }}">
                            {{ $icon }}
                        </span>
                    @elseif($validated === "false")
                        <span class="inline-flex" wire:dirty.remove wire:target="{{ $name }}">
                            @isset($iconInvalidated)
                                {{ $iconInvalidated }}
                            @else
                                <i class="fa-solid fa-circle-exclamation"></i>
                            @endisset
                        </span>
                        <span class="cr-hidden" wire:dirty.class="cr-dirty" wire:target="{{ $name }}">
                            {{ $icon }}
                        </span>
                    @else
                        {{ $icon }}
                    @endif
                </span>
                @if($showLoading)
                    <x-loader.ring wire:loading wire:target="{{ $name }}" />
                @endif
            </div>
        @elseif($showLoading)
            <div class="cr-icon" wire:loading wire:target="{{ $name }}">
                <x-loader.ring />
            </div>
        @endisset
    </div>
    @error($name)
        <div class="cr-form-message" wire:dirty.remove wire:target="{{ $name }}">
            <span {{--wire:loading.remove--}}>{{ $message }}</span>
        </div>
    @elseif($slot)
        <div class="cr-form-message">
            {{ $slot }}
        </div>
    @enderror
</div>
