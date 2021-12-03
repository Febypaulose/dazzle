<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

use App\model\wishlist;
use App\model\guestwishlist;
use App\model\Products;

use Session;

class wishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {
             $userid = Auth::user()->id;
             $data['wislists'] = wishlist::select('products.Id','products.product_name','products.product_price','products.stock_status',
                            'products.product_type')
                   ->join('products', 'wishlist.productid', '=', 'products.Id')
                   ->where('wishlist.userid','=',$userid)
                   ->get();
        } else {
            $userid = Session::get('sessionid');
            $data['wislists'] = guestwishlist::select('products.Id','products.product_name','products.product_price','products.stock_status',
                            'products.product_type')
                                ->join('products', 'quest_wishlist.productid', '=', 'products.Id')
                                ->where('quest_wishlist.userid','=',$userid)
                                ->get();
        }
       
        return view('frontent/wishlist',$data);
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
        $id     = Crypt::decrypt($id); 
       // Session::forget('sessionid');

        if (Auth::user()) {
            $currentwishlistcount = wishlist::where('productid','=',$id)->where('UserId','=',Auth::user()->id)->count(); 
            $products = Products::where('Id','=',$id)->first(); 
            if ($currentwishlistcount == 1) {
           Session::flash('message', 'Product exist in wishlist!!');
            } else {
               $objwishlist                     = new wishlist(); 
               $objwishlist->userid             = Auth::user()->id; 
               $objwishlist->productid          = $id; 
               $objwishlist->save();  
               Session::flash('message', 'Product added to Wishlist successfully!!');
            }
        } else {
             $sessionId = Session::get('sessionid');
             $questwishlist = guestwishlist::get(); 
             $count = count($questwishlist);
             if ($count == 0) {
                 $sessionid= 1;
                 $sesid = '';
             } else {
                $wishlist = guestwishlist::latest()->first();
                $sesid = $wishlist->userid; 
                if (empty($sessionId)) {
                    $sessionid = $sesid + 1;
                } else{
                    $sessionid = $sesid;
                }
             }



             if (!empty($sesid) && !empty($sessionId) ) {
                $session = $sessionid;
            } else {
               Session::put('sessionid', $sessionid);
                $session = $sessionid;
            }

            

            


             $products = Products::where('Id','=',$id)->first(); 
            $currentwishlistcount = guestwishlist::where('productid','=',$id)->where('userid','=',$session)->count();  
            if ($currentwishlistcount == 1) {
                Session::flash('message', 'Product exist in wishlist!!');
            } else {
                $objwishlist                     = new guestwishlist(); 
                $objwishlist->userid             = $session; 
                $objwishlist->productid          = $id; 
                $objwishlist->save();  
                Session::flash('message', 'Product added to Wishlist successfully!!');
            }
            // Session::put('parameters', $id);
            // Session::put('type', "buyer");
            // Session::put('page', "wishlist");

             //return redirect('loginregister');
        }
        // Session::forget('parameters');
        // Session::forget('type');
        // Session::forget('page');
        $idencript = Crypt::encrypt($id);
        if ($products->product_type == 'normal') {
           return redirect('productdetail/'.$idencript);
        } else {
            return redirect('luxury/'.$idencript);
        }
        
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
        $id     = Crypt::decrypt($id);
        if (Auth::user()) {
            wishlist::where('productid', '=', $id)->delete();
        } else {
            guestwishlist::where('productid', '=', $id)->delete();
        }
        Session::flash('message', 'Wishlist Deleted  Successfully!');
         return redirect('customer/wishlist');
    }
}
