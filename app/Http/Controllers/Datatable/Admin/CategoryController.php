<?php

namespace App\Http\Controllers\Datatable\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;

use Datatables;

class CategoryController extends Controller
{
    public function all()
    {
    	$aCategory = Category::all();
    	return Datatables::of($aCategory)->make(true);
    }
}
