@extends('layouts.global')
@section('title') Tambah Barang @endsection
@section("pageTitle")Tambah Barang @endsection
@section('content')
<div class="row">
    <div class="col-md-8">

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        
        <form action="{{route('barang.store')}}" method="POST" enctype="multipart/form-data" class="shadow-sm p-3 bg-white">

        @csrf
        
        <label for="nama">Nama Barang</label> <br>
        <input value="{{old('nama')}}" type="text" class="form-control {{$errors->first('nama') ? "is-invalid" : ""}} " name="nama" placeholder="nama Barang">
        <div class="invalid-feedback">
            {{$errors->first('nama')}}
        </div>
        <br>
        
        <label for="Tambah_Foto">Tambah Foto</label>
        <div class="input-group mb-3">
            <input type="file" class="form-control-file {{$errors->first('Tambah_Foto') ? "is-invalid": ""}}" name="Tambah_Foto" id="Tambah_Foto">
            <div class="invalid-feedback">
              {{$errors->first('Tambah_Foto')}}
            </div>  
        </div>
        <br>
        

        <label for="deskripsi">Deskripsi Barang</label><br>
        <textarea name="deskripsi" id="deskripsi" class="form-control {{$errors->first('deskripsi') ? "is-invalid" : ""}} " placeholder="Give a deskripsi about this product">{{old('deskripsi')}}</textarea>
        <div class="invalid-feedback">
            {{$errors->first('deskripsi')}}
        </div>
        <br>

        <label for="categories">Categories</label><br>
        <select name="categories[]" multiple id="categories" class="form-control {{$errors->first('categories') ? "is-invalid": ""}}"></select>
        <div class="invalid-feedback">
            {{$errors->first('categories')}}
        </div>
        <br><br>

        <label for="exp_date">Expired Date</label>
        <input type="date" class="form-control {{$errors->first('exp_date') ? "is-invalid": ""}}" name="exp_date" value="{{ old('exp_date') }}">
        <div class="invalid-feedback">
            {{$errors->first('exp_date')}}
        </div>
        <br>
        
        <label for="qty">Stok</label><br>
        <input value="{{old('qty')}}" type="number" class="form-control {{$errors->first('qty') ? "is-invalid" : ""}} " id="qty" name="qty" min=0 value=0>
        <div class="invalid-feedback">
            {{$errors->first('qty')}}
        </div>
        <br>

        <label for="satuan">Satuan</label><br>
        <input name="satuan" value="{{old('satuan')}}" type="text" class="form-control {{$errors->first('satuan') ? "is-invalid" : ""}} "  placeholder="Satuan">
        <div class="invalid-feedback">
            {{$errors->first('satuan')}}
        </div>
        <br>

        <label for="harga">Harga</label> <br>
        <input value="{{old('harga')}}" type="number" class="form-control {{$errors->first('harga') ? "is-invalid" : ""}} " name="harga" id="harga" placeholder="Harga Barang">
        <div class="invalid-feedback">
            {{$errors->first('harga')}}
        </div>
        <br>

        <label for="harga_supplier">Harga Supplier</label> <br>
        <input value="{{old('harga_supplier')}}" type="number" class="form-control {{$errors->first('harga_supplier') ? "is-invalid" : ""}} " name="harga_supplier" id="harga_supplier" placeholder="Harga Supplier">
        <div class="invalid-feedback">
            {{$errors->first('harga_supplier')}}
        </div>
        <br>

        <label>Supplayer</label> <br>
        <select value="{{old('supplier')}}" class="supplier form-control {{$errors->first('supplier') ? "is-invalid": ""}}" name="supplier" id="supplier"></select>
        <div class="invalid-feedback">
            {{$errors->first('supplier')}}
        </div>
        
        <br><br>

        <button type="submit" class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>
        <button type="submit" class="btn btn-outline-secondary" name="save_action" value="DRAFT">Save as draft</button>
        
      </form>
    </div>
  </div>

    </div>
</div>
@endsection
@section('footer-scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="/js/app.js"></script>
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
    </script>
@endsection