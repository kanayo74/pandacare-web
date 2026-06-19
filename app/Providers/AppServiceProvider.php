<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(app_path('Models')));

        foreach ($iterator as $file) {
            if ($file->getExtension() !== 'php') {
                continue;
            }

            // Build the fully qualified class name from the path
            $relative = str_replace(app_path().'/', '', $file->getPathname());
            $class = 'App\\'.str_replace(['/', '.php'], ['\\', ''], $relative);
            $alias = $file->getBasename('.php');

            if (class_exists($class)) {
                class_alias($class, $alias);
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
