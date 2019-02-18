@extends('layouts.app')

@section('content')
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the FBATTENDANCE</h1>
                <h3>sorry,you can't sign up on the website</h3>
                <h5>{!! link_to_route('signup.get', 'Signup') !!}</h5>
            </div>
        </div>
@endsection