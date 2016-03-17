<?php
/**
 * Created by PhpStorm.
 * User: conf
 * Date: 3/12/16
 * Time: 11:59 PM
 */
namespace App\Http\Composers;
use Illuminate\Contracts\View\View;
use App\Category;

class MainComposer{

    public function compose(View $view){
        $view->with('categories', Category::all());
    }
}