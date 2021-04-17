@extends('layouts.global')

@section('title') Detail Category @endsection 

@section('content')
  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        <label><b>Category name</b></label><br>
        {{$category->name}}
        <br><br>

        <label><b>Category slug</b></label><br>
        {{$category->slug}}
        
      </div>
    </div>
  </div>
@endsection 