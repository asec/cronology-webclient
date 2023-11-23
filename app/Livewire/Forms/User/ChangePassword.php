<?php

namespace App\Livewire\Forms\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ChangePassword extends Component
{
    #[Locked]
    public string $email = "";
    #[Rule(["required", "string", "current_password:web"])]
    public string $currentPassword = "";
    #[Rule(["required", "string", "min:12", "max:100", "regex:/[a-z]/u", "regex:/[A-Z]/u", "regex:/\d/", "regex:/\W/"])]
    public string $newPassword = "";
    #[Rule(["required", "string", "same:newPassword"])]
    public string $confirmNewPassword;

    protected function messages(): array
    {
        return [
            "regex" => "The password must contain at least one lowercase character, one uppercase character, one number and one special character."
        ];
    }

    public function mount(Request $request): void
    {
        $this->email = $request->user("web")->email;
    }

    public function save(Request $request): void
    {
        $this->validate();
        /**
         * @type User $user
         */
        $user = $request->user("web");

        $user->update([
            "password" => Hash::make($this->newPassword)
        ]);
        session()->flash("success", "Your password has been updated successfully.");
        $this->reset();
    }

    public function render(): View
    {
        return view('livewire.forms.user.change-password');
    }
}
