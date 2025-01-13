<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        $commonValue = [
            1=>"利用中",
            2=>"登録中",
            3=>"登録待"
        ]; //  追加
        view()->share('commonValue', $commonValue); //  追加
        $displayValue = [
            0=>"非公開",
            1=>"公開",
        ]; //  追加
        view()->share('displayValue', $displayValue); //  追加

    }
}
