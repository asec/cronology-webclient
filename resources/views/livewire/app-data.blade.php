<?php
/**
 * @type string $error
 * @type string $name
 * @type string $uuid
 * @type array $ip
 * @type string $created
 * @type string $updated
 */
?><div>
    @if ($error)
        <div class="text-sm">
                    <span
                        class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-bold text-red-700 ring-1 ring-inset ring-red-600/10">Error</span>
            {{ $error }}
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
                            {{ $name }}
                        </td>
                        <td class="border border-slate-300 py-3 px-4 border-b-0">
                            {{ $uuid }}
                        </td>
                        <td class="border border-slate-300 py-3 px-4 border-b-0">
                            @foreach ($ip as $currentIp)
                                <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">
                                    {{ $currentIp }}
                                </span>
                            @endforeach
                        </td>
                        <td class="border border-slate-300 py-3 px-4 border-b-0">
                            {{ $created }}
                        </td>
                        <td class="border border-slate-300 py-3 px-4 border-b-0 border-r-0">
                            {{ $updated }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
