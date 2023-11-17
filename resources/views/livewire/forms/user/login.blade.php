<form class="space-y-6" wire:submit="save" method="post">
    @csrf
    @if (session("error"))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">Error:</span> {{ session("error") }}
        </div>
    @endif

    <div>
        <div>
            <label for="email" class="cr-form-label">E-mail</label>
            <div
                class="cr-form-input @error("email") cr-state-invalid @enderror"
                wire:loading.class.remove="cr-state-invalid"
                wire:dirty.class="cr-dirty"
            >
                <input id="email" name="email" type="email" required autocomplete="email" autofocus wire:model="email" value="{{ $email }}" />
                <div class="cr-icon">
                    <i class="fa-regular fa-envelope"></i>
                </div>
            </div>
            @error("email")
                <div class="cr-form-message" wire:dirty.remove wire:target="email">
                    <span wire:loading.remove>{{ $message }}</span>
                </div>
            @enderror
        </div>
    </div>

    <div>
        <div>
            <div class="flex justify-between items-center">
                <label for="password" class="cr-form-label">Password</label>
                <a href="{{ route("user.login") }}" class="text-blue-500 hover:text-blue-600 font-bold text-sm">Forgot password?</a>
            </div>
            <div
                class="cr-form-input @error("password") cr-state-invalid @enderror"
                wire:loading.class.remove="cr-state-invalid"
                wire:dirty.class="cr-dirty"
            >
                <input id="password" name="password" type="password" required autocomplete="current password" wire:model="password" value="{{ $password }}" />
                <div class="cr-icon">
                    <i class="fa-solid fa-key"></i>
                </div>
            </div>
            @error("password")
            <div class="cr-form-message" wire:dirty.remove wire:target="password">
                <span wire:loading.remove>{{ $message }}</span>
            </div>
            @enderror
        </div>
    </div>

    <div>
        <div class="text-sm text-slate-500">
            Dont have an account yet?
            <a href="{{ route("user.register") }}" class="text-blue-500 hover:text-blue-600 font-bold">Sign up here!</a>
        </div>
    </div>

    <div>
        <button type="submit" class="cr-form-button">Log in</button>
    </div>

    <script>
        document.addEventListener("livewire:initialized", () => {
            @this.on("login-success", () => {
                document.querySelectorAll(".cr-form-input").forEach(element => {
                    element.classList.remove("cr-state-invalid");
                });
            });
        });
    </script>
</form>
