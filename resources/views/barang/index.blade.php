@extends('layouts.global')
@section('title') Barang list @endsection
@section('pageTitle')Barang List @endsection
@section('content')

    <div class="row">           
        <div class="col-md-6">
            <form action="{{ route('barang.index') }}">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Filter by nama barang " value="{{Request::get('nama')}}" name="nama">
                    <div class="input-group-append">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
                </div>
            </form>        
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route('barang.create') }}" class="btn btn-primary">Tambah barang</a>
        </div>
    </div>

    <div class="col-md-6"></div>
        <div class="col-md-6">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link {{ Request::get('status') == NULL && Request::path() == 'barang' ? 'active' : '' }}"
                    href="{{ route('barang.index') }}">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::get('status') == 'publish' ? 'active' : '' }}"
                    href="{{ route('barang.index', ['status' => 'publish']) }}">Publish</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::get('status') == 'draft' ? 'active' : '' }}"
                    href="{{ route('barang.index', ['status' => 'draft']) }}">Draft</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::path() == 'barang/trash' ? 'active' : '' }}"
                    href="{{ route('barang.trash') }}">Trash</a>
            </li>
        </ul>
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
                        <th><b>Foto</b></th>
                        <th><b>Nama Barang</b></th>
                        <th><b>Categories</b></th>
                        <th><b>Harga</b></th>
                        <th><b>Stok</b></th>
                        <th><b>Status</b></th>
                        <th><b>Action</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barang as $item)
                        <tr>
                            <td>
                                @if($item->cover)
                                    <img src="{{asset('storage/' . $item->cover)}}" width="96px"/></td>
                                @endif
                            <td>{{ $item->nama }}</td>
                            <td>
                                <ul class="pl-3">
                                    @foreach($item->categories as $category)
                                        <li>{{$category->name}}</li>
                                    @endforeach
                                </ul></td>
                            <td>{{$item->harga}}</td>
                            <td>{{$item->qty}}</td>
                            <td>
                                @if($item->status == "DRAFT")
                                    <span class="badge bg-dark text-white">{{$item->status}}
                                    </span>
                                @else
                                    <span class="badge badge-success">{{$item->status}}
                                    </span>
                                @endif</td>
                            <td>
                                <a href="{{route('barang.edit', [$item->id])}}" class="btn btn-info btn-sm"> Edit </a>
                                <a href="{{route('barang.show', [$item->id])}}" class="btn btn-primary btn-sm"> Show </a>
                                <form method="POST" class="d-inline" onsubmit="return confirm('Move barang to trash?')"
                                    action="{{route('barang.destroy', [$item->id])}}">
                                    @csrf
                                    <input type="hidden" value="DELETE" name="_method">
                                    <input type="submit" value="Trash" class="btn btn-danger btn-sm">
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td colSpan="10">
                            {{ $barang->appends(Request::all())->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection