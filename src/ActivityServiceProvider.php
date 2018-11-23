<?php

namespace Kishor\Activity;

use Illuminate\Support\ServiceProvider;

class ActivityServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/routes.php';
        $this->publishes([
            __DIR__ . '/config/activitylog.php' => config_path('activitylog.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__ . '/config/activitylog.php', 'activitylog');

        if (!class_exists('CreateActivityLogTable')) {
            $timestamp = date('Y_m_d_His', time());
            $this->publishes([
                __DIR__ . '/migrations/create_activity_log_table.php' => database_path("/migrations/{$timestamp}_create_activity_log_table.php"),
            ], 'migrations');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('activity', 'Kishor\Activity\Activity');
        $this->app->bind('Kishor\Activity\Models\Activity','Kishor\Activity\Models\Activity');
        $this->app->bind('Kishor\Activity\Observer\ActivityObserver','Kishor\Activity\Observer\ActivityObserver');

    }
}
