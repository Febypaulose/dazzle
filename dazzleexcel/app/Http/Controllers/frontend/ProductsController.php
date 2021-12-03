<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;

use App\Helpers\helpers;

use App\model\Currency;
use App\model\Category;
use App\model\Colours;
use App\model\Size;
use App\model\Offers;
use App\model\Products;
use App\model\Reviews;
use App\model\Productcategory;
use App\model\Productimages;
use App\model\Productsize;
use App\model\Productcolor;

use Session;

class ProductsController extends Controller
{
    public function productlisting(Request $request,$id)
    {
        // Session::forget('option');
       $ids=$id;
      
     $option = Session::get('option');	
     
      
		if (empty($option)) {
		    
		
    	 $id    = Crypt::decrypt($id);
       $submenu = Category::where('Id','=',$id)->first(); 
       $subcategory = Category::where('Id','=',$submenu->parentId)->first(); 
       $parent = Category::where('Id','=',$subcategory->parentId)->first(); 

       if (!empty($parent)) {
         session::put('category',$parent->category);
         session::put('catid',$submenu->Id);
       } else {
        session::put('category',$subcategory->category);
        session::put('catid',$submenu->Id);
       }
       
       
    	 $products = Products::select('products.Id','products.product_name','products.product_price','products.product_status')
    	             ->join('productscategories', 'products.Id', '=', 'productscategories.productId')
    	             ->where('products.product_status','enabled')
    	             ->where('productscategories.subcategoryId','=',$id)
    	              ->where('products.product_type','=','normal')
    	              
    	             ->paginate(8);

    	 return view('frontent/productlisting')->with(array('products'=>$products,'idss'=>$id,'ids'=>$ids));
		}
	else{
	     $id    = Crypt::decrypt($id);
       $submenu = Category::where('Id','=',$id)->first(); 
       $subcategory = Category::where('Id','=',$submenu->parentId)->first(); 
       $parent = Category::where('Id','=',$subcategory->parentId)->first(); 

       if (!empty($parent)) {
         session::put('category',$parent->category);
         session::put('catid',$submenu->Id);
       } else {
        session::put('category',$subcategory->category);
        session::put('catid',$submenu->Id);
       }
       
       
    	 $productss = Products::select('products.Id','products.product_name','products.product_price','products.product_status','products.created_at')
    	             ->join('productscategories', 'products.Id', '=', 'productscategories.productId')
    	             ->where('products.product_status','enabled')
    	             ->where('productscategories.subcategoryId','=',$id)
    	              ->where('products.product_type','=','normal');
    	   
        if( $option == 'newest'){
             $productss->orderBy('products.created_at', 'DESC');
        }
        
        
        if( $option == 'lowhigh'){
            $productss->orderBy('products.product_price', 'ASC');
        }
        
         if( $option == 'highlow'){
          
              $productss->orderBy('products.product_price', 'DESC');
         }
         
         if( $option == 'http://localhost/daddycool/adminbackend/Product/TV%20&%20Audioa/Product-paginationproducts/eyJpdiI6ImlDV2JPeWhEVFRhcFdTNFlyUEU5dWc9PSIsInZhbHVlIjoieGxDUVZYdGhycmRpRGdFbXNSdzk4QT09IiwibWFjIjoiMjAxNTYwZTlmYzRkN2M1YWYyN2QzZDEyNzJhY2Y0NDU2M2U5YjA0NWQyM2MzZDBiNDhkMzcwMTAxOTRlZDQ0MyJ9?page=2#F48L168'){
              $datas=Offers::where('type','individualproduct')->pluck('productid');
             $productss->WhereIn('products.Id',$datas);
         }
        
        $result =  $productss->paginate(8); 
	    $products = $result;           
    	             
    	           
    	 return view('frontent/productlisting')->with(array('products'=>$products,'idss'=>$id,'ids'=>$ids));
	    
	    
	}	
		
		
    }
    public function productoption(Request $request,$id)
    {
        
       if($request->option!=''){
        $option = $request->option; 
    	Session::put('option',$option);
     return response()->json($option);
       }
    }

public function fetch_datas(Request $request,$id)
{
 
        $ids=$id;
      
     $option = Session::get('option');	
     
      
		if (empty($option)) {
		    
		
    
       $submenu = Category::where('Id','=',$id)->first(); 
       $subcategory = Category::where('Id','=',$submenu->parentId)->first(); 
       $parent = Category::where('Id','=',$subcategory->parentId)->first(); 

       if (!empty($parent)) {
         session::put('category',$parent->category);
         session::put('catid',$submenu->Id);
       } else {
        session::put('category',$subcategory->category);
        session::put('catid',$submenu->Id);
       }
       
       
    	 $products = Products::select('products.Id','products.product_name','products.product_price','products.product_status')
    	             ->join('productscategories', 'products.Id', '=', 'productscategories.productId')
    	             ->where('products.product_status','enabled')
    	             ->where('productscategories.subcategoryId','=',$id)
    	              ->where('products.product_type','=','normal')
    	             ->paginate(8);

    	 return view('paginationlist')->with(array('products'=>$products,'id'=>$id,'idss'=>$ids))->render();
		}
	else{
	   //return $id;
       $submenu = Category::where('Id','=',$id)->first(); 
       $subcategory = Category::where('Id','=',$submenu->parentId)->first(); 
       $parent = Category::where('Id','=',$subcategory->parentId)->first(); 

       if (!empty($parent)) {
         session::put('category',$parent->category);
         session::put('catid',$submenu->Id);
       } else {
        session::put('category',$subcategory->category);
        session::put('catid',$submenu->Id);
       }
       
       
    	 $productss = Products::select('products.Id','products.product_name','products.product_price','products.product_status','products.created_at')
    	             ->join('productscategories', 'products.Id', '=', 'productscategories.productId')
    	             ->where('products.product_status','enabled')
    	             ->where('productscategories.subcategoryId','=',$id)
    	              ->where('products.product_type','=','normal');
    	   
        if( $option == 'newest'){
             $productss->orderBy('products.created_at', 'DESC');
        }
        
        
        if( $option == 'lowhigh'){
            $productss->orderBy('products.product_price', 'ASC');
        }
        
         if( $option == 'highlow'){
          
              $productss->orderBy('products.product_price', 'DESC');
         }
         
         if( $option == 'discount'){
             
         }
        
        $result =  $productss->paginate(8); 
	    $products = $result;           
    	             
    	           
    	 return view('paginationlist')->with(array('products'=>$products,'idss'=>$id,'ids'=>$ids))->render();
	    
	    
	}	
		
       

}

