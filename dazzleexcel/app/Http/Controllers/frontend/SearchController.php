<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\model\Products;
use App\model\Category;
use App\model\Offers;
use Session;
class SearchController extends Controller
{
	    public function searchresult($key)
	    {
	     $keys=$key;
	       $key=Crypt::decrypt($key);
	        
	         	
$option = Session::get('option');	
     
      
		if (empty($option)) {
	   
	    	if (strpos($key, '&') != false) {
	    		$splitkey = explode('&', $key);
	    		$categorykey = $splitkey[0];
	    		$searchtype = $splitkey[1];
		    	$ids = explode('=', $categorykey);
		    	$types = explode('=', $searchtype); 

		    	$id   = $ids[1];
		    	$type = $types[1];
	    	} else {
	    		$id = '';
	    		$splitkey = explode('=', $key); 
	    		$type = $splitkey[1];
	    	}
	    	
	    	$catid = session()->get('catid'); 
	    	$category = session()->get('category'); 


	    	$query = Products::join('productscategories', 'products.Id', '=', 'productscategories.productId')->where('product_status','enabled');
	    	if(!empty($catid)){
	    	    $query->where('productscategories.subcategoryId','=',$catid);
	    	} else {
	    	    if($category =='women'){
	    	        $query->where('productscategories.categoryId','!=',26);
	    	    } elseif($category == 'Kids'){
                $query->where('productscategories.categoryId','!=',13);
                $query->where('productscategories.categoryId','!=',14);
                $query->where('productscategories.categoryId','!=',15);
                $query->where('productscategories.categoryId','!=',27);
                $query->where('productscategories.categoryId','!=',20);
                } elseif($category == 'luxury') {
                    $query->where('productscategories.categoryId','!=',26);
                    $query->where('products.product_type','!=','normal');
                }
	    	}
	    	
	    	
	    	if($type == 'color'){
	    	    $query->join('productscolor', 'products.Id', '=', 'productscolor.productId');
	    	    $query->where('productscolor.colorId','=',$id);
	    	}
	    	
	    	if($type == 'size'){
	    	    $query->join('productsize', 'products.Id', '=', 'productsize.productId');
	    	    $query->where('productsize.sizeId','=',$id);
	    	}
	   // 	if ($type == 'color' && !empty($id)) {
	   // 	$query->join('productscolor', 'products.Id', '=', 'productscolor.productId');
	   // 	}
	   // 	if ($type == 'size' && !empty($id)) {
	   // 	$query->join('productsize', 'products.Id', '=', 'productsize.productId');
	   // 	}
	   // 	if ($type == 'subcat' && !empty($id) ) {
	   // 	$query->where('productscategories.subcategoryId','=',$id);
	   //     }
	   //     if ($type == 'color' && !empty($id)) {
	   //     $query->where('productscolor.colorId','=',$id);
	   //     }

	   //     if ($type == 'size' && !empty($id)) {
	   // 	$query->where('productsize.sizeId','=',$id);
	   // 	}
	    	
	   // 	if (!empty($catid) && $category !='Kids') {
	   // 		$query->where('productscategories.subcategoryId','=',$catid);
	   // 	}
	    	
	   // 	if($category =='Kids'){
	   // 	    $query->where('productscategories.categoryId','=',26);
	   // 	}
	    	
	    	
	    	
	    	
	        
	    	$result = $query->paginate(8);

	    	$products= $result; 

	    		 return view('frontent/productlisting')->with(array('products'=>$products,'keyss'=>$keys,'key'=>$key));
		    
		}
		else{
		    
	    	if (strpos($key, '&') != false) {
	    		$splitkey = explode('&', $key);
	    		$categorykey = $splitkey[0];
	    		$searchtype = $splitkey[1];
		    	$ids = explode('=', $categorykey);
		    	$types = explode('=', $searchtype); 

		    	$id   = $ids[1];
		    	$type = $types[1];
	    	} else {
	    		$id = '';
	    		$splitkey = explode('=', $key); 
	    		$type = $splitkey[1];
	    	}
	    	
	    	$catid = session()->get('catid'); 
	    	$category = session()->get('category'); 


	    	$query = Products::join('productscategories', 'products.Id', '=', 'productscategories.productId')->where('product_status','enabled');
	    	if(!empty($catid)){
	    	    $query->where('productscategories.subcategoryId','=',$catid);
	    	} else {
	    	    if($category =='women'){
	    	        $query->where('productscategories.categoryId','!=',26);
	    	    } elseif($category == 'Kids'){
                $query->where('productscategories.categoryId','!=',13);
                $query->where('productscategories.categoryId','!=',14);
                $query->where('productscategories.categoryId','!=',15);
                $query->where('productscategories.categoryId','!=',27);
                $query->where('productscategories.categoryId','!=',20);
                } elseif($category == 'luxury') {
                    $query->where('productscategories.categoryId','!=',26);
                    $query->where('products.product_type','!=','normal');
                }
	    	}
	    	
	    	
	    	if($type == 'color'){
	    	    $query->join('productscolor', 'products.Id', '=', 'productscolor.productId');
	    	    $query->where('productscolor.colorId','=',$id);
	    	}
	    	
	    	if($type == 'size'){
	    	    $query->join('productsize', 'products.Id', '=', 'productsize.productId');
	    	    $query->where('productsize.sizeId','=',$id);
	    	}
	    	   if( $option == 'newest'){
             $query->orderBy('products.created_at', 'DESC');
        }
        
        
        if( $option == 'lowhigh'){
             $query->orderBy('products.product_price', 'ASC');
        }
        
         if( $option == 'highlow'){
          
              $query->orderBy('products.product_price', 'DESC');
         }
         
         if( $option == 'discount'){
              $datas=Offers::where('type','individualproduct')->pluck('productid');
              $query->WhereIn('products.Id',$datas);
         }
        
	   // 	if ($type == 'color' && !empty($id)) {
	   // 	$query->join('productscolor', 'products.Id', '=', 'productscolor.productId');
	   // 	}
	   // 	if ($type == 'size' && !empty($id)) {
	   // 	$query->join('productsize', 'products.Id', '=', 'productsize.productId');
	   // 	}
	   // 	if ($type == 'subcat' && !empty($id) ) {
	   // 	$query->where('productscategories.subcategoryId','=',$id);
	   //     }
	   //     if ($type == 'color' && !empty($id)) {
	   //     $query->where('productscolor.colorId','=',$id);
	   //     }

	   //     if ($type == 'size' && !empty($id)) {
	   // 	$query->where('productsize.sizeId','=',$id);
	   // 	}
	    	
	   // 	if (!empty($catid) && $category !='Kids') {
	   // 		$query->where('productscategories.subcategoryId','=',$catid);
	   // 	}
	    	
	   // 	if($category =='Kids'){
	   // 	    $query->where('productscategories.categoryId','=',26);
	   // 	}
	    	
	    	
	    	
	    	
	        
	    	$result = $query->paginate(8);

	    	$products = $result; 

	    	 return view('frontent/productlisting')->with(array('products'=>$products,'keyss'=>$key,'key'=>$keys));
		}
	    }
	    
