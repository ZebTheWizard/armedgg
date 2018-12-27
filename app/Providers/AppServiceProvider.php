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
      view()->composer('*', function($view){
          view()->share('v', function ($name, $e='is-active') use($view) {
            return $view->getName() === $name ? $e : '';
          });
          view()->share('nv', function ($name, $e='is-active') use($view) {
            return $view->getName() !== $name ? $e : '';
          });
      });
      // Validator::extend('liveurl', function ($attribute, $url) {
      //   if(!$url || !is_string($url)){
      //         return false;
      //   }
      //   if( ! preg_match('/^http(s)?:\/\/[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(\/.*)?$/i', $url) ){
      //       return false;
      //   }
      //   $client = new Client(['http_errors' => false]);
      //   $status = $client->request('GET', $url)->getStatusCode();
      //   return $status === 200;
      // });
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
