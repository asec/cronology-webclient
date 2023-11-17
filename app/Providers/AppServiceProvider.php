<?php

namespace App\Providers;

use App\Services\Cronology\Api;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Api::class, function (Application $application) {
            return new Api(config("cronology"));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive("datetime", function (string $expression) {
            return '<?php echo \Carbon\Carbon::parse(' . $expression . ')->setTimezone("Europe/Budapest")->format("Y-m-d H:i:s") ?>';
        });

        Blade::stringable(function (\DateTime $dateTime) {
            return Carbon::parse($dateTime)->setTimezone("Europe/Budapest")->format("Y-m-d H:i:s");
        });

        Schema::defaultStringLength(191);
    }
}
