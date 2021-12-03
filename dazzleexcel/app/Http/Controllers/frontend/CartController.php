<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use DB;

use App\model\Products;
use App\model\Carts;
use App\model\guestcart;


use Session;

class CartController extends Controller
{

    public function addtocart(Request $request,$id)
    {
         Session::forget('cart');
            Session::forget('parameters');
            Session::forget('type');
            Session::forget('page');
        $id     = Crypt::decrypt($id); 
        $quantity = $request->qty; 

    $productdetail = Products::select('product_price','product_name','product_type','current_quantity','product_quantity')->where('Id','=',$id)->first();
        $price = $productdetail->product_price;
        $type = $productdetail->product_type;
        if ($productdetail->current_quantity == 0) {
            $stockqty = $productdetail->product_quantity;   
        } else {
            $stockqty = $productdetail->current_quantity;
        }
        //echo $productdetail->current_quantity;
        $cart = session()->get('cart'); 
         if (Auth::user()) {
           $currentcart = Carts::where('productId','=',$id)->where('UserId','=',Auth::user()->id)->first();
          $products=Products::where('id',$id)->first(); 
          if($currentcart){
           if ($currentcart->quantity >= $products->product_quantity ) { 
               Session::flash('error', 'Quantity not exist!!');
           
            $idencript = Crypt::encrypt($id);
                 if ($type == 'normal') {
                    return redirect('productdetail/'.$idencript);
                } else {
                    return redirect('luxury/'.$idencript);
                }
          }
          }
         }
        if (Auth::user()) {
            if ($quantity >$productdetail->product_quantity ) {
                Session::flash('error', 'Quantity not exist!!');
                 $idencript = Crypt::encrypt($id);
                 if ($type == 'normal') {
                    return redirect('productdetail/'.$idencript);
                } else {
                    return redirect('luxury/'.$idencript);
                }
            } else {
                $currentcart = Carts::where('productId','=',$id)->where('UserId','=',Auth::user()->id)->first();
                if (!empty($cart)) {
                    $product_name = $cart[$id]['name'];
                    $product_qty = $cart[$id]['quantity']; 
                    $product_price = $cart[$id]['price'];

                    if (!empty($currentcart)) {
                       $product_qty = $currentcart->quantity;
                       $currentqty = $product_qty + $quantity; 
                       $objcarts                     = Carts::find($currentcart->id); 
                       $objcarts->quantity           = $currentqty; 
                       $objcarts->save(); 
                    } else {
                         $objcarts                     = new Carts(); 
                         $objcarts->UserId             = Auth::user()->id; 
                         $objcarts->productId          = $id; 
                         $objcarts->quantity           = $product_qty; 
                         $objcarts->price              = $product_price;
                         $objcarts->save(); 
                    }
                }  else {
                    if (!empty($currentcart)) {
                       $product_qty = $currentcart->quantity;
                       $currentqty = $product_qty + $quantity; 
                        $objcarts                     = Carts::find($currentcart->id); 
                        $objcarts->quantity           = $currentqty; 
                        $objcarts->save(); 
                    } else {
                        $objcarts                     = new Carts(); 
                        $objcarts->UserId             = Auth::user()->id; 
                        $objcarts->productId          = $id; 
                        $objcarts->quantity           = $quantity; 
                        $objcarts->price              = $price;
                        $objcarts->save(); 
                    }  
                }
            }
        } else {
            if ($quantity > $stockqty) {
               Session::flash('error', 'Quantity not exist!!');
                $idencript = Crypt::encrypt($id);
                if ($type == 'normal') {
                    return redirect('productdetail/'.$idencript);
                } else {
                    return redirect('luxury/'.$idencript);
                }
            } else {
                
                 $currentcart = guestcart::where('productid','=',$id)->where('sessionid','=',Session::get('sessionid'))->first();
          $products=Products::where('id',$id)->first(); 
          if($currentcart){
           if ($currentcart->quantity >= $products->product_quantity ) { 
               Session::flash('error', 'Quantity not exist!!');
           
            $idencript = Crypt::encrypt($id);
                 if ($type == 'normal') {
                    return redirect('productdetail/'.$idencript);
                } else {
                    return redirect('luxury/'.$idencript);
                }
          }
          }
           if ($quantity >$productdetail->product_quantity ) {
                Session::flash('error', 'Quantity not exist!!');
                 $idencript = Crypt::encrypt($id);
                 if ($type == 'normal') {
                    return redirect('productdetail/'.$idencript);
                } else {
                    return redirect('luxury/'.$idencript);
                }       
           }
                $questcart = guestcart::get(); 
                //Session::forget('sessionid');
                $seid = Session::get('sessionid'); 
                $count = count($questcart); 
                if ($count == 0) {
                    $sessionid= 1;
                } else {
                    $cart = guestcart::latest()->first(); 
                    $sesid = $cart->sessionid;
                    $sessionid = $sesid + 1;
                }
                if (!empty($seid)) {
                    $session = $seid;
                } else {
                    Session::put('sessionid', $sessionid);
                    $session = $sessionid;
                }
                $currentcart = guestcart::where('productid','=',$id)->where('sessionid','=',$session)->first();

                if (!empty($currentcart)) {
                    $product_qty = $currentcart->quantity;
                    $currentqty = $product_qty + $quantity;
                    $objcarts                     = guestcart::find($currentcart->id); 
                    $objcarts->quantity           = $currentqty; 
                    $objcarts->save(); 
                } else {
                    $objcarts                     = new guestcart(); 
                    $objcarts->sessionid          = $session; 
                    $objcarts->productid          = $id; 
                    $objcarts->quantity           = $quantity; 
                    $objcarts->price              = $price; 
                    $objcarts->save(); 
                }
            }
            
        }


        Session::flash('message', 'Product added to cart successfully!!');
        
        $idencript = Crypt::encrypt($id);
        if ($type == 'normal') {
            return redirect('productdetail/'.$idencript);
        } else {
            return redirect('luxury/'.$idencript);
        }
        

    }


