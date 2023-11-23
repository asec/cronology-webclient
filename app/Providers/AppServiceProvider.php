<?php

namespace App\Providers;

use App\Services\Cronology\Api;
use App\Services\Utils;
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
            return '<?php echo App\Services\Utils::formatDate(' . $expression . ') ?>';
        });

        Blade::stringable(function (\DateTime $dateTime) {
            return Utils::formatDate($dateTime);
        });

        Schema::defaultStringLength(191);
    }
}
