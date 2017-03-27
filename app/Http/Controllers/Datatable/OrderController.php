<?php

namespace App\Http\Controllers\Datatable;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

use App\Order;

use Datatables;

class OrderController extends Controller
{
	public function all()
    {
		$oOrder = Order::where('user_id', Auth::user()->id)
			->with(['order_product.product.category', 'user'])
			->get();

		return Datatables::of($oOrder)->make(true);
    }
}
