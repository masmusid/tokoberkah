<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = \App\Models\Supplier::paginate(10);
        $filterKeyword = $request->get('nama');
        if($filterKeyword)
        {
            $suppliers = \App\Models\Supplier::where("nama", "LIKE", "%$filterKeyword%")->paginate(10);
        }

        return view('suppliers.index', ['suppliers' => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_supplier = new \App\Models\Supplier;
        $new_supplier->nama = $request->get('nama');
        $new_supplier->alamat = $request->get('alamat');
        $new_supplier->email = $request->get('email');
        $new_supplier->telp = $request->get('telp');
        $new_supplier->save();

        return redirect()->route('suppliers.create')->with('status', 'Supplier successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = \App\Models\Supplier::FindOrFail($id);
        return view('suppliers.show', ['supplier'=>$supplier]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier_to_edit = \App\Models\Supplier::FindOrFail($id);
        return view('suppliers.edit', ['supplier'=> $supplier_to_edit]);
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
        $supplier = \App\Models\Supplier::FindOrFail($id);

        $supplier->nama = $request->get('nama');
        $supplier->alamat = $request->get('alamat');
        $supplier->email = $request->get('email');
        $supplier->telp = $request->get('telp');
        $supplier->save();

        return redirect()->route('suppliers.index')->with('status',  'Supplier successfully Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = \App\Models\Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('status', 'Supplier successfully Deleted');
    }

    public function ajaxSearch(Request $request)
    {
        $keyword=$request->get('q');
        $suppliers= \App\Models\Supplier::where("nama", "LIKE", "%$keyword%")->get();
        return $suppliers;
    }
}
