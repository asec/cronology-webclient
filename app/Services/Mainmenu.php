<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Mainmenu
{
    protected array $items = [];

    public function __construct()
    {
        if (Auth::check())
        {
            $this->generateUserMenu();
        }
        else
        {
            $this->generateGuestMenu();
        }
    }

    protected function generateGuestMenu(): void
    {
        $this->addItems([
            "Dashboard" => "home",
            "Login" => "user.login",
            "Register" => "user.register",
        ]);
    }

    protected function generateUserMenu(): void
    {
        $this->addItems([
            "Dashboard" => "home",
            "Profile" => "user.profile",
            "Logout" => "user.logout",
        ]);
    }

    protected function addItem(string $name, string $route): void
    {
        $this->items[$name] = [
            "route" => $route,
            "url" => route($route),
            "active" => count($this->items) === 0
        ];
    }

    protected function addItems(array $items): void
    {
        foreach ($items as $name => $route)
        {
            $this->addItem($name, $route);
        }
    }

    protected function refreshActiveState(): void
    {
        $currentRoute = Route::current()->getName();
        foreach ($this->items as &$item)
        {
            $item["active"] = $currentRoute === $item["route"];
        }
    }

    public function getItems(): array
    {
        $this->refreshActiveState();
        return $this->items;
    }
}
