<?php
/**
 * Created by PhpStorm.
 * User: conf
 * Date: 3/11/16
 * Time: 8:28 PM
 */

namespace App\Http\Requests;
use App\Http\Requests\Request;
use Auth;
use Log;
use App\Event;

use Response;
use Illuminate\Foundation\Http\FormRequest;
class UpdateEventRequest extends FormRequest{

    public function authorize()
    {

        $eventId = $this->route('events');
        Log::error($eventId);
        if (Auth::id()==1) {
            return true;
        }else{
        return Event::where('id', $eventId)
            ->where('owner_id', Auth::id())->exists();
        }
    }

    public function rules()
    {
        return[
            'title' => 'required',
            'category_id' => 'required',
            'location' => 'required',
            'date' => 'required',
            'time' => 'required'

        ];
    }

    public function forbiddenResponse()
    {

        return \Redirect::route('events.index')->withErrors('Not that easy, bru.');
    }
}