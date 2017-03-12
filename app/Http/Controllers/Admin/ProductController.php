<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/product');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aCats = Category::all();

        return view(
            'admin/createProduct', 
            [
                'aStatus' => 'New',
                'aCats'   => $aCats
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $oInput = $request->all();

        $oProduct = new Product;
        $oProduct->name        = $oInput['name'];
        $oProduct->category_id = $oInput['category'];
        $oProduct->description = $oInput['description'];
        $oProduct->price       = $oInput['price'];
        $oProduct->quantity    = $oInput['quantity'];

        if ($oProduct->save()) {
            return redirect('/admin/product')->with('ok', 'Product successfully saved.');
        }

        return redirect('/admin/product/create')->with('error', 'Product save failed.');
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
        $aProd = Product::find($id);
        $aCats = Category::all();

        return view(
            'admin/createProduct', 
            [
                'aStatus' => 'Edit',
                'aCats'   => $aCats,
                'aProd'   => $aProd
            ]
        );
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
