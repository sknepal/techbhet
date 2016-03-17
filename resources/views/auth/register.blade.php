@extends('layouts.main')

@section('title', 'Register')

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Register</h3>
  </div>
  <div class="panel-body">
<form method="POST" action="/auth/register">
    {!! csrf_field() !!}
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" value="{{old('name')}}">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email" value="{{old('email')}}">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation">
    </div>
    <button class="btn btn-primary" type="submit">Register</button>
</form>
</div>
</div>
@stop