<form class="space-y-6" wire:submit="save" method="post">
    @csrf

    <div>
        <label for="email" class="cr-form-label">E-mail</label>
        <div
            class="cr-form-input @error('email') cr-state-invalid @enderror @if($isEmailSet) cr-state-success @endif"
            wire:loading.remove.class="cr-state-invalid"
            wire:dirty.class="cr-dirty"
            wire:target="email"
        >
            <input id="email" name="email" type="email" autocomplete="email" autofocus wire:model.blur="email" value="{{ $email }}" />
            <div class="cr-icon">
                <i
                    class="@unless($isEmailSet) fa-regular fa-envelope @else fa-solid fa-check @endif"
                    wire:loading.remove
                    wire:target="email"
                ></i>
                <x-loader.ring wire:loading wire:target="email" />
            </div>
        </div>
        @error("email")
            <div class="cr-form-message" wire:dirty.remove wire:target="email">
                <span wire:loading.remove wire:target="email">{{ $message }}</span>
            </div>
        @enderror
    </div>

    @if($isEmailSet)
    <div>
        <label for="password" class="cr-form-label">Password</label>
        <div
            class="cr-form-input @error('password') cr-state-invalid @enderror @if($isConfirmationSet) cr-state-success @endif"
            wire:loading.remove.class="cr-state-invalid"
            wire:dirty.class="cr-dirty"
            wire:target="password"
        >
            <input id="password" name="password" type="password" autocomplete="current password" wire:model.blur="password" value="{{ $password }}" />
            <div class="cr-icon">
                <i
                    class="@unless($isConfirmationSet) fa-solid fa-key @else fa-solid fa-check @endif"
                    wire:loading.remove
                    wire:target="password"
                ></i>
                <x-loader.ring wire:loading wire:target="password" />
            </div>
        </div>
        @error("password")
        <div class="cr-form-message" wire:dirty.remove wire:target="password">
            <span wire:loading.remove wire:target="password">{{ $message }}</span>
        </div>
        @enderror
    </div>
    @endif

    @if($isPasswordSet)
    <div>
        <label for="confirmPassword" class="cr-form-label">Password confirmation</label>
        <div
            class="cr-form-input @error('confirmPassword') cr-state-invalid @enderror @if($isConfirmationSet) cr-state-success @endif"
            wire:loading.remove.class="cr-state-invalid"
            wire:dirty.class="cr-dirty"
            wire:target="confirmPassword"
        >
            <input id="confirmPassword" name="confirmPassword" type="password" autocomplete="off" wire:model.blur="confirmPassword" value="{{ $confirmPassword }}" />
            <div class="cr-icon">
                <i
                    class="@unless($isConfirmationSet) fa-solid fa-key @else fa-solid fa-check @endif"
                    wire:loading.remove
                    wire:target="confirmPassword"
                ></i>
                <x-loader.ring wire:loading wire:target="confirmPassword" />
            </div>
        </div>
        @error("confirmPassword")
        <div class="cr-form-message" wire:dirty.remove wire:target="confirmPassword">
            <span wire:loading.remove wire:target="confirmPassword">{{ $message }}</span>
        </div>
        @elseif(!$isConfirmationSet)
        <div class="cr-form-message">
            Please enter your chosen password again to confirm it.
        </div>
        @enderror
    </div>
    @endif

    <div>
        <button type="submit" class="cr-form-button">
            @if($isPasswordSet)
                Register
            @else
                Next
            @endif
        </button>
    </div>

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

</form>
