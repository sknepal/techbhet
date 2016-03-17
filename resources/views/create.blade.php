@extends('layouts.main')

@section('title', 'Create')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Create Event</h3>
        </div>
        <div class="panel-body">
            {!! Form::open(array('action' => 'EventsController@store', 'enctype'=>'multipart/form-data')) !!}
            <div class="form-group">
                {!! Form::label('title','Title') !!}
                {!! Form::text('title', $value=null, $attributes = ['class'=>'form-control', 'name' => 'title']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('category_id','Category') !!}
                <select name="category_id" class="form-control">
               @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                {!! Form::label('description','Description') !!}
                {!! Form::textarea('description', $value=null, $attributes = ['class'=>'form-control', 'name' => 'description']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('main_image','Main Image') !!}
                {!! Form::file('main_image', $value=null, $attributes = ['class'=>'btn btn-default']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('location','Location') !!}
                {!! Form::text('location', $value=null, $attributes = ['class'=>'form-control', 'name' => 'location']) !!}
            </div> <div class="form-group">
                {!! Form::label('date','Date') !!}
              {!! Form::date('date', $value=null, $attributes = ['class'=>'form-control', 'name' => 'date']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('time','Time') !!}
                {!! Form::text('time', $value=null, $attributes = ['class'=>'form-control', 'name' => 'time']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meetup','Meetup Link') !!}
                {!! Form::text('meetup', $value=null, $attributes = ['class'=>'form-control', 'name' => 'meetup']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('fb','Facebook Event Link') !!}
                {!! Form::text('fb', $value=null, $attributes = ['class'=>'form-control', 'name' => 'fb']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('organizer','Organizer') !!}
                {!! Form::text('organizer', $value=null, $attributes = ['class'=>'form-control', 'name' => 'organizer']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('details_organizer','Details') !!}
                {!! Form::textarea('details_organizer', $value=null, $attributes = ['class'=>'form-control', 'name' => 'details_organizer']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('tags','Tags') !!}
                {!! Form::textarea('tags', $value=null, $attributes = ['class'=>'form-control', 'name' => 'tags']) !!}
            </div>

            {!! Form::submit('Submit', $attributes = ['class'=>'btn btn-primary']); !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop