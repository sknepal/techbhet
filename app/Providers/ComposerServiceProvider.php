<?php
/**
 * Created by PhpStorm.
 * User: conf
 * Date: 3/13/16
 * Time: 12:05 AM
 */
namespace App\Providers;
use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider{

    public function boot()
    {
        View::composer('*', 'App\Http\Composers\MainComposer');
    }

    public function register()
    {

    }
}