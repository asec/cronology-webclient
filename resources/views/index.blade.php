<?php
/**
 * @type PingResponse|ApiError $ping
 * @type AppDataResponse|ApiError $appData
 */

use App\Services\Cronology\Response\ApiError;
use App\Services\Cronology\Response\AppDataResponse;
use App\Services\Cronology\Response\PingResponse;
use Carbon\Carbon;

if (!function_exists("formatDate")) {
    function formatDate(DateTime $date): string
    {
        return Carbon::parse($date)->setTimezone("Europe/Budapest")->format("Y-m-d H:i:s");
    }
}
?><!doctype html>
<html lang="hu-HU" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env("APP_NAME") }}</title>
    @vite('resources/css/app.css')
</head>
<body class="h-full">

<div class="min-h-full flex flex-col">
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                             alt="Cronology">
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="#" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                               aria-current="page">Dashboard</a>
                        </div>
                    </div>
                </div>
                <div class="-mr-2 flex md:hidden">
                    <!-- Mobile menu button -->
                    <button type="button"
                            class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                            aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <!-- Menu open: "hidden", Menu closed: "block" -->
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                        <!-- Menu open: "block", Menu closed: "hidden" -->
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="md:hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="#" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium"
                   aria-current="page">Dashboard</a>
            </div>
        </div>
    </nav>

    <header class="bg-gray-800 pb-24">
        <div class="mx-auto max-w-7xl py-10">
            <h1 class="text-3xl font-bold tracking-tight text-white">Dashboard</h1>
        </div>
    </header>
    <main class="flex grow pb-0 -mt-24 sm:pb-10">
        <div class="grow mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 bg-white rounded">
            Welcome home, good hunter.

            <h2 class="font-semibold text-xl mt-6">Ping:</h2>
            <hr class="my-2"/>
            @if ($ping instanceof ApiError)
                <div class="text-sm">
                    <span
                        class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-bold text-red-700 ring-1 ring-inset ring-red-600/10">Error</span>
                    {{ $ping->error }}
                </div>
            @else
                <div class="text-sm">
                    <span
                        class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-bold text-green-700 ring-1 ring-inset ring-green-600/20">Success</span>
                    {{ $ping->version }}
                </div>
            @endif

            <h2 class="font-semibold text-xl mt-6">Get App Data:</h2>
            <hr class="my-2"/>
            @if ($appData instanceof ApiError)
                <div class="text-sm">
                    <span
                        class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-bold text-red-700 ring-1 ring-inset ring-red-600/10">Error</span>
                    {{ $appData->error }}
                </div>
            @else
                <div class="flex">
                    <span
                        class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-bold text-green-700 ring-1 ring-inset ring-green-600/20">Success</span>
                    <div class="grow rounded-lg ml-4 border border-slate-300 overflow-hidden">
                        <table class="border-collapse w-full text-sm">
                            <thead>
                            <tr>
                                <th class="border border-slate-300 border-t-0 border-l-0 p-2 bg-slate-100 font-semibold">
                                    App Name
                                </th>
                                <th class="border border-slate-300 border-t-0 p-2 bg-slate-100 font-semibold">
                                    App UUID
                                </th>
                                <th class="border border-slate-300 border-t-0 p-2 bg-slate-100 font-semibold">
                                    IP
                                </th>
                                <th class="border border-slate-300 border-t-0 p-2 bg-slate-100 font-semibold">
                                    Created
                                </th>
                                <th class="border border-slate-300 border-t-0 border-r-0 p-2 bg-slate-100 font-semibold">
                                    Modified
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="border border-slate-300 py-3 px-4 border-b-0 border-l-0">
                                    {{ $appData->result->name }}
                                </td>
                                <td class="border border-slate-300 py-3 px-4 border-b-0">
                                    {{ $appData->result->uuid }}
                                </td>
                                <td class="border border-slate-300 py-3 px-4 border-b-0">
                                    @foreach ($appData->result->ip as $ip)
                                        <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">
                                            {{ $ip }}
                                        </span>
                                    @endforeach
                                </td>
                                <td class="border border-slate-300 py-3 px-4 border-b-0">
                                    {{ formatDate($appData->result->created) }}
                                </td>
                                <td class="border border-slate-300 py-3 px-4 border-b-0 border-r-0">
                                    {{ formatDate($appData->result->updated) }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </main>
</div>

</body>
</html>
