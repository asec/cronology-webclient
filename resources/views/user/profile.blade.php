<?php
/**
 * @type \App\Models\User $user
 */
?><x-layout.page header="My Profile">

    <div class="flex min-h-full flex-col justify-start">

        <x-forms.segment.panel>
            <x-slot:title>Account Data</x-slot:title>

            <form class="space-y-6">
                <x-forms.input.email :value="$user->email" disabled />
                @csrf
            </form>
        </x-forms.segment.panel>

        <x-forms.segment.panel>
            <x-slot:title>Password</x-slot:title>

            <livewire:forms.user.change-password />
        </x-forms.segment.panel>

        <x-forms.segment.panel>
            <x-slot:title>Cronology API Data</x-slot:title>

            <livewire:forms.user.api-data />
        </x-forms.segment.panel>
    </div>

</x-layout.page>
