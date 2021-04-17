@extends('layouts.global')
@section('title') Tambah Supplier @endsection
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
        <input type="text" class="form-control" name="nama" placeholder="Nama Supplier">
        <br>
        <label>Alamat</label><br>
        <textarea type="text" class="form-control" name="alamat" placeholder="alamat lengkap"></textarea>
        <br>
        <label>Telepon</label><br>
        <input type="text" class="form-control" name="telp">
        <br>
        <label>E-mail</label><br>
        <input type="text" class="form-control" name="email" placeholder="user@mail.com">
        <br>
        <input type="submit" class="btn btn-primary" value="Save">
    </form>
@endsection