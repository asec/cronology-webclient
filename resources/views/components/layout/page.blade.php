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
        {{ $slot }}
    </x-layout.partial.main>
</div>

</body>
</html>
