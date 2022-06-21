@extends('layouts.app')
@section('title') Welcome to {{ config('app.name', 'Laravel') }} @stop
@section('content')
<div id="main">
    <div class="container">
        <div class="card mt-5 text-center">
          <div class="card-header">
            <b>ToDo App</b>
          </div>
          <div class="card-body">
            <img width="200" src="{{ asset('logo.png') }}">
            <h5 class="card-title"><b>Welcome to ToDo App</b></h5>
            <p class="card-text">Keep your daily routines and complete your task everyday!</p>
            <a class="btn btn-success my-2 mx-1 my-sm-0" href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
            <a class="btn btn-danger my-2 my-sm-0" href="{{ route('register') }}"><i class="fa fa-registered" aria-hidden="true"></i> Register</a>
            <div class="copyright mt-3 text-dark">
              &copy; {{ date('Y') }} Developed By <strong><a href="http://jotonsutradhar.com/" target="_blank" title="Joton Sutradhar"><span> Joton Sutradhar.</span></a></strong>&emsp; 
              <b>Find me</b>: 
              <a target="_blank" href="https://github.com/jotonsd" class="github f20"><i class="fa fa-github-square"></i></a> 
              <a target="_blank" href="https://www.linkedin.com/in/joton-sutradhar-b77996196/" class="linkedin f20"><i class="fa fa-linkedin-square f20"></i></a>
              <a target="_blank" href="https://facebook.com/joton.sutradhar" class="facebook f20"><i class="fa fa-facebook-square f20"></i></a>
              <a target="_blank" href="https://instagram.com/joton.sutradhar" class="instagram f20"><i class="fa fa-instagram f20"></i></a>
            </div>
          </div>
        </div>
    </div>            
</div>
@stop