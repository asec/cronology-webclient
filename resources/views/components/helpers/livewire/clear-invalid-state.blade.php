@props([
    "event" => "save-success"
])
<script>
    document.addEventListener("livewire:initialized", () => {
        @this.on("{{ $event }}", () => {
            document.querySelectorAll(".cr-form-input").forEach(element => {
                element.classList.remove("cr-state-invalid");
            });
        });
    });
</script>
