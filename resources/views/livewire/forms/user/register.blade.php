<form class="space-y-6" wire:submit="save" method="post">

    <x-info.flashed.error />

    <x-forms.input.email :value="$email" :validated="$isEmailSet" update="blur" showLoading="true" autofocus />

    @if($isEmailSet)
        <x-forms.input.password :value="$password" :validated="$isPasswordSet" update="blur" showLoading="true" />
    @endif

    @if($isEmailSet && $isPasswordSet)
        <x-forms.input.password
            name="confirmPassword"
            :value="$confirmPassword"
            :validated="$isConfirmationSet"
            update="blur"
            showLoading="true"
            autocomplete="off"
        >
            Please enter your chosen password again to confirm it.
        </x-forms.input.password>
    @endif

    <div class="cr-form-action">
        <button type="submit" class="cr-form-button">
            @if($isPasswordSet)
                Register
            @else
                Next
            @endif
        </button>
    </div>

    @csrf

    <script>
        document.addEventListener("livewire:initialized", () => {
            @this.on("email-updated", event => {
                setTimeout(() => {
                    let el = document.getElementById("password");
                    if (el)
                    {
                        el.focus();
                    }
                }, 10);
            });

            @this.on("password-updated", event => {
                setTimeout(() => {
                    let el = document.getElementById("confirmPassword");
                    if (el)
                    {
                        el.focus();
                    }
                }, 10);
            });
        });
    </script>
    <x-helpers.livewire.clear-invalid-state />

</form>
