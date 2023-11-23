@props([
    "name" => "password",
    "label" => "Password",
    "value" => "",
    "validated" => false,
    "update" => "submit",
    "showLoading" => false
])
<x-forms.input.text
    :name="$name"
    :label="$label"
    :value="$value"
    :validated="$validated"
    :update="$update"
    :show-loading="$showLoading"
    type="password"
    {{ $attributes->merge(['autocomplete' => 'current password']) }}
>
    <x-slot:icon>
        <i class="fa-solid fa-key"></i>
    </x-slot:icon>
    @isset($iconValidated)
        <x-slot:icon-validated>
            {{ $iconValidated }}
        </x-slot:icon-validated>
    @endisset
    @isset($upperControls)
        <x-slot:upper-controls>
            {{ $upperControls }}
        </x-slot:upper-controls>
    @endisset
    {{ $slot }}
</x-forms.input.text>
