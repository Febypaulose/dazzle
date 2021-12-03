<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;

use App\model\Currency;
use App\model\Category;
use App\model\Colours;
use App\model\Size;
use App\model\Products;
use App\model\Reviews;
use App\model\Productcategory;
use App\model\Productimages;
use App\model\Productsize;
use App\model\Productcolor;
use App\model\Menufeatured;

use Session;
use PHPExcel_Worksheet_Drawing;
use App\Imports\NormaproductImport;
use Maatwebsite\Excel\Facades\Excel;
class NormalproductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['products'] = Products::where('product_type','=','normal')->get();
        
        $data['products']= Products::where('product_type','=','normal')
         ->join('productscategories', 'products.Id', '=', 'productscategories.productId')
         ->join('category', 'productscategories.categoryId', '=', 'category.Id')
           
         ->select('products.*','category.category')
         ->get();
       return view('admin/products/nbrowse',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $base_curr = env('BASE_CURR');
        $data['category'] = Category::where('parentId','=',0)->get();
        $data['currency'] = Currency::where('code','=',$base_curr)->first();
        $data['colours'] = Colours::orderBy('id', 'DESC')->get();
        $data['sizes'] = Size::orderBy('id', 'DESC')->get();
        $data['edit'] = 0;
        return view('admin/products/add-edit',$data);
    }


    public function menufeature($id)
    {
        $data['productid']     = Crypt::decrypt($id);
        $data['category'] = Category::where('parentId','=',0)->get();
        return view('admin/products/featured',$data);
    }


    public function makefeatured(Request $request)
    {
        $productid = $request->productid;
        $catid = $request->catid;

        Menufeatured::where('catid', '=', $catid)->delete();


        $objmenufeatured                    = new Menufeatured();  
        $objmenufeatured->productidid       =$productid;
        $objmenufeatured->catid             = $request->catid;
        $objmenufeatured->save(); 

        Session::flash('message', 'Featured Menu Created Successfully!');
        return redirect('manage/normalproducts');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function uploadProducts(Request $request)
    {
          $data=$request->all();        
 Excel::import(new NormaproductImport,request()->file('normalprodcuts_file'));
 Session::flash('message', 'Products Successfully Updated  !');
           return redirect('manage/normalproducts');
       }
    public function store(Request $request)
    { 
     
        $validator = Validator::make($request->all(), [
            'productnameo'      => 'required',
            'productpriceo'     => 'required',
            'oproducttags'      => 'required',
            'ncolor'            => 'required',
            'nsizes'            => 'required',
            'pcategoryId'       => 'required',
            'categoryId'    => 'required',
            'ostockstatus'      => 'required',
            'ostockcount'       => 'required',
            'opsummary'         => 'required',
            'opdescr'           => 'required',
        ]);
        if ($validator -> fails()) {
             return back()->withErrors($validator)->withInput();
        } else {
                 $productimage = $request->oproductresult;
                 $pricestring = $request->productpriceo;

                //  $str_split = explode('$', $pricestring);

                //  $amount_final = (int) $str_split[1];



                //  if (strpos($str_split, ',') !== false) {
                //         echo "My string contains Bob";
                // }

                // if (is_numeric($amount_final)) {
                //   $amount_final = str_replace(',', '', $str_split);
                //   $finalamt = $amount_final[1];
                // } else {
                //     $finalamt = $amount_final;
                // }

                $parent = $request->pcategoryId;
                 
                
                 $objproducts                    = new Products();  
                 $objproducts->product_type      = $request->typeId;
                 $objproducts->product_name      = $request->productnameo;
                 $objproducts->product_price     = $request->productpriceo;
                 $objproducts->product_tags      = $request->oproducttags;
                 $objproducts->stock_status      = $request->ostockstatus;
                 $objproducts->product_quantity  = $request->ostockcount;
                 $objproducts->summary           = $request->opsummary;
                 $objproducts->description       = $request->opdescr;
                 
                 if( $request->enabledisable =='')
                 {
                    $objproducts->product_status       = 'disabled'; 
                 }
                 $objproducts->save(); 


                 $lastId = $objproducts->Id;
                //  if ($parent == 26) {
                
                     $objproductcat                    = new Productcategory();  
                     $objproductcat->productId         = $lastId;
                     $objproductcat->categoryId        =$parent;
                     $objproductcat->subcategoryId     = $request->categoryId;
                     $objproductcat->save(); 
                     
                //  } else {
                //      $objproductcat                    = new Productcategory();  
                //      $objproductcat->productId         = $lastId;
                //      $objproductcat->categoryId        = $request->categoryId;
                //      $objproductcat->subcategoryId     = $request->subcategoryId;
                //      $objproductcat->save(); 
                //  }
                 

                 for($i=0;$i<count($request['ncolor']);$i++){
                    $objprodcolor = new Productcolor();
                    $objprodcolor->productId = $lastId;
                    $objprodcolor->colorId = $request['ncolor'][$i];
                    $objprodcolor->save();
                }

                for($i=0;$i<count($request['nsizes']);$i++){
                    $objprodcolor = new Productsize();
                    $objprodcolor->productId = $lastId;
                    $objprodcolor->sizeId = $request['nsizes'][$i];
                    $objprodcolor->save();
                }


                  $array =   $productimage;

                 $i = 0;
                 foreach ($array as $pimage) {

                     $objproductimage                 = new Productimages();  
                     $objproductimage->productId      = $lastId;
                     $objproductimage->image_url      = $pimage;
                     $objproductimage->save();
                     $i++; 
                 }
            Session::flash('message', 'Products Created Successfully!');
           return redirect('manage/normalproducts');
        }
    }

    public function removeproductimages($id)
    {
        $productimages = Productimages::where('id','=',$id)->first();
        $productid = $productimages->productId;

        $fullpath ='/products/'.$productimages->image_url; 

        $crypt = Crypt::encrypt($productid);

        Storage::disk('products')->delete($fullpath);

        Productimages::find($id)->delete(); 

       return redirect('manage/normalproducts/'.$crypt.'/edit');
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
        $data['reviews'] = Reviews::where('productid','=',$id)->get();
        return view('admin/Reviews/browse',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $id     = Crypt::decrypt($id);
        
        $base_curr = env('BASE_CURR');
        $data['category'] = Category::where('parentId','=',0)->get();
        $data['subcategory'] = Category::where('parentId','!=',0)->get();
        $data['currency'] = Currency::where('code','=',$base_curr)->first();
        $data['colours'] = Colours::orderBy('id', 'DESC')->get();
        $data['sizes'] = Size::orderBy('id', 'DESC')->get();
        $data['products'] = Products::where('Id','=',$id)->first();
        $data['edit'] = 1;
        return view('admin/products/add-edit',$data);
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
        
    //   return  $request->enabledisable;
        $validator = Validator::make($request->all(), [
           'productnameo'      => 'required',
            'productpriceo'     => 'required',
            'oproducttags'      => 'required',
            'ncolor'            => 'required',
            'nsizes'            => 'required',
            'pcategoryId'       => 'required',
            'categoryId'    => 'required',
            'ostockstatus'      => 'required',
            'ostockcount'       => 'required',
            'opsummary'         => 'required',
            'opdescr'           => 'required',
        ]);
        if ($validator -> fails()) {
             return back()->withErrors($validator)->withInput();
        } else {
                 $id        = Crypt::decrypt($id);
                 $productimage = $request->oproductresult;
               
                 $objproducts                    = Products::find($id);  
                 $objproducts->product_type      = 'normal';
                 $objproducts->product_name      = $request->productnameo;
                 $objproducts->product_price     = $request->productpriceo;
                 $objproducts->product_tags      = $request->oproducttags;
                 $objproducts->stock_status      = $request->ostockstatus;
                 $objproducts->product_quantity  = $request->ostockcount;
                 $objproducts->summary           = $request->opsummary;
                  if( $request->enabledisable =='')
                 {
                    $objproducts->product_status       = 'disabled'; 
                 }
                 else{
                    $objproducts->product_status       = 'enabled'; 
                 }
                 $objproducts->description       = $request->opdescr;
                 $objproducts->save(); 

                 Productcategory::where('productId', '=', $id)->delete();

                 $category = Category::where('Id','=',$request->pcategoryId)->first();

                 if ($category == 'women') {
                     $objproductcat                    = new Productcategory();  
                     $objproductcat->productId         = $id;
                     $objproductcat->categoryId        = $request->categoryId;
                     $objproductcat->subcategoryId     = $request->subcategoryId;
                     $objproductcat->save(); 
                 } else {
                     $objproductcat                    = new Productcategory();  
                     $objproductcat->productId         = $id;
                     $objproductcat->categoryId        = $request->pcategoryId;
                     $objproductcat->subcategoryId     = $request->categoryId;
                     $objproductcat->save(); 
                 }

                 

                 Productcolor::where('productId', '=',$id)->delete();
                 for($i=0;$i<count($request['ncolor']);$i++){
                    $objprodcolor = new Productcolor();
                    $objprodcolor->productId = $id;
                    $objprodcolor->colorId = $request['ncolor'][$i];
                    $objprodcolor->save();
                }
                Productsize::where('productId', '=',$id)->delete();
                for($i=0;$i<count($request['nsizes']);$i++){
                    $objprodcolor = new Productsize();
                    $objprodcolor->productId = $id;
                    $objprodcolor->sizeId = $request['nsizes'][$i];
                    $objprodcolor->save();
                }

                if (!empty($productimage)) {
                    $array =  $productimage;
                    $i = 0;
                     foreach ($array as $pimage) {

                         $objproductimage                 = new Productimages();  
                         $objproductimage->productId      = $id;
                         $objproductimage->image_url      = $pimage;
                         $objproductimage->save();
                         $i++; 
                     }
                }
                 

                 
           Session::flash('message', 'Products Successfully Updated  !');
           return redirect('manage/normalproducts');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id    = Crypt::decrypt($id);
        $image = Productimages::where('productId', '=', $id)->get();
        if (!empty($image)) {

           foreach ($image as $pimg) {

               $img = $pimg->image;

               $imgfullpath ='/products/'.$img; 

               Storage::disk('products')->delete($imgfullpath);
           }
           Productimages::where('productId', '=', $id)->delete();
        }

        Productcategory::where('productId', '=', $id)->delete();
        Productcolor::where('productId', '=', $id)->delete();
        Productsize::where('productId', '=', $id)->delete();
        Products::where('Id', '=', $id)->delete();

        Session::flash('message', 'Product Deleted  Successfully!');

         return redirect('manage/normalproducts');
    }
    
    public function deletereviews($id) {
         $id    = Crypt::decrypt($id);
         
         Reviews::where('id', '=', $id)->delete();
         
         Session::flash('message', 'Reviews Deleted  Successfully!');
         return redirect('manage/normalproducts');
    }
    
    
    
}
