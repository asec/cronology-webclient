<?php
/**
 * @type string $title
 * @type bool $withNavigation
 * @type string $header
 * @type string $slot
 */
?><!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? env("APP_NAME") }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full">

<div class="min-h-full flex flex-col">
    @if ($withNavigation)
        <x-layout.partial.navigation />
    @endif

    <x-layout.partial.header :text="$header ?? ''" />

    <x-layout.partial.main>

        @if (session("error"))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium">Error:</span> {{ session("error") }}
            </div>
        @endif
        @if (session("success"))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                {{ session("success") }}
            </div>
        @endif

        {{ $slot }}
    </x-layout.partial.main>
</div>

</body>
</html>
