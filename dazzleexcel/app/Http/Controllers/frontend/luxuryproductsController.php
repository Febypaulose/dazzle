<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\model\Products;
use App\model\Reviews;
use App\model\Productimages;
use App\Helpers\helpers;
use Session;
use App\model\Offers;
class luxuryproductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session::put('category','luxury');
           $option = Session::get('option');
           	if (empty($option)) {
        $data['products'] = Products::select('products.Id','products.product_name','products.product_price')
                     ->join('productscategories', 'products.Id', '=', 'productscategories.productId')
                     ->where('products.product_type','=','luxury')
                       ->where('products.product_status','enabled')
                     ->paginate(8);

        return view('frontent/luxuryproductlisting',$data);
           	}
         	else{
          $productss= Products::select('products.Id','products.product_name','products.product_price')
                     ->join('productscategories', 'products.Id', '=', 'productscategories.productId')
                     ->where('products.product_type','=','luxury')
                       ->where('products.product_status','enabled');
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
              $datas=Offers::where('type','individualproduct')->pluck('productid');
             $productss->WhereIn('products.Id',$datas);
         }
        
        $result =  $productss->paginate(8); 
	    $products = $result;             
                       
                       
                     

        return view('frontent/luxuryproductlisting')->with(array('products'=>$products,));	    
         	    
         	    
         	}  	
           	
    }
public function fetch_data()
    {
        session::put('category','luxury');
         $option = Session::get('option');	
         	if (empty($option)) {
        $products= Products::select('products.Id','products.product_name','products.product_price')
                     ->join('productscategories', 'products.Id', '=', 'productscategories.productId')
                     ->where('products.product_type','=','luxury')
                       ->where('products.product_status','enabled')
                     ->paginate(8);

       return view('paginationluxury')->with(array('products'=>$products))->render();
         	}
         	
         	
         	else{
         	    $productss= Products::select('products.Id','products.product_name','products.product_price')
                     ->join('productscategories', 'products.Id', '=', 'productscategories.productId')
                     ->where('products.product_type','=','luxury')
                       ->where('products.product_status','enabled');
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
                  

       return view('paginationluxury')->with(array('products'=>$products))->render();  
                          
         	}
         	
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function productoption(Request $request)
    {
        
       if($request->option!=''){
        $option = $request->option; 
    	Session::put('option',$option);
     return response()->json($option);
       }
    } 
     
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id     = Crypt::decrypt($id);
        $data['products'] = Products::select('products.Id','products.summary','products.product_name','products.product_price','category.category',
                            'products.description','products.productdesigner')
                     ->join('productscategories', 'products.Id', '=', 'productscategories.productId')
                     ->join('category', 'productscategories.subcategoryId', '=', 'category.Id')
                     ->where('products.Id','=',$id)
                     ->first();
        $data['productimages'] = Productimages::where('productId','=',$id)->get();
        $data['reviews'] = Reviews::where('productid','=',$id)->get();
        return view('frontent/luxuryproductdetail',$data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
