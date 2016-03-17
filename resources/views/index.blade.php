@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Latest Events</h3>
        </div>
        <div class="panel-body">
          <div class="row">
              @foreach($events as $event)
                  <div class="col-md-4">
                      <img src="/images/{{$event->main_image}}">
                      <h4><a href="/events/{{$event->id}}">{{$event->title}}</a></h4>
                      <h5>{{$event->location}}</h5>
                      <h5>{{$event->time}}</h5>
                      <p>{{$event->description}}</p>
                  </div>
              @endforeach
          </div>
        </div>


    </div>
    @if($events)
        {!! $events->appends(Request::except('page'))->links() !!}
    @endif
@stop