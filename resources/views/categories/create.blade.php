@extends('layouts.global')
@section('title') Tambah Kategori @endsection
@section('content')
<div class="col-md-8">
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3"
        action="{{ route('categories.store') }}" method="POST">

        @csrf

        <label>Nama kategori</label><br>
        <input value="{{old('name')}}" class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" type="text" class="form-control" name="name">
        <div class="invalid-feedback">
            {{$errors->first('name')}}
        </div>
        <br>
        <input type="submit" class="btn btn-primary" value="Save">
    </form>
@endsection