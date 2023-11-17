<?php

namespace App\Livewire\Forms\User;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Login extends Component
{
    #[Rule(["required", "string", "lowercase"])]
    public string $email;
    #[Rule(["required", "string"])]
    public string $password;

    protected function prepareForValidation($attributes)
    {
        $attributes["email"] = Str::lower($attributes["email"]);
        return $attributes;
    }

    public function save(): void
    {
        $validated = $this -> validate();
        $this->email = Str::lower($validated["email"]);

        $throttleKey = Str::transliterate($this->email . "|" . request()->ip());
        if (RateLimiter::tooManyAttempts($throttleKey, 5))
        {
            $seconds = RateLimiter::availableIn($throttleKey);
            /*session()->flash("error", trans("auth.throttle", [
                "seconds" => $seconds,
                "minutes" => ceil($seconds / 60)
            ]));
            return;*/
            throw ValidationException::withMessages([
                "email" => trans("auth.throttle", [
                    "seconds" => $seconds,
                    "minutes" => ceil($seconds / 60)
                ])
            ]);
        }

        if (!Auth::attempt(["email" => $this->email, "password" => $validated["password"]], true))
        {
            RateLimiter::hit($throttleKey);

            //session()->flash("error", trans("auth.failed"));
            //return;
            throw ValidationException::withMessages([
                "email" => trans("auth.failed")
            ]);
        }

        session()->regenerate();
        $this->dispatch("login-success");
        $this->redirect(session("url.intended", RouteServiceProvider::HOME), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.forms.user.login');
    }
}
