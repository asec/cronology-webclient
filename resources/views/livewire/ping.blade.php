<?php
/**
 * @type string $error
 * @type string $version
 * @type string $loadingText
 */
?><div>
    <div class="text-sm" wire:loading.remove>
        @if ($error)
            <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-bold text-red-700 ring-1 ring-inset ring-red-600/10">
                Error
            </span>
            {{ $error }}
        @else
            <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-bold text-green-700 ring-1 ring-inset ring-green-600/20">
                Success
            </span>
            {{ $version }}
        @endif
        <button
            type="button"
            class="rounded-md bg-blue-600 px-3 py-1 text-xs font-semibold text-white ml-4 hover:bg-blue-400"
            wire:click="$refresh"
        >
            Ping!
        </button>
    </div>

    <div wire:loading class="flex items-center">
        @include("livewire.placeholders.default", [
            "text" => $loadingText
        ])
    </div>

    @isset($_instance)
    <script type="text/javascript">
        document.addEventListener("livewire:initialized", () => {
            setInterval(() => {
                @this.dispatchSelf("refresh");
            }, 500);
        });
    </script>
    @endisset
</div>
