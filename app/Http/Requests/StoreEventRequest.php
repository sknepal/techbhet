<?php
/**
 * Created by PhpStorm.
 * User: conf
 * Date: 3/11/16
 * Time: 8:28 PM
 */

namespace App\Http\Requests;
use App\Http\Requests\Request;

class StoreEventRequest extends Request{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return[
            'title' => 'required',
            'category_id' => 'required',
            'location' => 'required',
            'date' => 'required',
            'time' => 'required',

        ];
    }
}