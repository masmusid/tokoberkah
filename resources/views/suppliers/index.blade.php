@extends('layouts.global')
@section('title') Suppliers list @endsection
@section('pageTitle')Suppliers List @endsection
@section('content')

    <div class="row">       
        <div class="col-md-6">
            <form action="{{ route('suppliers.index') }}">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Filter by supplier name" value="{{Request::get('name')}}" name="name">
                    <div class="input-group-append">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
                </div>
            </form>            
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('suppliers.create') }}" class="btn btn-primary">Tambah Supplier</a>
        </div>
    </div>

    <hr class="my-3">

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
        <div class="col-md-12">
            <table class="table table-bordered table-stripped">
                <thead>
                    <tr>
                        <th><b>Nama</b></th>
                        <th><b>Alamat</b></th>
                        <th><b>E-mail</b></th>
                        <th><b>Telepon</b></th>
                        <th><b>Action</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->nama }}</td>
                            <td>{{ $supplier->alamat }}</td>
                            <td>{{ $supplier->email }}</td>
                            <td>{{ $supplier->telp }}</td>
                            
                            <td>
                                <a href="{{route('suppliers.edit', [$supplier->id])}}" class="btn btn-info btn-sm"> Edit </a>
                                <a href="{{route('suppliers.show', [$supplier->id])}}" class="btn btn-primary btn-sm"> Show </a>
                                <form onsubmit=" return confirm('Delete this suppliers permanently?')" class="d-inline"
                                                action="{{route('suppliers.destroy', [$supplier->id])}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                </form>        
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colSpan="10">
                            {{ $suppliers->appends(Request::all())->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection