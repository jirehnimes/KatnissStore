<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;
use App\Product;

class ProductsController extends Controller
{
    public function display($category)
    {
        $aCat = Category::where('name', $category)->get();
        $aProd = Product::where('category_id', $aCat[0]['id'])
            ->with('category')
            ->paginate(15);

        return view('products', ['aProds' => $aProd]);
    }
}

// result
// object(Illuminate\Pagination\LengthAwarePaginator)#232 (9) {
//   ["total":protected]=>
//   int(0)
//   ["lastPage":protected]=>
//   int(0)
//   ["items":protected]=>
//   object(Illuminate\Database\Eloquent\Collection)#237 (1) {
//     ["items":protected]=>
//     array(0) {
//     }
//   }
//   ["perPage":protected]=>
//   int(15)
//   ["currentPage":protected]=>
//   int(1)
//   ["path":protected]=>
//   string(41) "http://katniss.com.local/products/Clothes"
//   ["query":protected]=>
//   array(0) {
//   }
//   ["fragment":protected]=>
//   NULL
//   ["pageName":protected]=>
//   string(4) "page"
// }
