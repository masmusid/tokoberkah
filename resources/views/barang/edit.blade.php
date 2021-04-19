@extends('layouts.global')
@section('title') Edit Barang @endsection
@section("pageTitle")Edit Barang @endsection
@section('content')
@if(session('status'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert" id="success-alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('status') }}
                </div>
            </div>
        </div>
@endif

<div class="row">
    <div class="col-md-8">

      <form
      enctype="multipart/form-data"
      method="POST"
      action="{{route('barang.update', [$barang->id])}}"
      class="p-3 shadow-sm bg-white">

        @csrf
        <input type="hidden" name="_method" value="PUT">

        <label for="nama">Nama Barang</label> <br>
        <input value="{{$barang->nama}}" type="text" class="form-control {{$errors->first('nama') ? "is-invalid" : ""}} " name="nama" placeholder="nama Barang">
        <div class="invalid-feedback">
            {{$errors->first('nama')}}
        </div>
        <br>
        
        <label for="Tambah_Foto">Tambah Foto</label><br>
        <small class="text-muted">Current cover</small><br>
        @if($barang->cover)
          <img src="{{asset('storage/' . $barang->cover)}}" width="96px"/>
        @endif <br><br>
        <div class="input-group mb-3">
            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="Tambah_Foto" id="Tambah_Foto">
            <small class="text-muted">*Kosongkan jika tidak ingin mengubah cover</small>
        </div>
        
        <br>
        
        <label for="deskripsi">Deskripsi Barang</label><br>
        <textarea name="deskripsi" id="deskripsi" class="form-control {{$errors->first('deskripsi') ? "is-invalid" : ""}} " placeholder="Give a deskripsi about this product">{{$barang->deskripsi}}</textarea>
        <div class="invalid-feedback">
            {{$errors->first('deskripsi')}}
        </div>
        <br>

        <label for="categories">Categories</label><br>
        <select multiple name="categories[]"  id="categories" class="form-control"></select>
        <br><br>

        <label for="exp_date">Expired Date</label>
        <input type="date" class="form-control" name="exp_date" value="{{$barang->exp_date}}">
        <div class="invalid-feedback">
            {{$errors->first('exp_date')}}
        </div>
        <br>
        
        <label for="qty">Stok</label><br>
        <input value="{{$barang->qty}}" type="number" class="form-control {{$errors->first('qty') ? "is-invalid" : ""}} " id="qty" name="qty" min=0 value=0>
        <div class="invalid-feedback">
            {{$errors->first('qty')}}
        </div>
        <br>

        <label for="satuan">Satuan</label><br>
        <input value="{{$barang->satuan}}" type="text" class="form-control {{$errors->first('satuan') ? "is-invalid" : ""}} " name="satuan" placeholder="Satuan">
        <div class="invalid-feedback">
            {{$errors->first('satuan')}}
        </div>
        <br>

        <label for="harga">Harga</label> <br>
        <input value="{{$barang->harga}}" type="number" class="form-control {{$errors->first('harga') ? "is-invalid" : ""}} " name="harga" id="harga" placeholder="Harga Barang">
        <div class="invalid-feedback">
          {{$errors->first('harga')}}
        </div>
        <br>

        <label for="harga_supplier">Harga Supplier</label> <br>
        <input value="{{$barang->harga_supplier}}" type="number" class="form-control {{$errors->first('harga_supplier') ? "is-invalid" : ""}} " name="harga_supplier" id="harga_supplier" placeholder="Harga Supplier">
        <div class="invalid-feedback">
          {{$errors->first('harga_supplier')}}
        </div>
        <br>

        <label>Supplayer</label> <br>
        <select class="form-control"  name="supplier" id="supplier"></select>
        
        <br>
        <br>
        <label for="">Status</label>
        <select name="status" id="status" class="form-control">
            <option {{$barang->status == 'PUBLISH' ? 'selected' : ''}} value="PUBLISH">PUBLISH</option>
            <option {{$barang->status == 'DRAFT' ? 'selected' : ''}} value="DRAFT">DRAFT</option>
        </select>

        <br>
        <br>
        <button class="btn btn-primary" value="PUBLISH">Update</button>

      </form>
    </div>
  </div>

    </div>
</div>
@endsection
@section('footer-scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script type="text/javascript">
        $('#categories').select2({
            ajax: {
                url: "<?=url('/ajax/categories/search');?>",
                processResults: function (data) {
                    return {
                        results: data.map(function (item) {
                            return {id: item.id, text: item.name} })
                    }
                }
            }
        });
        var categories = {!! $barang->categories !!}
        categories.forEach(function(category){
          var option = new Option(category.name, category.id, true, true);
          $('#categories').append(option).trigger('change');
        });


        $('#supplier').select2({
          placeholder: 'Cari...',
          ajax: {
            url: "<?=url('/ajax/suppliers/search');?>",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
              return {
                results:  data.map( function (item) {
                  return {text: item.nama, id: item.id} })
              };
            },
            cache: true
          }
        });

        var suppliers = {!! $barang->Suppliers !!}
          var option = new Option(suppliers.nama, suppliers.id, true, true);
          $('#supplier').append(option).trigger('change');

      </script>
@endsection