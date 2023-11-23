<form class="space-y-6" wire:submit="save" method="post">

    <x-info.flashed.error />
    <x-info.flashed.success />

    <x-forms.input.email :value="$email" required autofocus>
        Please enter your e-mail address, so we can e-mail you with information on how to reset your password.
    </x-forms.input.email>

    <div class="cr-form-action">
        <button type="submit" class="cr-form-button">Reset</button>
    </div>

    @csrf

    <x-helpers.livewire.clear-invalid-state />

</form>