    public function deleteitem($id)
    {
        $id     = Crypt::decrypt($id);
        $sessionid = Session::get('sessionid'); 
        if (Auth::user()) {
           DB::table('carts')->where('id', $id)->delete();
        } else {
            guestcart::where('id', $id)->delete();
        }
        return redirect('/');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responseproduct_price
     */
    public function index()
    {
        if (Auth::user()) {
           $loggedinId = Auth::user()->id;
           $data['carts'] = Carts::select('carts.productId','carts.quantity','products.product_price','products.product_name','carts.id')
                             ->join('products', 'carts.productId', '=', 'products.Id')
                             ->where('carts.UserId','=',$loggedinId)
                               ->where('product_quantity' ,'>',0)
                             ->get();
        } else {
            $sessionid = Session::get('sessionid'); 
            $data['carts'] = guestcart::select('quest_cart.productid','quest_cart.quantity','products.product_price','products.product_name',
                             'quest_cart.id')
                             ->join('products', 'quest_cart.productid', '=', 'products.Id')
                               ->where('product_quantity' ,'>',0)
                             ->where('quest_cart.sessionid','=',$sessionid)
                             ->get();
        }
        
        return view('frontent/cart',$data);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('frontent/cart');
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
        $id     = Crypt::decrypt($id); 
         $productid = $request->cartid; 
         if (Auth::user()) {
             $objcarts                     = Carts::find($id); 
             $objcarts->quantity           = $request->quant; 
             $objcarts->save(); 
         } else {
            

             $objcarts                     = guestcart::find($request->cartid); 
             $objcarts->quantity           = $request->quant; 
             $objcarts->save(); 
         }
        
         return redirect('customer/carts/');
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
