<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerBladeDirective();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        $this->bootComponent();
    }

    public function bootComponent(){
        Blade::component('alert', \App\View\Components\Backend\Alert::class);
        Blade::component('delete-confirm', \App\View\Components\Backend\DeleteModelContent::class);
    }

    public function registerBladeDirective(){
        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->role->name == {$role}): ?>";
        });

        Blade::directive('endrole', function () {
            return '<?php endif; ?>';
        });
    }
}
