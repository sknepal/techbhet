@extends('layouts.main')

@section('title', 'Show')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{$event->title}}</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                    <div class="col-md-4">
                        <img src="/images/{{$event->main_image}}">
                    </div>
                        <div class="col-md-8">
                            <h3>Event Description</h3>
                            <p>{{$event->description}}</p>
                            <h3>Event Details</h3>
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Date: </strong> {{$event->date}}</li>
                                <li class="list-group-item"><strong>Time: </strong>{{$formatted_time}}</li>
                                <li class="list-group-item"><strong>Location: </strong> {{$event->location}}</li>
                                {{--@if{{$event->meetup}}--}}
                                <li class="list-group-item"><strong>Meetup Link: </strong><a href="{{$event->meetup}}"> {{$event->meetup}}</a></li>
                                {{--@endif--}}
                                <li class="list-group-item"><strong>Facebook Event Link: </strong><a href="{{$event->fb}}"> {{$event->fb}}</a></li>
                            </ul>
                            <h3>Organizer Details</h3>
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Organizer: </strong> {{$event->organizer}}</li>
                                <li class="list-group-item"><strong>Details: </strong> {{$event->details_organizer}}</li>
                            </ul>
                            <h3>Tags:</h3>
                            <li class="list-group-item"><a href="{{$event->tags}}"> {{$event->tags}}</a></li>
                            <br>
                    </div>
            </div>
            @if(!Auth::guest())
                @if((Auth::user()->id == $event->owner_id) || (Auth::user()->id == 1))
            <div class="pull-right event-controls">
                <a href="/events/{{$event->id}}/edit" class="btn btn-default">Edit</a>
                {!! Form::open(['method' => 'DELETE', 'route' => ['events.destroy', $event->id]]) !!}
                {!! Form::submit('Delete', $attributes=['class' => 'btn btn-danger']); !!}
                {!! Form::close() !!}
            </div>

                @endif
            @endif
        </div>
    </div>
@stop