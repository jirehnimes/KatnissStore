<?php

namespace App\Http\Controllers\Datatable\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\User;
use App\Product;

use Datatables;

class OrderController extends Controller
{
    public function all()
    {
    	$aOrder = Order::with('user')->get();
    	return Datatables::of($aOrder)->make(true);
    }
}
