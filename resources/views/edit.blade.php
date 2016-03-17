@extends('layouts.main')

@section('title', 'Edit Event')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Event</h3>
        </div>
        <div class="panel-body">
            {!! Form::open(array('action' => ['EventsController@update', $event->id], 'method'=>'PUT', 'enctype'=>'multipart/form-data')) !!}
            <div class="form-group">
                {!! Form::label('title','Title') !!}
                {!! Form::text('title', $value=$event->title, $attributes = ['class'=>'form-control', 'name' => 'title']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('category_id','Category') !!}

                <select name="category_id" class="form-control" >
                    <option value="{{$event->category_id}}" selected="selected">{{$event->category->name}}</option>
                    @foreach($categories as $category)
                        @if($category->id!=$event->category_id)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                {!! Form::label('description','Description') !!}
                {!! Form::textarea('description', $value=$event->description, $attributes = ['class'=>'form-control', 'name' => 'description']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('main_image','Main Image') !!}
                {!! Form::file('main_image', $attributes = ['class'=>'btn btn-default']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('location','Location') !!}
                {!! Form::text('location', $value=$event->location, $attributes = ['class'=>'form-control', 'name' => 'location']) !!}
            </div> <div class="form-group">
                {!! Form::label('date','Date') !!}
                {{--{!! Form::text('date', '', array('class' => 'form-control','placeholder' => '','data-datepicker' => 'datepicker')) !!}--}}
                {{--{{ Form::text('startingDate', null, array('class' => 'form-control input-sm','placeholder' => 'Starting Date','data-provide' => 'datepicker')) }}--}}
                {!! Form::date('date', $value=$event->date, $attributes = ['class'=>'form-control', 'name' => 'date']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('time','Time') !!}
                {!! Form::text('time', $value=$event->time, $attributes = ['class'=>'form-control', 'name' => 'time']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meetup','Meetup Link') !!}
                {!! Form::text('meetup', $value=$event->meetup, $attributes = ['class'=>'form-control', 'name' => 'meetup']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('fb','Facebook Event Link') !!}
                {!! Form::text('fb', $value=$event->fb, $attributes = ['class'=>'form-control', 'name' => 'fb']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('organizer','Organizer') !!}
                {!! Form::text('organizer', $value=$event->organizer, $attributes = ['class'=>'form-control', 'name' => 'organizer']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('details_organizer','Details') !!}
                {!! Form::textarea('details_organizer', $value=$event->details_organizer, $attributes = ['class'=>'form-control', 'name' => 'details_organizer']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('tags','Tags') !!}
                {!! Form::textarea('tags', $value=$event->tags, $attributes = ['class'=>'form-control', 'name' => 'tags']) !!}
            </div>
            {!! Form::submit('Submit', $attributes = ['class'=>'btn btn-primary']); !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop