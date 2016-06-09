<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'EventsController@index');

    Route::get('/feeds', function () {

        // create new feed
        $feeds = App::make("feed");
        $feeds->setCache(30, 'MainFeedKey');

        // check if there is cached feed and build new only if is not
        if (!$feeds ->isCached())
        {
        // creating rss feed with our most recent 20 records in news table
        $news =  \DB::table('events')->orderBy('created_at', 'desc')->take(20)->get();
        // set your feed's title, description, link, pubdate and language
        $feeds ->title = 'TechBhet';
        $feeds ->description = 'Event Listing';
        $feeds ->logo = 'http://techbhet.com/logo.jpg';
        $feeds ->link = url('feeds');
        $feeds ->setDateFormat('datetime');
        $feeds ->pubdate = $news[0]->created_at; // date of latest news
        $feeds ->lang = 'en';
        $feeds ->setShortening(true); // true or false
        $feeds ->setTextLimit(100); // maximum length of description text

        foreach ($news as $n)
        {
            // set item's title, author, url, pubdate, description and content
            $image  = '<img src="'. url('/images/'.$n->main_image) .'" height="250" width="150" /><p>';
            $feeds ->add($n->title, "TechBhet", url('/events/'.$n->id), $n->created_at, $image.$n->description, $n->description);

        }

           }

        // return your feed ('atom' or 'rss' format)
        return $feeds ->render('atom');

    });

    Route::get('categories/{id}/feeds', function ($id) {

       // create new feed
        $feedNews = App::make("feed");

            // creating rss feed with our most recent 20 records that match the given category in the table
            $news =  \DB::table('events')->where('category_id', '=', $id)->take(20)->get();
            $feedName = \DB::table('categories')->where('id', '=', $id)->first();
            if (!$news) return redirect('feeds'); // in the case that non-existent category is passed as an argument
            // set your feed's title, description, link, pubdate and language
            $feedNews ->title = 'TechBhet';
            $feedNews ->description = 'Event Feed of '. $feedName->name;
            $feedNews ->logo = 'http://techbhet.com/logo.jpg';
            $feedNews ->link = url('feedNews');
            $feedNews ->setDateFormat('datetime');
            $feedNews ->pubdate = $news[0]->created_at; // date of latest event
            $feedNews ->lang = 'en';
            $feedNews ->setShortening(true); // true or false
            $feedNews ->setTextLimit(100); // maximum length of description text

            foreach ($news as $n)
            {
                // set item's title, author, url, pubdate, description and content
                $image  = '<img src="'. url('/images/'.$n->main_image) .'" height="250" width="150" /><p>';
                $feedNews ->add($n->title, "TechBhet", url('/events/'.$n->id), $n->created_at, $image.$n->description, $n->description);

            }


        // return your feed ('atom' or 'rss' format)
        return $feedNews ->render('atom');

            });
// Search route
    Route::get('/search', 'EventsController@search');

// Authentication routes...
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');
//


// Events routes
    Route::resource('events', 'EventsController');



// Categories routes
    Route::resource('categories', 'CategoriesController');



});

