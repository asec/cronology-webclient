<div {{ $attributes->merge([
    "class" => "cr-form-panel"
]) }}>
    <div class="cr-panel-head">
        <h2 class="cr-form-title">{{ $title ?? "" }}</h2>
    </div>

    {{ $slot }}
</div>
