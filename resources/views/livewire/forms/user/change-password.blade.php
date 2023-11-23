<form class="space-y-6" method="post" wire:submit="save">

    <x-info.flashed.success />

    <input type="hidden" name="email" value="{{ $email }}" />
    <x-forms.input.password name="currentPassword" label="Current Password" :value="$currentPassword" required />

    <x-forms.input.password name="newPassword" label="New password" :value="$newPassword" required autocomplete="off" />
    <x-forms.input.password name="confirmNewPassword" label="Confirm new password" :value="$confirmNewPassword" required autocomplete="off" />

    <div class="cr-form-action">
        <button type="submit" class="cr-form-button">Update</button>
    </div>

    @csrf
</form>
