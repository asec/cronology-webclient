<?php
/**
 * @type string $error
 * @type string $version
 */
?><div>
    @if ($error)
        <div class="text-sm">
                    <span
                        class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-bold text-red-700 ring-1 ring-inset ring-red-600/10">Error</span>
            {{ $error }}
        </div>
    @else
        <div class="text-sm">
                    <span
                        class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-bold text-green-700 ring-1 ring-inset ring-green-600/20">Success</span>
            {{ $version }}
        </div>
    @endif
</div>
