<x-layout.page header="Dashboard">

    <x-slot:title>
        Home - Cronology
    </x-slot:title>

    Welcome home, good hunter.

    <x-home-section title="Ping:">
        <livewire:ping lazy />
    </x-home-section>

    <x-home-section title="Get App Data:">
        <livewire:app-data lazy />
    </x-home-section>

</x-layout.page>
