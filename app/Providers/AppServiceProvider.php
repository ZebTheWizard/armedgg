<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      // \Config::set("navigation.test", "fdsa");
      view()->composer('*', function($view){
          view()->share('v', function ($name, $e='is-active') use($view) {
            return $view->getName() === $name ? $e : '';
          });
          view()->share('nv', function ($name, $e='is-active') use($view) {
            return $view->getName() !== $name ? $e : '';
          });
      });

      \Illuminate\Support\Collection::macro('recursive', function () {
          return $this->map(function ($value) {
              if (is_array($value) || is_object($value)) {
                  return collect($value)->recursive();
              }

              return $value;
          });
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
