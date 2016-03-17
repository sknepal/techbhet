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

class UpdateEventCommand extends Command implements SelfHandling{
    public $id;
    public $title;
    public $category_id;
    public $description;
    public $main_image;
    public $location;
    public $date;
    public $time;
    public $meetup;
    public $fb;
    public $organizer;
    public $details_organizer;
    public $tags;

    public function __construct($id, $title, $category_id, $description, $main_image, $location, $date, $time, $meetup,
                                $fb, $organizer, $details_organizer, $tags){
        $this->id = $id;
        $this->title = $title;
        $this->category_id  = $category_id;
        $this->description = $description;
        $this->main_image = $main_image;
        $this->date = $date;
        $this->time = $time;
        $this->location = $location;
        $this->meetup = $meetup;
        $this->organizer = $organizer;
        $this->fb = $fb;
        $this->details_organizer = $details_organizer;
        $this->tags = $tags;
    }

    public function handle(){
        return Event::where('id', $this->id)->update(array(
            'title' => $this->title,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'main_image' => $this->main_image,
            'date' => $this->date,
            'time' => $this->time,
            'location' => $this->location,
            'meetup' => $this->meetup,
            'fb' => $this->fb,
            'organizer' => $this->organizer,
            'details_organizer' => $this->details_organizer,
            'tags' => $this->tags,
        ));
    }
}