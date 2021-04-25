
@extends('layouts.global')

@section('title')Detail Barang @endsection 
@section('pageTitle')Detail Barang @endsection

@section('content')
<div class="col-md-8">
  <div class="card">
    <div class="card-body">
      <b>Nama Produk:</b> <br/>
      {{$barang->nama}} <br>
      <br>
      
      @if($barang->cover)
          <img src="{{ asset('storage/'. $barang->cover) }}" width="128px" />
      @else
          No Picture
      @endif
      <br>

      <b>Harga Jual</b> <br>
      {{$barang->harga}}<br>

      <b>Deskripsi:</b><br>
      {{$barang->deskripsi}} <br>
      <br>
        
      <b>Harga Supplier</b> <br>
      {{$barang->harga_supplier}}<br>
      
      <b>Supplier</b> <br>
      {{$supplier->nama}} <br>

     
    </div>
  </div>
</div>
@endsection
