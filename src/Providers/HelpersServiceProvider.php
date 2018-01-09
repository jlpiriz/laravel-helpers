<?php

namespace Jlpiriz\LaravelHelpers\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class HelpersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Package settings.
        $this->publishes([
            __DIR__.'/../config/jhelpers.php' => config_path('jhelpers.php'),
        ], 'config');

        $defines = $this->app['config']->get('jhelpers.defines') ?: [];
        foreach ($defines as $key => $value) 
        {
            $this->define($key, $value);
        }

        // Example of config.
        if($this->app['config']->get('jhelpers.show_messages', false)) 
            echo "This is ServideProvider of jlpiriz/laravel-helpers";
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerHelpers();

        $this->mergeConfigFrom(__DIR__ . '/../config/jhelpers.php', 'jhelpers');
    }

    /**
     * Register the Helpers files.
     */
    private function registerHelpers()
    {
        $AliasLoader = AliasLoader::getInstance();
        foreach (glob(__DIR__.'/../Helpers/*.php') as $filename) 
        {
            require_once($filename);
            $className = basename($filename, ".php");
            $AliasLoader->alias($className, 'Jlpiriz\LaravelHelpers\Helpers\\'.$className);
        } 
    }  
    
    /**
     * Define a value, if not already defined.
     * 
     * @param string $name
     * @param string $value
     */
    protected function define($name, $value)
    {
        if (!defined($name)) 
        {
            define($name, $value);
        }
    }
          
}
