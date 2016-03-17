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
class DestroyEventCommand extends Command implements SelfHandling{
    public $id;

    public function __construct($id){
        $this->id = $id;

    }

    public function handle(){
        return Event::where('id', $this->id)->delete();
    }
}