<?php
/**
 * Created by PhpStorm.
 * User: conf
 * Date: 3/10/16
 * Time: 3:40 PM
 */

namespace App\Commands;
use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;

use App\Event;
use Log;
class StoreEventCommand extends Command implements SelfHandling{
    public $title;
    public $category_id;
    public $description;
    public $main_image;
    public $location;
    public $date;
    public $time;
    public $owner_id;
    public $meetup;
    public $fb;
    public $organizer;
    public $details_organizer;
    public $tags;


    public function __construct($title, $category_id, $description, $main_image, $location, $date, $time, $owner_id, $meetup, $fb, $organizer,
                                $details_organizer, $tags){
        $this->title = $title;
        $this->category_id  = $category_id;
        $this->description = $description;
        $this->main_image = $main_image;
        $this->date = $date;
        $this->time = $time;
        $this->location = $location;
        $this->owner_id = $owner_id;
        $this->meetup = $meetup;
        $this->fb = $fb;
        $this->organizer = $organizer;
        $this->details_organizer = $details_organizer;
        $this->tags = $tags;


    }

    public function handle(){
       // Log::error($this->owner_id);
        return Event::create([
            'title' => $this->title,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'main_image' => $this->main_image,
            'date' => $this->date,
            'time' => $this->time,
            'location' => $this->location,
             'owner_id' => $this->owner_id,
            'meetup' => $this->meetup,
            'fb' => $this->fb,
            'organizer' => $this->organizer,
            'details_organizer' => $this->details_organizer,
            'tags'=> $this->tags,
        ]);
    }
}