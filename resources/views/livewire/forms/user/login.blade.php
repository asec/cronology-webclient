<form class="space-y-6" wire:submit="save" method="post">

    <x-info.flashed.error />

    <x-forms.input.email :value="$email" required />

    <x-forms.input.password :value="$password" required>
        <x-slot:upper-controls>
            <a href="{{ route("user.forgot-password") }}" class="text-blue-500 hover:text-blue-600 font-bold text-sm">Forgot password?</a>
        </x-slot:upper-controls>
    </x-forms.input.password>

    <div>
        <div class="text-sm text-slate-500">
            Dont have an account yet?
            <a href="{{ route("user.register") }}" class="text-blue-500 hover:text-blue-600 font-bold">Sign up here!</a>
        </div>
    </div>

    <div class="cr-form-action">
        <button type="submit" class="cr-form-button">Log in</button>
    </div>

    @csrf

    <x-helpers.livewire.clear-invalid-state event="login-success" />
</form>
