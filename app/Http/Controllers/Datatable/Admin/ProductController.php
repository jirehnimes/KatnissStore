<?php

namespace App\Http\Controllers\Datatable\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;

use Datatables;

class ProductController extends Controller
{
    public function all()
    {
    	$aProd = Product::with('category')->get();
    	return Datatables::of($aProd)->make(true);
    }
}