    public function full_productlisting($id)
    {
      $id     = Crypt::decrypt($id); 
      $category = Category::where('Id','=',$id)->first();
      
        $data['products'] = Products::select('products.Id','products.product_name','products.product_price','productscategories.categoryId','products.product_status')
                   ->join('productscategories', 'products.Id', '=', 'productscategories.productId')
                     ->where('products.product_status','enabled')
                  // ->where('productscategories.categoryId','!=',26)
                   ->get();
     
        
      
      

       return view('frontent/productlisting_full',$data);
    }


    public function womenproducts()
    {
        session::put('category','women');
     // $category = Category::where('Id','=',$id)->first();
      $data['products'] = Products::select('products.Id','products.product_name','products.product_price','productscategories.categoryId','products.product_status')
                   ->join('productscategories', 'products.Id', '=', 'productscategories.productId')
                   ->where('productscategories.categoryId','!=',0)
                   ->where('productscategories.categoryId','!=',26)
                   ->where('products.product_status','enabled')
                   ->paginate(12);
        return view('frontent/productlistingwomen_full',$data);
    }

    public function childproduct()
    {
       session::put('category','Kids');
       $data['products'] = Products::select('products.Id','products.product_name','products.product_price','productscategories.categoryId','products.product_status')
                   ->join('productscategories', 'products.Id', '=', 'productscategories.productId')
                   ->where('productscategories.categoryId','!=',13)
                   ->where('productscategories.categoryId','!=',14)
                   ->where('productscategories.categoryId','!=',15)
                   ->where('productscategories.categoryId','!=',27)
                   ->where('productscategories.categoryId','!=',20)
                    ->where('products.product_status','enabled')
                   ->paginate(12); 
                   
        return view('frontent/productlistingchild_full',$data);
    }


