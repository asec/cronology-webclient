<form class="space-y-6" wire:submit="save" method="post">
    <x-forms.input.text name="id" label="User ID" :value="$id" disabled>
        <x-slot:icon>
            <i class="fa-regular fa-user"></i>
        </x-slot:icon>
    </x-forms.input.text>

    <x-forms.input.text
        name="accessToken"
        label="Access Token"
        :value="$accessToken"
        readonly
    >
        <x-slot:icon>
            <i class="fa-regular fa-address-card fa-sm"></i>
        </x-slot:icon>
        <x-slot:upper-controls>
            <div class="inline-flex">
                <a
                    href="javascript:void(0)"
                    title="Copy Access Token"
                    class="mr-2 text-blue-500 hover:text-blue-600"
                    wire:click.prevent="$dispatch('copy:accessToken', $event)"
                    action-copy
                >
                    <span class="default-action">
                        <i class="fa-regular fa-copy"></i>
                        <span class="text-xs">Copy</span>
                    </span>
                    <span class="copied-result hidden">
                        <i class="fa-solid fa-check"></i>
                        <span class="text-xs">Copied!</span>
                    </span>
                </a>
                <a
                    href="javascript:void(0)"
                    title="Regenerate Access Token"
                    class="mr-2 text-green-500 hover:text-green-600"
                    wire:click.prevent="generateAccessToken"
                    wire:loading.attr="disabled"
                >
                    <i class="fa-solid fa-rotate-right"></i>
                    <span class="text-xs">Generate</span>
                </a>
            </div>
        </x-slot:upper-controls>
    </x-forms.input.text>

    <x-forms.input.text
        name="accessTokenValid"
        label="Access Token Validity"
        :value="$accessTokenValid"
        :validated="$isAccessTokenValid ?: 'false'"
        readonly
    >
        <x-slot:icon>
            <i class="fa-regular fa-clock"></i>
        </x-slot:icon>
    </x-forms.input.text>

    <div class="cr-form-action">
        <button type="submit" class="cr-form-button" wire:loading.attr="disabled">Update</button>
    </div>

    @csrf

    <script>
        document.addEventListener("livewire:initialized", () => {
            let timerId = null;
            let link = null;
            let defaultAction = null;
            let copiedResult = null;

            @this.on("access-token-generated", () => {
                /*setTimeout(() => {
                    @this.dispatch("copy:accessToken");
                }, 100);*/
            });

            @this.on("copy:accessToken", (event) => {
                const element = document.getElementById("accessToken");
                if (!element)
                {
                    return;
                }
                element.select();
                element.setSelectionRange(0, 99999);
                navigator.clipboard.writeText(element.value);
                element.blur();

                cacheElements(event);

                switchStateToConfirmed();
                clearTimeout(timerId);
                timerId = setTimeout(() => {
                    switchStateToOriginal();
                }, 2000);
            });

            function cacheElements(event)
            {
                if (link === null)
                {
                    link = event && event.target ? event.target.closest("a") : document.querySelector("[action-copy]");
                }
                if (link && defaultAction === null)
                {
                    defaultAction = link.querySelector(".default-action");
                }
                if (link && copiedResult === null)
                {
                    copiedResult = link.querySelector(".copied-result");
                }
            }

            function switchStateToConfirmed()
            {
                if (defaultAction)
                {
                    defaultAction.classList.add("hidden");
                }
                if (copiedResult)
                {
                    copiedResult.classList.remove("hidden");
                }
                if (link)
                {
                    link.classList.remove("text-blue-500");
                    link.classList.remove("hover:text-blue-600");
                    link.classList.add("text-gray-300");
                }
            }

            function switchStateToOriginal()
            {
                if (defaultAction)
                {
                    defaultAction.classList.remove("hidden");
                }
                if (copiedResult)
                {
                    copiedResult.classList.add("hidden");
                }
                if (link)
                {
                    link.classList.remove("text-gray-300");
                    link.classList.add("text-blue-500");
                    link.classList.add("hover:text-blue-600");
                }
            }
        });
    </script>
</form>
