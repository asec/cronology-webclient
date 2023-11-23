<x-layout.page header="New password">

    <x-forms.segment.centered>
        <x-slot:title>Create your new password</x-slot:title>

        <livewire:forms.user.reset-password token="{{ $token }}" />
    </x-forms.segment.centered>

</x-layout.page>