    public function productdetail(Request $request,$id)
    {
        //  session()->forget('currency');
         
         
    	$id     = Crypt::decrypt($id); 
        $productcategory = Productcategory::where('productId','=',$id)->first();
        $categoryId = $productcategory->categoryId; 
    	 $data['product'] = Products::select('products.Id','products.product_name','products.product_price','products.summary','products.description','category.category','products.product_type')
    	                   ->join('productscategories', 'products.Id', '=', 'productscategories.productId')
    	                   ->join('category', 'productscategories.subcategoryId', '=', 'category.Id')
    	                   ->where('products.Id','=',$id)
    	               
    	                   ->first();
        $data['relatedpro'] = Products::select('products.Id','products.product_name','products.product_price')
                           ->join('productscategories', 'products.Id', '=', 'productscategories.productId')
                           ->join('category', 'productscategories.subcategoryId', '=', 'category.Id')
                           ->where('productscategories.categoryId','=',$categoryId)
                           ->where('products.Id','!=',$id)
                           ->inRandomOrder()
                           ->orderBy('productscategories.categoryId', 'ASC')
                           ->limit(5)
                           ->get();
    	$data['productimagess'] = Productimages::where('productId','=',$id)->paginate(1);
    	
    	
    		$data['productimages'] = Productimages::where('productId','=',$id)->get();
      $data['reviews'] = Reviews::where('productid','=',$id)->get();
      
      
      

    	return view('frontent/productdetail_normal',$data);
    	
    	
    	
    	
    }
public function fetch_data(Request $request,$id)
{
  

       $productimagess  = Productimages::where('productId','=',$id)->paginate(1);
                
	return view('pagination',compact('productimagess'))->render();
       

}


