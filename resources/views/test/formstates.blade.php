<x-layout.page header="Form fields" with-navigation="{{ true }}">

    <div class="flex min-h-full flex-col justify-start">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Input fields</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="#" method="post">
                @csrf
                <div>
                    <label for="email" class="cr-form-label">E-mail</label>
                    <div class="cr-form-input">
                        <input id="email" name="email" type="email" autocomplete="email" required value="zsamboki.roland@gmail.com" />
                        <div class="cr-icon">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="cr-form-label">Focused:</div>
                    <div class="cr-form-input cr-state-focused">
                        <input id="email" name="email" type="email" autocomplete="email" required value="zsamboki.roland@gmail.com" />
                        <div class="cr-icon">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="cr-form-label">Loading:</div>
                    <div class="cr-form-input cr-state-loading">
                        <input id="email" name="email" type="email" autocomplete="email" required value="zsamboki.roland@gmail.com" />
                        <div class="cr-icon">
                            <x-loader.ring />
                        </div>
                    </div>
                </div>

                <div>
                    <div class="cr-form-label">Loading, disabled:</div>
                    <div class="cr-form-input cr-state-disabled">
                        <input id="email" name="email" type="email" autocomplete="email" required disabled value="zsamboki.roland@gmail.com" />
                        <div class="cr-icon">
                            <x-loader.ring />
                        </div>
                    </div>
                </div>

                <div>
                    <div class="cr-form-label">Error:</div>
                    <div class="cr-form-input cr-state-invalid">
                        <input id="email" name="email" type="email" autocomplete="email" required value="zsamboki.roland@gmail.com" />
                        <div class="cr-icon">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>
                    </div>
                    <div class="cr-form-message">Not a valid e-mail address.</div>
                </div>

                <div>
                    <div class="cr-form-label">Error, disabled:</div>
                    <div class="cr-form-input cr-state-invalid cr-state-disabled">
                        <input id="email" name="email" type="email" autocomplete="email" required disabled value="zsamboki.roland@gmail.com" />
                        <div class="cr-icon">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>
                    </div>
                    <div class="cr-form-message">Not a valid e-mail address.</div>
                </div>

                <div>
                    <div class="cr-form-label">Success:</div>
                    <div class="cr-form-input cr-state-success">
                        <input id="email" name="email" type="email" autocomplete="email" required value="zsamboki.roland@gmail.com" />
                        <div class="cr-icon">
                            <i class="fa-solid fa-check"></i>
                        </div>
                    </div>
                    <div class="cr-form-message">This e-mail address is available.</div>
                </div>

                <div>
                    <div class="cr-form-label">Success, disabled:</div>
                    <div class="cr-form-input cr-state-success cr-state-disabled">
                        <input id="email" name="email" type="email" autocomplete="email" required disabled value="zsamboki.roland@gmail.com" />
                        <div class="cr-icon">
                            <i class="fa-solid fa-check"></i>
                        </div>
                    </div>
                    <div class="cr-form-message">This e-mail address is available.</div>
                </div>

                <div>
                    <button type="button" class="cr-form-button">Next</button>
                </div>

                <div>
                    <button type="submit" disabled class="cr-form-button">Next (disabled)</button>
                </div>

                {{--<div>
                    <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">Password</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" />
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Register</button>
                </div>--}}
            </form>
        </div>
    </div>

</x-layout.page>
