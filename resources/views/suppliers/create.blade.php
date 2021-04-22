@extends('layouts.global')
@section('title') Tambah Supplier @endsection
@section('pageTitle')Tambah Supplier @endsection
@section('content')
<div class="col-md-8">
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3"
        action="{{ route('suppliers.store') }}" method="POST">

        @csrf

        <label>Nama Supplier</label><br>
        <input value="{{old('nama')}}" type="text" class="form-control {{$errors->first('nama') ? "is-invalid": ""}}" name="nama" placeholder="Nama Supplier">
        <div class="invalid-feedback">
            {{$errors->first('nama')}}
        </div>
        <br>

        <label>Alamat</label><br>
        <textarea type="text" class="form-control {{$errors->first('alamat') ? "is-invalid": ""}}" name="alamat" placeholder="alamat lengkap">{{old('alamat')}}</textarea>
        <div class="invalid-feedback">
            {{$errors->first('alamat')}}
        </div>
        <br>
        
        <label>Telepon</label><br>
        <input value="{{old('telp')}}" type="text" class="form-control {{$errors->first('telp') ? "is-invalid": ""}}" name="telp">
        <div class="invalid-feedback">
            {{$errors->first('telp')}}
        </div>
        <br>

        <label>E-mail</label><br>
        <input value="{{old('email')}}" type="text" class="form-control {{$errors->first('email') ? "is-invaid": ""}}" name="email" placeholder="user@mail.com">
        <div class="invalid-feedback">
            {{$error->first('email')}}
        </div>
        <br>

        <input type="submit" class="btn btn-primary" value="Save">
    </form>
@endsection