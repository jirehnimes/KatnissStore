<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $oRequest = $request->all();

        $oCategory = new Category;
        $oCategory->name = $oRequest['name'];

        if ($oCategory->save()) {
            return redirect('/admin/category')->with('ok', 'Category successfully saved.');
        }

        return redirect('/admin/category')->with('error', 'Category save failed.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $oRequest = $request->all();
        
        $oCategory = Category::find($id);
        $oCategory->name = $oRequest['name'];

        if ($oCategory->save()) {
            return redirect('/admin/category')->with('ok', 'Category successfully updated.');
        }

        return redirect('/admin/category')->with('error', 'Category update failed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aCategory = Category::find($id);
        $aCategory->delete();

        return redirect('/admin/category')->with('ok', 'Category deleted.');
    }
}
