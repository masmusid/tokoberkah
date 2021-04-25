
@extends('layouts.global')

@section('title') Detail Supplier @endsection 

@section('content')
<div class="col-md-8">
  <div class="card">
    <div class="card-body">
      <b>Nama:</b> <br/>
      {{$supplier->nama}}
      <br>
      <br>

      <b>Alamat:</b><br>
      {{$supplier->alamat}}

      <br>
      <br>
      <b>Nomor Telepon</b> <br>
      {{$supplier->telp}}

      <br><br>
      <b>E-mail</b> <br>
      {{$supplier->email}}
     
    </div>
  </div>
</div>
@endsection
