<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;

use App\Commands\StoreEventCommand;
use App\Http\Requests\UpdateEventRequest;

use App\Commands\UpdateEventCommand;
use App\Commands\DestroyEventCommand;
//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Event;
use Auth;
use Log;
use DB;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\Request;
use Carbon\Carbon;
use DateTime;

class EventsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('auth', ['except' => ['index', 'show', 'search']]);
//        $this->middleware('edit',['only'=>'edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $events = Event::paginate(2);

        return view('index',  compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $title = $request -> input('title');
        $category_id = $request -> input('category_id');
        $description = $request -> input('description');
        $location = $request -> input('location');
        $date = $request -> input('date');
        $time = $request -> input('time');
        $links = $request -> input('links');
        $main_image = $request -> file('main_image');
        $owner_id = Auth::user()->id;
        $meetup = $request -> input('meetup');
        $fb = $request -> input('fb');
        $organizer = $request -> input('organizer');
        $details_organizer = $request -> input('details_organizer');
        $tags = $request -> input('tags');

        //check if image is uploaded
        if ($main_image){
           $main_image_filename = $main_image->getClientOriginalName();

            $actual_name = pathinfo($main_image_filename,PATHINFO_FILENAME);
            $original_name = $actual_name;
            $extension = pathinfo($main_image_filename, PATHINFO_EXTENSION);

            $i = 1;
//            Log::error(public_path('images').'/'.$actual_name.".".$extension);
//            Log::error(file_exists(public_path('images').'/'.$actual_name.".".$extension));

            while(file_exists(public_path('images').'/'.$actual_name.".".$extension))
            {
                $actual_name = (string)$original_name.$i;
                $main_image_filename = $actual_name.".".$extension;
                $i++;
            }
            $main_image->move(public_path('images'),$main_image_filename);
        }else{
            $main_image_filename = 'noimage.jpg';
        }

        //create command
        $command = new StoreEventCommand($title, $category_id, $description, $main_image_filename, $location, $date, $time, $owner_id,
                                            $meetup, $fb, $organizer, $details_organizer, $tags);
        $this->dispatch($command);

        return \Redirect::route('events.index')->with('message', 'Event Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        $formatted_time = new DateTime($event['time']);


//        $formatted_time = date("h:m A" ,strtotime($event['time']));
        $data = array(
            'event'  => $event,
            'formatted_time'   => $formatted_time->format('h:i A')
        );
//        return view('show', compact('event'));
        return view('show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $event = Event::find($id);
//      //  Log::error($event->owner_id);
//        session()->put('owner', $event->owner_id);
    //    Log::error(session()->get('owner'));
       // Session::put('OWNER',$event->owner_id);
        return view('edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, $id)
    {

        $title = $request -> input('title');
        $category_id = $request -> input('category_id');
        $description = $request -> input('description');
        $location = $request -> input('location');
        $date = $request -> input('date');
        $time = $request -> input('time');

        $meetup = $request -> input('meetup');
        $fb = $request -> input('fb');
        $organizer = $request -> input('organizer');
        $details_organizer = $request -> input('details_organizer');
        $tags = $request -> input('tags');
        $main_image = $request -> file('main_image');

        $current_image_filename = Event::find($id)->main_image;
        //check if image is uploaded
        // if uploaded, make sure the file is renamed if other file with the same name exists.
        // rename it as : name + integer id.
        if ($main_image){
            $main_image_filename = $main_image->getClientOriginalName();

            $actual_name = pathinfo($main_image_filename,PATHINFO_FILENAME);
            $original_name = $actual_name;
            $extension = pathinfo($main_image_filename, PATHINFO_EXTENSION);

            $i = 1;
            while(file_exists(public_path('images').'/'.$actual_name.".".$extension))
            {
                $actual_name = (string)$original_name.$i;
                $main_image_filename = $actual_name.".".$extension;
                $i++;
            }
            $main_image->move(public_path('images'),$main_image_filename);
        }else{
            $main_image_filename = $current_image_filename;
        }
//
//
//        if ($main_image){
//            $main_image_filename = $main_image->getClientOriginalName();
//            $main_image->move(public_path('images'), $main_image_filename);
//        }else{
//            $main_image_filename = $current_image_filename;
//        }

        // Update command
        $command = new UpdateEventCommand($id, $title, $category_id, $description, $main_image_filename, $location, $date, $time, $meetup,
                                            $fb, $organizer, $details_organizer, $tags);
        $this->dispatch($command);

        return \Redirect::route('events.index')->with('message', 'Event Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $command = new DestroyEventCommand($id);
        $this->dispatch($command);
        return \Redirect::route('events.index')->with('message', 'Event Removed');
    }

    public function search(){
        $searchString = Input::get('key');
        $searchCat = Input::get('cat');
//        $myArray = explode(':', $searchString);
      //  dd($searchCat);
     //   $events = Event::paginate(2);

    if ($searchCat) {
        $events = DB::table('events')->where('category_id', '=', $searchCat)->where(function($query) use ($searchString){
            $query->where('title', 'LIKE', '%' . $searchString . '%')
                ->orWhere('description',  'LIKE', '%' . $searchString . '%')
                ->orWhere('tags',   'LIKE', '%' . $searchString . '%');
        })->paginate(1);
//        orWhere('title', 'LIKE', '%' . $searchString . '%')
//            ->orWhere('description',  'LIKE', '%' . $searchString . '%')->orWhere('tags',   'LIKE', '%' . $searchString . '%')->paginate(2);


       // dd($events);
    }else{
        $events = DB::table('events')->where('title', 'LIKE', '%' . $searchString . '%')
            ->orWhere('description',  'LIKE', '%' . $searchString . '%')->orWhere('tags',   'LIKE', '%' . $searchString . '%')->paginate(2);

        //dd($events);
    }
        return view('index', compact('events'));

    }
}
