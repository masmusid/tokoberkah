@extends('layouts.global')

@section('title') Edit Supplier @endsection 

@section('content')

<div class="row">
  <div class="col-md-8">

    @if(session('status'))
        <div class="alert alert-success">
        {{session('status')}}
        </div>
    @endif 

    <form 
      action="{{route('suppliers.update', [$supplier->id])}}"
      enctype="multipart/form-data"
      method="POST"
      class="p-3 shadow-sm bg-white">

      @csrf

      <input 
        type="hidden" 
        value="PUT" 
        name="_method">

      <label for="nama">Nama Supplier</label> <br>
      <input 
        type="text" 
        class="form-control {{$errors->first('nama') ? "is-invalid" : ""}}" 
        value="{{old('nama') ? old('nama') : $supplier->nama}}" 
        name="nama">
       <div class="invalid-feedback">
          {{$errors->first('nama')}}
        </div>
      <br>
        <label for="alamat">Alamat</label><br>
        <textarea name="alamat" id="alamat" class="form-control {{$errors->first('alamat') ? "is-invalid" : ""}}">{{old('alamat') ? old('alamat') : $supplier->alamat}}</textarea>
        <div class="invalid-feedback">
            {{$errors->first('alamat')}}
        </div>
        <br>
        <label for="telp">Telepon</label><br>
        <input 
            type="text"
            class="form-control  {{$errors->first('telp') ? "is-invalid" : ""}}" 
            value="{{old('telp') ? old('telp') : $supplier->telp}}"
            name="telp">
        <div class="invalid-feedback">
            {{$errors->first('telp')}}
        </div>
        <br>
        <label for="email">E-mail</label><br>
        <input 
            type="text" 
            class="form-control {{$errors->first('email') ? "is-invalid" : ""}}" 
            value="{{old('email') ? old('email') : $supplier->email}}"
            name="email">
            <div class="invalid-feedback">
                {{$errors->first('email')}}
            </div>
        <br><br>       

      <input type="submit" class="btn btn-primary" value="Update">

    </form>
  </div>
</div>
@endsection  
