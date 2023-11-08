<?php
/**
 * @type string|null $text
 */
?><div class="flex items-center">

    <div role="status">
        <x-loader.ring class="mr-2" />
        <span class="sr-only">Loading...</span>
    </div>
    {{ $text ?? "" }}

</div>
