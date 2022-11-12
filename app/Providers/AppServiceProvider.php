<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Paginator::useBootstrap();

        Str::macro('moeda', function ($price, $simbolo = 'R$') {
            return $simbolo . ' ' . number_format($price, 2, ',', '.');
        });

        Str::macro('moeda2', function ($value) {
            return str_replace(',', '.', str_replace('.', '', $value));
        });

        Blade::directive('money', function ($amount, $symbol = 'R$') {
            return "<?php echo '{$symbol} ' . number_format({$amount}, 2,',','.'); ?>";
        });

        Blade::directive('money2', function ($amount) {
            return "<?php echo number_format({$amount}, 2,',','.'); ?>";
        });

        Validator::extend('cpfValida', '\App\Src\Utils\CpfValidation@validate');
    }
}
