<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\model\Category;
use App\model\Products;
use App\model\Productcategory;

class ApiController extends Controller
{
    public function get_category(Request $request) {
        $parent = $request->parent_id;
        $category = Category::where('parentId','=',$parent)->get();
        return response()->json($category);
    }
    public function get_subcategory(Request $request)
    {
    	$category = $request->category_id;
    	$subcat = Category::where('parentId','=',$category)->get(); 
        return response()->json($subcat);
    }


    public function get_products(Request $request)
    {
    	$category = $request->category_id;
    	$products = Products::select('products.Id','products.product_name')
    	            ->join('productscategories', 'products.Id', '=', 'productscategories.productId')
    	            ->where('productscategories.subcategoryId','=',$category)
    	            ->get();
    	return response()->json($products);
    }
}