    public function getquickviewdata(Request $request)
    {
      $productid = $request->id;
      $helpers = new helpers();
      $productdetail = Products::select('products.Id','products.product_name','products.product_price','products.summary','products.product_type')
                   ->where('products.Id','=',$productid)
                   ->first();
      $offers = Offers::where('productid','=',$productid)->first();
      $wholeoffers = Offers::where('type','=','wholewebsite')->first(); 
      if (!empty($offers) || !empty($wholeoffers)) {
        $dicount = $helpers->discountprice($productid,$productdetail->product_price);
        $splitprice = explode(' ', $dicount); 
        $data['productpriceval'] = $splitprice[1];
        $data['productprice'] = $dicount;
      } else {
        $price = $helpers->currency_conversion($productid,$productdetail->product_price);
        $splitprice = explode(' ', $price); 
        $data['productpriceval'] = $splitprice[1];
        $data['productprice'] = $price;
      }
      
      $data['detail'] = $productdetail;
      $data['productimages'] = Productimages::where('productId','=',$productid)->first();
      	$data['productimagess'] = Productimages::where('productId','=',$productid)->paginate(1);
       $data['crypt'] =  Crypt::encrypt($productid);
      return response()->json($data);
    }
    
    
    public function sortingdata(Request $request)
    {
        $orderby = $request->orderby; 
        
        $type = $request->type; 
        $catid = $request->catid;
        $typeval =  session::get('category');
         
         if(!empty($catid)){
            $id     = Crypt::decrypt($catid);
            if(strlen($id)<=2){
                $submenu = Category::where('Id','=',$id)->first(); 
            $subcategory = Category::where('Id','=',$submenu->parentId)->first();  
            $parent = Category::where('Id','=',$subcategory->parentId)->first();
            } else {
                session::put('type',$typeval);
            }
             
         }
         
         
        if(!empty($parent) && $parent->category == 'women' && !empty($catid) ) {
                $type = $parent->category;
                session::put('category',$type);
             } 
             else if(empty($parent) && !empty($subcategory)){
                  if(empty($parent) && $subcategory->category == 'Kids' && !empty($catid)) 
                  {
                   $type = $subcategory->category; 
                   session::put('category',$type);
                 } 
             }
            else 
            {
                 $type = $type;
                 session::put('category',$type);
                 if(!empty($type)){
                     Session::forget('type');
                 }
                 
                 if(empty(session::get('type'))){
                     session::put('type',$type);
                 }
                 
            }
            
            $typeval =  session::get('category'); 
            $type =  session::get('type'); 
            
          
            
        $query = Products::join('productscategories', 'products.Id', '=', 'productscategories.productId');
        
        if(!empty($id)){
            $query->where('productscategories.subcategoryId','=',$id);
        } else {
            if($type == 'women'){
                $query->where('productscategories.categoryId','!=',26);
            } elseif($type == 'Kids'){
                $query->where('productscategories.categoryId','!=',13);
                $query->where('productscategories.categoryId','!=',14);
                $query->where('productscategories.categoryId','!=',15);
                $query->where('productscategories.categoryId','!=',27);
                $query->where('productscategories.categoryId','!=',20);
            }elseif($type == 'luxury') {
                $query->where('productscategories.categoryId','!=',26);
                $query->where('products.product_type','!=','normal');
            }
        }
        
        
        
        if($orderby == 'newest'){
            $query->orderBy('products.created_at', 'DESC');
        }
        
        
        if($orderby == 'lowhigh'){
            $query->orderBy('products.product_price', 'DESC');
        }
        
         if($orderby == 'highlow'){
             $query->orderBy('products.product_price', 'ASC');
         }
         
         if($orderby == 'discount'){
             
         }
        
        $result = $query->paginate(12); 
	    $data['products'] = $result; 
	     return view('frontent/productlisting',$data);
	    
	    
        
        
        
    //     $orderby = $request->orderby;
        
    //     $catid = $request->catid;
    //      $typeval =  session::get('category'); 
    //     if(!empty($catid)){
            // $id     = Crypt::decrypt($catid); 
            // $submenu = Category::where('Id','=',$id)->first(); 
            // $subcategory = Category::where('Id','=',$submenu->parentId)->first();  
            // $parent = Category::where('Id','=',$subcategory->parentId)->first(); 
            
        //     if(!empty($parent) && $parent->category == 'women') {
        //         $type = $parent->category;
        //     } else {
        //         $type = $subcategory->category; 
        //     }
        // } else {
        //     $type = $request->type; 
        // }
        
        
    //   if(!empty($typeval)){
    //       session::put('category',$type);
    //   }
    
        
        
       
    //     $query = Products::join('productscategories', 'products.Id', '=', 'productscategories.productId');
    //     if($orderby == 'newest'){
    //         $query->orderBy('products.created_at', 'desc');
    //     }
        
        
        
        
    //     if($typeval == 'women'){
    //       $query->where('productscategories.categoryId','!=',0);
    //       $query->where('productscategories.categoryId','!=',26);
    //     } 
        
    //     // if(!empty($catid)){
    //     //     $query->where('productscategories.subcategoryId','==',$id);
    //     //}
        
        // if($typeval == 'Kids'){ 
        //     $query->where('productscategories.categoryId','!=',13);
        //     $query->where('productscategories.categoryId','!=',14);
        //     $query->where('productscategories.categoryId','!=',15);
        //     $query->where('productscategories.categoryId','!=',27);
        //     $query->where('productscategories.categoryId','!=',20);
        // }
        
        
    //     if($orderby == 'lowhigh' && $typeval == 'women'){
    //         $query->where('productscategories.categoryId','!=',0);
    //         $query->where('productscategories.categoryId','!=',26);
    //         $query->orderBy('products.product_price', 'DESC');
    //     }
        
    //     if($orderby == 'lowhigh' && $typeval == 'Kids'){
    //         $query->where('productscategories.categoryId','!=',13);
    //         $query->where('productscategories.categoryId','!=',14);
    //         $query->where('productscategories.categoryId','!=',15);
    //         $query->where('productscategories.categoryId','!=',27);
    //         $query->where('productscategories.categoryId','!=',20);
            
    //         $query->orderBy('products.product_price', 'DESC');
    //     }
        
    //     if($orderby == 'highlow' && $typeval == 'women'){
    //          $query->where('productscategories.categoryId','!=',0);
    //          $query->where('productscategories.categoryId','!=',26);
    //         $query->orderBy('products.product_price', 'ASC');
    //     }
        
    //      if($orderby == 'highlow' && $typeval == 'Kids'){
    //         $query->where('productscategories.categoryId','!=',13);
    //         $query->where('productscategories.categoryId','!=',14);
    //         $query->where('productscategories.categoryId','!=',15);
    //         $query->where('productscategories.categoryId','!=',27);
    //         $query->where('productscategories.categoryId','!=',20);
            
    //         $query->orderBy('products.product_price', 'ASC');
    //     }
        
    //     $result = $query->paginate(12);
	   // $data['products'] = $result; 
	    
	   
    }
    
    
    
    
    
    
    
}
