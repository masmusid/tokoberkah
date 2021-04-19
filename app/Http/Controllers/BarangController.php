<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';

        if($status){
            $barang = \App\Models\barang::with('categories')->where("nama", "LIKE", "%$keyword%")->where('status', strtoupper($status))->paginate(10);
        } else {
            $barang = \App\Models\barang::with('categories')->where("nama", "LIKE", "%$keyword%")->paginate(10);
        }
        
        return view('barang.index', ['barang' => $barang]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama=$request->get('nama');
        $new_barang =new \App\Models\barang;
        $new_barang->supplier_id = $request->get('supplier');
        $new_barang->nama = $nama;
        if($request->file('cover'))
        {
            $cover_part = $request->file('image')->store('barang_cover', 'public');
            $new_barang->cover = $cover_part;
        }
        $new_barang->slug= \Str::slug($nama, '-');
        $new_barang->deskripsi=$request->get('deskripsi');
        $new_barang->harga=$request->get('harga');
        $new_barang->harga_supplier=$request->get('harga_supplier');
        $new_barang->qty=$request->get('qty');
        $new_barang->satuan=$request->get('satuan');
        $new_barang->exp_date=$request->get('exp_date');
        $new_barang->status = $request->get('save_action');
        $new_barang->created_by= \Auth::user()->id;
        $new_barang->save();

        $new_barang->categories()->attach($request->get('categories'));

        if($request->get('save_action') == 'PUBLISH'){
            return redirect()
                  ->route('barang.create')
                  ->with('status', 'Barang successfully saved and published');
          } else {
            return redirect()
                  ->route('barang.create')
                  ->with('status', 'Barang saved as draft');
          }
  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = \App\Models\barang::FindOrfail($id);
        $supplier= $barang->Suppliers;
        return view('barang.show',['barang'=>$barang, 'supplier'=>$supplier]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang_to_edit = \App\Models\barang::FindOrFail($id);
        
        return view('barang.edit', ['barang'=>$barang_to_edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nama=$request->get('nama');
        $barang = \App\Models\barang::findOrFail($id);
        $barang->supplier_id = $request->get('supplier');
        $barang->nama = $nama;

        $new_cover = $request->file('cover');
        if($new_cover)
        {
            if($barang->cover && file_exists(storage_path('app/public/' . $barang-cover)))
            {
                \Storage::delete('public/'. $barang->cover);
            }
            $new_cover_part = $request->file('image')->store('barang_cover', 'public');
            $barang->cover = $new_cover_part;
        }
        $barang->slug= \Str::slug($nama, '-');
        $barang->deskripsi=$request->get('deskripsi');
        $barang->harga=$request->get('harga');
        $barang->harga_supplier=$request->get('harga_supplier');
        $barang->qty=$request->get('qty');
        $barang->satuan=$request->get('satuan');
        $barang->exp_date=$request->get('exp_date');
        $barang->status = $request->get('status');
        $barang->created_by= \Auth::user()->id;
        $barang->save();

        $barang->categories()->sync($request->get('categories'));

        return redirect()->route('barang.edit', [$barang->id])->with('status','Barang successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = \App\Models\barang::findOrFail($id);
        $barang->delete();
        return redirect()->route('barang.index')->with('status', 'Barang moved to trash');
    }

    public function trash(){
        $barang = \App\Models\barang::onlyTrashed()->paginate(10);
        return view('barang.trash', ['barang' => $barang]);
    }

    public function restore($id)
    {
        $barang = \App\Models\barang::withTrashed()->findOrFail($id);
        if($barang->trashed())
        {
            $barang->restore();
            return redirect()->route('barang.trash')->with('status', 'Barang successfully restored');
        } else {
            return redirect()->route('barang.trash')->with('status', 'Barang is not in trash');
        }
    }
    
    public function deletePermanent($id)
    {
        $barang = \App\Models\barang::withTrashed()->findOrFail($id);
        if(!$barang->trashed())
        {
            return redirect()->route('barang.trash')->with('status', 'Barang is not in trash!')->with('status_type', 'alert');
        } else {
            $barang->categories()->detach();
            $barang->forceDelete();
            return redirect()->route('barang.trash')->with('status', 'Barang permanently deleted!');
        }
    }
}
