<?php
use App\Services\Utils;
?><form class="space-y-6" method="post" wire:poll>
    <x-forms.input.text
        name="schedule"
        :value="$schedule"
        update="live.debounce.250ms"
        autofocus
        placeholder="Example: now"
        class="text-center font-semibold cr-big"
    >
        <x-slot:upper-controls>
            <a
                href="javascript:void(0)"
                class="text-neutral-400 font-bold hover:text-blue-400 text-xs"
                wire:click.prevent="toggleUtc"
            >
                @if($showUtc)
                    Show in local time
                @else
                    Show in UTC
                @endif
            </a>
        </x-slot:upper-controls>
    </x-forms.input.text>

    @if($schedule && $now)
        <div class="p-6 text-sm">
            <div class="py-2">
                <span class="font-bold">Now:</span>
                {{ $showUtc ? Utils::formatDate($now, true) . " (UTC)" : $now }}
            </div>
            @foreach($dates as $date)
                @if($loop->first)
                    <div class="border-l-2 border-lime-400 px-3 pl-5 py-3 relative flex justify-between items-center text-lg font-bold">
                        <div class="absolute -left-[9px] text-lg">
                            <i class="fa-regular fa-circle bg-white text-lime-400"></i>
                        </div>
                        {{ $showUtc ? Utils::formatDate($date, true) . " (UTC)" : $date }}
                    </div>
                @elseif($loop->index === 1)
                    <div class="border-l-2 border-sky-400 px-3 pl-4 py-2 relative flex items-center text-md font-semibold">
                        <div class="absolute -left-[9px] text-lg">
                            <i class="fa-regular fa-circle bg-white text-sky-400"></i>
                        </div>
                        {{ $showUtc ? Utils::formatDate($date, true) . " (UTC)" : $date }}
                    </div>
                @else
                    <div class="border-l-2 border-slate-300 px-3 py-2 relative flex items-center">
                        <div class="absolute -left-[7px] text-md">
                            <i class="fa-regular fa-circle bg-white text-slate-300"></i>
                        </div>
                        {{ $showUtc ? Utils::formatDate($date, true) . " (UTC)" : $date }}
                    </div>
                @endif
            @endforeach
        </div>
    @endif

    @csrf
</form>
