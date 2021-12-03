<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\model\Banner;
use App\model\Products;
use App\model\Segmenttype;
use App\model\Segments;
use Session;



use App\Helpers\helpers;
class FrontendController extends Controller
{
    public function index()
    {
        //  $helpers = new helpers();
        // return $price = $helpers->currency_conversion(100);
    //   return   session::get('currency');
     $helpers = new helpers();
     $price = $helpers->currency_conversions(1);
    Session::put('priceconvert',  $price );
        $data['bannertop'] = Banner::where('position','=','top')->get(); 
        $data['bannermiddle'] = Banner::where('position','=','middle')->get();
        $data['bannerbottom'] = Banner::where('position','=','bottom')->get(); 
        $data['segment1'] = Products::select('products.Id','products.product_name','products.product_price')
                           ->join('segments', 'products.Id', '=', 'segments.productId')
                           ->join('segmenttype', 'segments.segmenttypeId', '=', 'segmenttype.id')
                           ->where('segmenttype.segmentslug','=','designer-look')
                           ->orderBy('segments.productId', 'ASC')
                           ->limit(5)
                           ->get(); 
        $data['segment2'] = Products::select('products.Id','products.product_name','products.product_price')
                           ->join('segments', 'products.Id', '=', 'segments.productId')
                           ->join('segmenttype', 'segments.segmenttypeId', '=', 'segmenttype.id')
                           ->where('segmenttype.segmentslug','=','get-the-look')
                           ->orderBy('segments.productId', 'ASC')
                           ->limit(5)
                           ->get(); 
        $data['segment3'] = Products::select('products.Id','products.product_name','products.product_price')
                           ->join('segments', 'products.Id', '=', 'segments.productId')
                           ->join('segmenttype', 'segments.segmenttypeId', '=', 'segmenttype.id')
                           ->where('segmenttype.segmentslug','=','lady-look')
                           ->orderBy('segments.productId', 'ASC')
                           ->limit(5)
                           ->get(); 
        return view('frontent/home',$data);
    }




    public function menucatimages(Request $request)
    {
        $catid = $request->id; 

        $productimage = Products::select('products.Id','productsimages.image_url')
                        //->join('productscategories', 'products.Id', '=', 'productscategories.productId')
                        ->join('productsimages', 'products.Id', '=', 'productsimages.productId')
                        ->join('menufeatured', 'products.Id', '=', 'menufeatured.productidid')
                        ->where('menufeatured.catid','=',$catid)
                        ->first();
        return response()->json($productimage);
    }
    
    public function notificationdisble(Request $request){
        $id = $request->id;
        session::put('noti_status',"disable");
        session::put('noti_id',$id);
    }
    
    
}
