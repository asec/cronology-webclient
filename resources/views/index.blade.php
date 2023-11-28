<x-layout.page header="Dashboard">
    <x-slot:title>
        Home - Cronology
    </x-slot:title>

    @auth
        <x-forms.segment.centered>
            <x-slot:title>Schedule:</x-slot:title>

            <livewire:schedule />
        </x-forms.segment.centered>
    @endauth
    @guest
        Welcome home, good hunter.
    @endguest

</x-layout.page>
