<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Event;
use App\Category;
use Log;

class CategoriesController extends Controller
{

    public function show($id)
    {

        $events = array();
        $count = Event::where('category_id', $id)->count();
       if (($count)>0){

          $events = Event::with('category')->whereHas('category', function($query) use ($id) {
               $query->where('category_id', '=', $id);
           })->paginate(1);
         //  $events = Event::with('category')->get();
       //  echo dd($events);
            return view('index', compact('events'));
        }else{
          return view('index', compact('events'));
       }

    }


}
