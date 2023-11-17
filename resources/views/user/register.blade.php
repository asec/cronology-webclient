<x-layout.page header="Register" with-navigation="{{ true }}">

    <div class="flex min-h-full flex-col justify-start">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="cr-form-title">Register an account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <livewire:forms.user.register />
        </div>
    </div>

</x-layout.page>
