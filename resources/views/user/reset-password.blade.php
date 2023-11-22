<x-layout.page header="New password">

    <div class="flex min-h-full flex-col justify-start">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="cr-form-title">Create your new password</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <livewire:forms.user.reset-password token="{{ $token }}" />
        </div>
    </div>

</x-layout.page>