	      public function fetch_datas(Request $request,$key)
	    {
	     $keys=$key;
	       $key=Crypt::decrypt($key);
	        
	         	
$option = Session::get('option');	
     
      
		if (empty($option)) {
	   
	    	if (strpos($key, '&') != false) {
	    		$splitkey = explode('&', $key);
	    		$categorykey = $splitkey[0];
	    		$searchtype = $splitkey[1];
		    	$ids = explode('=', $categorykey);
		    	$types = explode('=', $searchtype); 

		    	$id   = $ids[1];
		    	$type = $types[1];
	    	} else {
	    		$id = '';
	    		$splitkey = explode('=', $key); 
	    		$type = $splitkey[1];
	    	}
	    	
	    	$catid = session()->get('catid'); 
	    	$category = session()->get('category'); 


	    	$query = Products::join('productscategories', 'products.Id', '=', 'productscategories.productId')->where('product_status','enabled');
	    	if(!empty($catid)){
	    	    $query->where('productscategories.subcategoryId','=',$catid);
	    	} else {
	    	    if($category =='women'){
	    	        $query->where('productscategories.categoryId','!=',26);
	    	    } elseif($category == 'Kids'){
                $query->where('productscategories.categoryId','!=',13);
                $query->where('productscategories.categoryId','!=',14);
                $query->where('productscategories.categoryId','!=',15);
                $query->where('productscategories.categoryId','!=',27);
                $query->where('productscategories.categoryId','!=',20);
                } elseif($category == 'luxury') {
                    $query->where('productscategories.categoryId','!=',26);
                    $query->where('products.product_type','!=','normal');
                }
	    	}
	    	
	    	
	    	if($type == 'color'){
	    	    $query->join('productscolor', 'products.Id', '=', 'productscolor.productId');
	    	    $query->where('productscolor.colorId','=',$id);
	    	}
	    	
	    	if($type == 'size'){
	    	    $query->join('productsize', 'products.Id', '=', 'productsize.productId');
	    	    $query->where('productsize.sizeId','=',$id);
	    	}
	   // 	if ($type == 'color' && !empty($id)) {
	   // 	$query->join('productscolor', 'products.Id', '=', 'productscolor.productId');
	   // 	}
	   // 	if ($type == 'size' && !empty($id)) {
	   // 	$query->join('productsize', 'products.Id', '=', 'productsize.productId');
	   // 	}
	   // 	if ($type == 'subcat' && !empty($id) ) {
	   // 	$query->where('productscategories.subcategoryId','=',$id);
	   //     }
	   //     if ($type == 'color' && !empty($id)) {
	   //     $query->where('productscolor.colorId','=',$id);
	   //     }

	   //     if ($type == 'size' && !empty($id)) {
	   // 	$query->where('productsize.sizeId','=',$id);
	   // 	}
	    	
	   // 	if (!empty($catid) && $category !='Kids') {
	   // 		$query->where('productscategories.subcategoryId','=',$catid);
	   // 	}
	    	
	   // 	if($category =='Kids'){
	   // 	    $query->where('productscategories.categoryId','=',26);
	   // 	}
	    	
	    	
	    	
	    	
	        
	    	$result = $query->paginate(8);

	    	$products= $result; 

	    		 return view('paginationlist')->with(array('products'=>$products,'keyss'=>$keys,'key'=>$key))->render();
		    
		}
		else{
		    
	    	if (strpos($key, '&') != false) {
	    		$splitkey = explode('&', $key);
	    		$categorykey = $splitkey[0];
	    		$searchtype = $splitkey[1];
		    	$ids = explode('=', $categorykey);
		    	$types = explode('=', $searchtype); 

		    	$id   = $ids[1];
		    	$type = $types[1];
	    	} else {
	    		$id = '';
	    		$splitkey = explode('=', $key); 
	    		$type = $splitkey[1];
	    	}
	    	
	    	$catid = session()->get('catid'); 
	    	$category = session()->get('category'); 


	    	$query = Products::join('productscategories', 'products.Id', '=', 'productscategories.productId')->where('product_status','enabled');
	    	if(!empty($catid)){
	    	    $query->where('productscategories.subcategoryId','=',$catid);
	    	} else {
	    	    if($category =='women'){
	    	        $query->where('productscategories.categoryId','!=',26);
	    	    } elseif($category == 'Kids'){
                $query->where('productscategories.categoryId','!=',13);
                $query->where('productscategories.categoryId','!=',14);
                $query->where('productscategories.categoryId','!=',15);
                $query->where('productscategories.categoryId','!=',27);
                $query->where('productscategories.categoryId','!=',20);
                } elseif($category == 'luxury') {
                    $query->where('productscategories.categoryId','!=',26);
                    $query->where('products.product_type','!=','normal');
                }
	    	}
	    	
	    	
	    	if($type == 'color'){
	    	    $query->join('productscolor', 'products.Id', '=', 'productscolor.productId');
	    	    $query->where('productscolor.colorId','=',$id);
	    	}
	    	
	    	if($type == 'size'){
	    	    $query->join('productsize', 'products.Id', '=', 'productsize.productId');
	    	    $query->where('productsize.sizeId','=',$id);
	    	}
	    	   if( $option == 'newest'){
             $query->orderBy('products.created_at', 'DESC');
        }
        
        
        if( $option == 'lowhigh'){
             $query->orderBy('products.product_price', 'ASC');
        }
        
         if( $option == 'highlow'){
          
              $query->orderBy('products.product_price', 'DESC');
         }
         
         if( $option == 'discount'){
             
         }
        
	   // 	if ($type == 'color' && !empty($id)) {
	   // 	$query->join('productscolor', 'products.Id', '=', 'productscolor.productId');
	   // 	}
	   // 	if ($type == 'size' && !empty($id)) {
	   // 	$query->join('productsize', 'products.Id', '=', 'productsize.productId');
	   // 	}
	   // 	if ($type == 'subcat' && !empty($id) ) {
	   // 	$query->where('productscategories.subcategoryId','=',$id);
	   //     }
	   //     if ($type == 'color' && !empty($id)) {
	   //     $query->where('productscolor.colorId','=',$id);
	   //     }

	   //     if ($type == 'size' && !empty($id)) {
	   // 	$query->where('productsize.sizeId','=',$id);
	   // 	}
	    	
	   // 	if (!empty($catid) && $category !='Kids') {
	   // 		$query->where('productscategories.subcategoryId','=',$catid);
	   // 	}
	    	
	   // 	if($category =='Kids'){
	   // 	    $query->where('productscategories.categoryId','=',26);
	   // 	}
	    	
	    	
	    	
	    	
	        
	    	$result = $query->paginate(8);

	    	$products = $result; 

	    	 return view('paginationlist')->with(array('products'=>$products,'keyss'=>$key,'key'=>$keys))->render();
		}
	    }
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    public function search(Request $request)
	    {
	    	$key = $request->keyword;

	    	$result  = Products::where('product_name','LIKE','%'.$key)->where('product_status','enabled')->paginate(10); 
	    	$data['products'] = $result;
	    	return view('frontent/productlisting',$data);
	    }


}
