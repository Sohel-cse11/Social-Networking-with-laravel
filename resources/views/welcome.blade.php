@extends('layouts.master')
@section('title')
 Welcome!
@endsection

@section('content')
@include('includes.message-block')

  <div class="row">
      <div class="col-md-6">
      <h3>Sign Up</h3>
          <form action="{{route('signup')}}" method="post">
                <div class="form-group">
                    <label for="email">Your E-Mail</label>
                    <input class="form-control" type="email" name="email" id="email" value="{{Request::old('email')}}"></input>
                </div>
                <div class="form-group">
                    <label for="email">Your Name</label>
                    <input class="form-control" type="fname" name="fname" id="fname" value="{{Request::old('fname')}}"></input>
                </div>
                <div class="form-group">
                    <label for="email">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password"></input>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="_token" value="{{Session::token()}}"></input>
          </form>
      </div>
      <div class="col-md-6">
      <h3>Sign In</h3>
          <form action="{{route('signin')}}" method="post">
                <div class="form-group">
                    <label for="email">Your E-Mail</label>
                    <input class="form-control" type="email" name="email" id="email"></input>
                </div>
                <div class="form-group">
                    <label for="email">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password"></input>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="_token" value="{{Session::token()}}"></input>
          </form>
      </div>
</div>
@endsection