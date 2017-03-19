<?php

namespace App\Http\Controllers\Datatable;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;

use Datatables;

class ProductController extends Controller
{
    public function cart(Request $request)
    {
    	$oData = $request->all();

    	$aProd = Product::whereIn('id', $oData['cartItems'])
    		->with('category')
    		->get();
    	return Datatables::of($aProd)->make(true);
    }
}
