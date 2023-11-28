<div class="text-md" wire:poll>
    @if($status === null)
        <a href="{{ route("api.status") }}" title="API status: Connecting" class="text-slate-400">
            <i class="fa-solid fa-circle"></i>
        </a>
    @elseif ($status)
        <a href="{{ route("api.status") }}" title="API status: Ok{{ $version ? ", " . $version : "" }}" class="text-lime-400">
            <i class="fa-solid fa-circle"></i>
        </a>
    @else
        <a href="{{ route("api.status") }}" title="API status: Offline" class="text-red-400">
            <i class="fa-solid fa-circle"></i>
        </a>
    @endif
</div>
