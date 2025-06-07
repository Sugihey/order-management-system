<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\UseCase\CompanyInfoUseCase;

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
        try {
            $companyInfo = CompanyInfoUseCase::get();
            if ($companyInfo) {
                config(['CompanyName'=> $companyInfo->name]);
            }
        } catch (\Exception $e) {
            config(['CompanyName'=> 'エス・クラフト']);
        }
    }
}
