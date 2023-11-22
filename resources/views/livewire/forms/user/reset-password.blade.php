<form class="space-y-6" wire:submit="save" method="post">
    @csrf
    <x-info.flashed.error />

    <x-forms.input.email :value="$email" required />

    <x-forms.input.password :value="$password" autofocus required />

    <x-forms.input.password
        name="password_confirmation"
        label="Confirm new password"
        :value="$password_confirmation"
        required
        autocomplete="off"
    />

    <div>
        <button type="submit" class="cr-form-button">Create</button>
    </div>

    <x-helpers.livewire.clear-invalid-state />
</form>
