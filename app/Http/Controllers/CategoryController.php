<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = \App\Models\Category::paginate(10);
        $filterKeyword =$request->get('name');
        if($filterKeyword)
        {
            $categories = \App\Models\Category::where("name", "LIKE",
            "%$filterKeyword%")->paginate(10);
        }
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form create categori
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            "name" => "required|min:3|max:20",
            "image" => "required"
        ])->validate();

        $name = $request->get('name');
        $new_category = new \App\Models\Category;
        $new_category->name = $name;
        $new_category->slug = \Str::slug($name, '-');

        $new_category->save();

        return redirect()->route('categories.create')->with('status','Category successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = \App\Models\Category::findOrFail($id);
        return view('categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_to_edit = \App\Models\Category::findOrFail($id);
        return view('categories.edit', ['category' => $category_to_edit]);
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
        $category = \App\Models\Category::findOrFail($id);

        \Validator::make($request->all(), [
            "name" => "required|min:3|max:20",
            "slug" => ["required", Rule::unique("categories")->ignore($category->slug, "slug")]
        ])->validate();

        $name = $request->get('name');
        $slug = $request->get('slug');

        $category->name = $name;
        $category->slug = $slug;

        $category->slug = \Str::slug($name);
        $category->save();
        //setelah selesai update kita kembalikan tampilan ke categories/index.blade.php
        return redirect()->route('categories.index')->with('status', 'Category successfully Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = \App\Models\Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('status', 'Category successfully Deleted');
    }

    public function ajaxSearch(Request $request)
    {
        $keyword=$request->get('q');
        $categories= \App\Models\Category::where("name", "LIKE", "%$keyword%")->get();
        return $categories;
    }
}
