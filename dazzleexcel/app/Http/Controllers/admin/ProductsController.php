<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Flash; 
use App\model\Currency;
use App\model\Category;
use App\model\Colours;
use App\model\Size;
use App\model\Products;
use App\model\Productcategory;
use App\model\Productimages;
use App\model\Productsize;
use App\model\Productcolor;
use Session;
use PHPExcel_Worksheet_Drawing;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data['products'] = Products::where('product_type','=','luxury')->join('productscategories', 'products.Id', '=', 'productscategories.productId')
         ->join('category', 'productscategories.categoryId', '=', 'category.Id')
           
         ->select('products.*','category.category')
         ->get();
       return view('admin/products/browse',$data);
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
        return view('admin/products/addedit-luxury',$data);
    }


    public function upload_productimages(Request $request)
    {
        $latestid = DB::table('products')->latest('product_name')->first();
        if ($request->file) {
            $data=array();
           foreach ($request->file as $file) {
               $filenameWithExt =$file->getClientOriginalName();
               //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $file->getClientOriginalExtension();
                // Filename to store

                //$fileNameToStore = $filename.'_'.time().'.'.$extension;
                $fileNameToStore = $filename.'.'.$extension;
                $path = $file->storeAs('public/products',$fileNameToStore);
               // $data[] = 'products/'.$fileNameToStore;
                $data[] =  $fileNameToStore;
               $datas= json_encode($data);
           }
           
             return response()->json(['success'=>$data]);
           }
    }


    public function removesummaryimages($id)
    {
        $summary = Products::select('summary')->where('Id','=',$id)->first();
        $summarydecode = json_decode($summary->summary, true); 

        $summarytext = $summarydecode['summary'];
        $summaryimage = $summarydecode['image'];

        $summarynew  = array(
                    'summary' =>$summarytext,
                    'image' =>'' 
                );
         $summarydata = json_encode($summarynew);

         $fullpath ='/products'.$summaryimage; 

         Storage::disk('products')->delete($summaryimage);


         $objproducts               = Products::find($id); 
         $objproducts->summary      = $summarydata;
         $objproducts->save(); 


         $crypt = Crypt::encrypt($id);
         return redirect('manage/products/'.$crypt.'/edit');
    }


    public function removedescriptionimages($id)
    {
        $desc = Products::select('description')->where('Id','=',$id)->first();
        $descriptiondecode = json_decode($desc->description, true); 

        $descrtitle = $descriptiondecode['title'];
        $descrcont = $descriptiondecode['description'];
        $descrimage = $descriptiondecode['image'];

        $descrnew  = array(
                    'title' =>$descrtitle,
                    'description' =>$descrcont,
                    'image' =>'' 
                );
         $descriptiondata = json_encode($descrnew);

         $fullpath ='/products'.$descrimage; 

         Storage::disk('products')->delete($descrimage);

         $objproducts               = Products::find($id); 
         $objproducts->description  = $descriptiondata;
         $objproducts->save(); 

          $crypt = Crypt::encrypt($id);
         return redirect('manage/products/'.$crypt.'/edit');
    }

    public function removeproductimages($id)
    {
        $productimages = Productimages::where('id','=',$id)->first();
        $productid = $productimages->productId;

        $fullpath ='/products/'.$productimages->image_url; 

        $crypt = Crypt::encrypt($productid);

        Storage::disk('products')->delete($fullpath);

        Productimages::find($id)->delete(); 

       return redirect('manage/products/'.$crypt.'/edit');
    }

    public function removedesignerimages($id)
    {
        $designer = Products::select('productdesigner')->where('Id','=',$id)->first();
        $designerdecode = json_decode($designer->productdesigner, true); 


        $descrtitle = $designerdecode['name'];
        $descrcont = $designerdecode['website'];
        $descrimage = $designerdecode['image'];

        $designernew  = array(
                    'name' =>$descrtitle,
                    'website' =>$descrcont,
                    'image' =>'' 
                );
         $designerdata = json_encode($designernew);

         $fullpath ='/products'.$descrimage; 

         Storage::disk('products')->delete($descrimage);

         $objproducts                   = Products::find($id); 
         $objproducts->productdesigner  = $designerdata;
         $objproducts->save(); 

          $crypt = Crypt::encrypt($id);
         return redirect('manage/products/'.$crypt.'/edit');
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
 Excel::import(new ProductsImport,request()->file('prodcuts_file'));
 Session::flash('message', 'Products Successfully Updated  !');
           return redirect('manage/products');
//            $filenaeeee = $request->file('prodcuts_file');

//           $file = $request->file('prodcuts_file');
// $csvData = file_get_contents($file);

//         $rows = array_map("str_getcsv", explode("\n", $csvData));
//         $header = array_shift($rows);

//       foreach ($rows as $row) {

//        // return response()->json($row[2]);
//             if (isset($row[0])) {
//                 if ($row[0] != "") {
//                     $row = array_combine($header, $row);
//                     $type = $row['typeId']; 
//             if ($type == 'luxury') {
//                 $summary = [];
//                 $description = [];
//                 $designer = [];

//                 $summary  = array(
//                     'summary' => $row['productsummary'] ,
//                      'image' =>'',
//                 );

//                 $designer  = array(
//                     'name' => $row['designertitle'] ,
//                     'website' => $row['designerwebsite'],
//                      'image' =>'' , 
//                 );

//                  $description  = array(
//                     'title' =>$row['productdescriptiontitle']  ,
//                     'description' =>$row['pdescription'] ,
//                      'image' =>'' ,
//                 );

//                  $summarydata = json_encode($summary);
//                  $descrdata = json_encode($description);
//                  $designerdata = json_encode($designer);

//                  // $productimage = $row['lproductresult'];

//                  $pricestring = $row['productprice'];
//                  $str_split = explode('$', $pricestring);
                

//            return     $leadData[] = array(
//                     "product_type" =>  $row['typeId'],
//                         "product_name" =>$row['productname'],
//                         "product_price" => $str_split[1],
//                         "product_tags" =>$row['producttags'],
//                         "stock_status" =>  $row['stockstatus'],
//                         "product_quantity" => $row['stockcount'],
//                         "summary" =>  $summarydata,
//                         "description" =>$descrdata,
//                         "productdesigner" =>$designerdata,
//                     );

//   $lead = Products::create($leadData);
//                  // $objproducts                    = new Products();  
//                  // $objproducts->product_type      = $row['typeId']; 
//                  // $objproducts->product_name      = $row['productname']; 
//                  // $objproducts->product_price     = $str_split[1];
//                  // $objproducts->product_tags      =  $row['producttags'];
//                  // $objproducts->stock_status      =  $row['stockstatus'];
//                  // $objproducts->product_quantity  =  $row['stockcount'];
//                  // $objproducts->summary           = $summarydata;
//                  // $objproducts->description       = $descrdata;
//                  // $objproducts->productdesigner   = $designerdata;
//                  // $objproducts->save(); 




//                  $lastId = $objproducts->Id;

//                  $objproductcat                    = new Productcategory();  
//                  $objproductcat->productId         = $lastId;
//                  $objproductcat->categoryId        = $row['categoryId'];
//                  $objproductcat->subcategoryId     = $row['subcategoryId'];
//                  $objproductcat->save(); 

//                 return  $row['color'];

//                 $color= Colours::where('color_name', $row['color'])->pluck('id');
//                     $objprodcolor = new Productcolor();
//                     $objprodcolor->productId = $lastId;
//                     $objprodcolor->colorId =$row['color'];
//                     $objprodcolor->save();
                

               
//                     $objprodcolor = new Productsize();
//                     $objprodcolor->productId = $lastId;
//                     $objprodcolor->sizeId = $row['sizes'];
//                     $objprodcolor->save();
               

                 
// //          $drawing =  new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
// //             // $objDrawing->setPath(public_path('img/headerKop.png')); //your image path
// //             // $objDrawing->setCoordinates('A2');
// //             // $objDrawing->setWorksheet($sheet);

           
// //   $drawing->setName($row['productname']);
       
// //        $drawing->setPath('storage/app/public/products/');
// //         $drawing->setHeight(90);
// //       $drawing->setCoordinates('u2');
            
// // // $drawing->setCoordinates($row['lproductresult']);

// // return response()->json($drawing);


//                      $objproductimage                 = new Productimages();  
//                      $objproductimage->productId      = $lastId;
//                      // $objproductimage->image_url      =  $drawing->setCoordinates($row['lproductresult']);
//                      // $objproductimage->title         = $row['producttitle'];
//                      // $objproductimage->description  = $row['productdescription'];
//                      $objproductimage->save();
                 
                

//             }
             
//                 }
//             }
//         }

    }
      


  

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'typeId'           => 'required',
            'productname'      => 'required',
            'productprice'     => 'required',
            'producttags'      => 'required',
            
            'stockstatus'      => 'required',
            'stockcount'       => 'required',
            'descrtitle'       => 'required',
            'pdescr'           => 'required',
            'dtitle'           => 'required',
            'dwebsite'         => 'required',
            'psummary'         => 'required',
        ]);
// return $request->all();
        if ($validator -> fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
               if($request->lcategoryId=='0'){
 Session::flash('message', 'please select catgeory!');
  return back();
            }
                  if($request->lsubcategoryId=='0'){
                  
 Session::flash('message', 'please select subcatgeory!');
  return back();
            }
            $type = $request->typeId; 
            if ($type == 'luxury') {
                $summary = [];
                $description = [];
                $designer = [];

                $summary  = array(
                    'summary' =>$request->psummary ,
                    'image' =>$request->summaryresult 
                );

                $designer  = array(
                    'name' =>$request->dtitle ,
                    'website' =>$request->dwebsite,
                    'image' => $request->designerresult
                );

                 $description  = array(
                    'title' =>$request->descrtitle ,
                    'description' =>$request->pdescr,
                    'image' => $request->descriptionresult
                );

                 $summarydata = json_encode($summary);
                 $descrdata = json_encode($description);
                 $designerdata = json_encode($designer);

                 $productimage = $request->lproductresult;

                 $pricestring = $request->productprice;
                 $str_split = explode('$', $pricestring);


                 $objproducts                    = new Products();  
                 $objproducts->product_type      = $request->typeId;
                 $objproducts->product_name      = $request->productname;
                 $objproducts->product_price     =  $request->productprice;
                 $objproducts->product_tags      = $request->producttags;
                 $objproducts->stock_status      = $request->stockstatus;
                 $objproducts->product_quantity  = $request->stockcount;
                 $objproducts->summary           = $summarydata;
                 $objproducts->description       = $descrdata;
                 $objproducts->productdesigner   = $designerdata;
                
                 $objproducts->save(); 




                 $lastId = $objproducts->Id;

                 $objproductcat                    = new Productcategory();  
                 $objproductcat->productId         = $lastId;
                 $objproductcat->categoryId        = $request->lcategoryId;
                 $objproductcat->subcategoryId     = $request->lsubcategoryId;
                 $objproductcat->save(); 

                 for($i=0;$i<count($request['lcolor']);$i++){
                    $objprodcolor = new Productcolor();
                    $objprodcolor->productId = $lastId;
                    $objprodcolor->colorId = $request['lcolor'][$i];
                    $objprodcolor->save();
                }

                for($i=0;$i<count($request['lsizes']);$i++){
                    $objprodcolor = new Productsize();
                    $objprodcolor->productId = $lastId;
                    $objprodcolor->sizeId = $request['lsizes'][$i];
                    $objprodcolor->save();
                }

                 


                 $array =  explode(',', $productimage);

                 $i = 0;
                 foreach ($array as $pimage) {

                     $objproductimage                 = new Productimages();  
                     $objproductimage->productId      = $lastId;
                     $objproductimage->image_url      = $pimage;
                     $objproductimage->title         = $request->producttitle[$i];
                     $objproductimage->description  = $request->productdescription[$i];
                     $objproductimage->save();
                     $i++; 
                }

            } elseif ($type == 'normal') {
                 $productimage = $request->oproductresult;

                 $objproducts                    = new Products();  
                 $objproducts->product_type      = $request->typeId;
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
                 $objproducts->description       = $request->opdescr;
                 $objproducts->save(); 


                 $lastId = $objproducts->Id;

                 $objproductcat                    = new Productcategory();  
                 $objproductcat->productId         = $lastId;
                 $objproductcat->categoryId        = $request->ocategoryId;
                 $objproductcat->subcategoryId     = $request->osubcategoryId;
                 $objproductcat->save(); 

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


                  $array =  explode(',', $productimage);

                 $i = 0;
                 foreach ($array as $pimage) {

                     $objproductimage                 = new Productimages();  
                     $objproductimage->productId      = $lastId;
                     $objproductimage->image_url      = $pimage;
                     $objproductimage->save();
                     $i++; 
                 }
            }
           Session::flash('message', 'Products Created Successfully!');
           return redirect('manage/products');
        }
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
        $id     = Crypt::decrypt($id);
        
        $base_curr = env('BASE_CURR');
        $data['category'] = Category::where('parentId','=',0)->get();
        $data['subcategory'] = Category::where('parentId','!=',0)->get();
        $data['currency'] = Currency::where('code','=',$base_curr)->first();
        $data['colours'] = Colours::orderBy('id', 'DESC')->get();
        $data['sizes'] = Size::orderBy('id', 'DESC')->get();
        $data['products'] = Products::where('Id','=',$id)
                   ->where('product_type','=','luxury')
                   ->first();
        $data['productcolor'] = Productcolor::where('productId','=',$id)->get();
         $colours = Colours::orderBy('id', 'DESC')->get();
        $pcolors = Productcolor::where('productId','=',$id)->get();
        foreach($pcolors as $color){
    //   return  $pcolourss  =Colours::where('id', '=', $color->colorId)->get();
    //       return $pcolourss->id;
        }

        $data['productcolor'] =  $pcolors;
        $data['edit'] = 1;

        return view('admin/products/addedit-luxury',$data);
       
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
    //   return $request->lcategoryId;

        $validator = Validator::make($request->all(), [
            'typeId'           => 'required',
            'productname'      => 'required',
            'productprice'     => 'required',
            'producttags'      => 'required',
           
         
            'descrtitle'       => 'required',
            'pdescr'           => 'required',
            'dtitle'           => 'required',
            'dwebsite'         => 'required',
            'psummary'         => 'required',
        ]);
 
        if ($validator -> fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            if($request->lcolor==''){
    Session::flash('message', 'please select color!');
           return back();
            }

             if($request->lsizes==''){
 Session::flash('message', 'please select size!');
  return back();
            }

                if($request->lcategoryId=='0'){
 Session::flash('message', 'please select catgeory!');
  return back();
            }
                  if($request->lsubcategoryId=='0'){
                  
 Session::flash('message', 'please select subcatgeory!');
  return back();
            }
// return $request->lsubcategoryId;
 
            $id        = Crypt::decrypt($id); 
            $type = $request->typeId; 
            if ($type == 'luxury') {
                $summary = [];
                $description = [];
                $designer = [];

               $summaryimage = $request->summaryresult;
               $designerimage = $request->designerresult;
               $descriptionimage = $request->descriptionresult;

               if (empty($summaryimage)) {
                   $products = Products::select('summary')->find($id);
                   $summary = $products->summary;

                   $summarydecode = json_decode($summary, true); 


                 $summaryimage = $summarydecode['image']; 
               } else {
                 $summaryimage = $request->summaryresult; 
               }


               if (empty($designerimage)) {
                   $products = Products::select('productdesigner')->find($id);
                   $designer = $products->productdesigner;
                   $designerdecode = json_decode($designer, true);

                   $designimage = $designerdecode['image']; 
               } else{
                 $designimage = $request->designerresult;
               }

               if (empty($descriptionimage)) {
                   $products = Products::select('description')->find($id);
                   $descr = $products->description;
                   $descrdecode = json_decode($descr, true);

                   $descrmage = $descrdecode['image'];
               } else {
                $descrmage = $request->descriptionresult;
               }

                $summary  = array(
                    'summary' =>$request->psummary ,
                    'image' =>$summaryimage 
                );


                $designer  = array(
                    'name' =>$request->dtitle ,
                    'website' =>$request->dwebsite,
                    'image' => $designimage
                );

                 $description  = array(
                    'title' =>$request->descrtitle ,
                    'description' =>$request->pdescr,
                    'image' => $descrmage
                );

                 $summarydata = json_encode($summary);
                 $descrdata = json_encode($description);
                 $designerdata = json_encode($designer);

                 $productimage = $request->lproductresult;


                 $objproducts                    = Products::find($id);
                 $objproducts->product_type      = $request->typeId;
                 $objproducts->product_name      = $request->productname;
                 $objproducts->product_price     = $request->productprice;
                 $objproducts->product_tags      = $request->producttags;
                 $objproducts->stock_status      = $request->stockstatus;
                 $objproducts->product_quantity  = $request->stockcount;
                 $objproducts->summary           = $summarydata;
                 $objproducts->description       = $descrdata;
                 $objproducts->productdesigner   = $designerdata;
                   if( $request->enabledisable =='')
                 {
                    $objproducts->product_status       = 'disabled'; 
                 }
                 else{
                    $objproducts->product_status       = 'enabled'; 
                 }
                 $objproducts->save(); 

                 Productcategory::where('productId', '=', $id)->delete();

                 $objproductcat                    = new Productcategory();  
                 $objproductcat->productId         = $id;
                 $objproductcat->categoryId        = $request->lcategoryId;
                 $objproductcat->subcategoryId     = $request->lsubcategoryId;
                 $objproductcat->save(); 

                 Productcolor::where('productId', '=',$id)->delete();
                 for($i=0;$i<count($request['lcolor']);$i++){
                    $objprodcolor = new Productcolor();
                    $objprodcolor->productId = $id;
                    $objprodcolor->colorId = $request['lcolor'][$i];
                    $objprodcolor->save();
                }
                Productsize::where('productId', '=',$id)->delete();
                for($i=0;$i<count($request['lsizes']);$i++){
                    $objprodcolor = new Productsize();
                    $objprodcolor->productId = $id;
                    $objprodcolor->sizeId = $request['lsizes'][$i];
                    $objprodcolor->save();
                }

                 $array =  explode(',', $productimage);

                 $i = 0;
                 foreach ($array as $pimage) {

                     $objproductimage                 = new Productimages();  
                     $objproductimage->productId      = $id;
                     $objproductimage->image_url      = $pimage;
                     $objproductimage->title         = $request->producttitle[$i];
                     $objproductimage->description  = $request->productdescription[$i];
                     $objproductimage->save();
                     $i++; 
                }

            } elseif ($type == 'normal') {
                 $productimage = $request->oproductresult;

                 $objproducts                    = new Products();  
                 $objproducts->product_type      = $request->typeId;
                 $objproducts->product_name      = $request->productnameo;
                 $objproducts->product_price     = $request->productpriceo;
                 $objproducts->product_tags      = $request->oproducttags;
                 $objproducts->stock_status      = $request->ostockstatus;
                 $objproducts->product_quantity  = $request->ostockcount;
                 $objproducts->summary           = $request->opsummary;
                 $objproducts->description       = $request->opdescr;
                 $objproducts->save(); 


                 $lastId = $objproducts->Id;

                 $objproductcat                    = new Productcategory();  
                 $objproductcat->productId         = $lastId;
                 $objproductcat->categoryId        = $request->ocategoryId;
                 $objproductcat->subcategoryId     = $request->osubcategoryId;
                 $objproductcat->save(); 

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


                  $array =  explode(',', $productimage);

                 $i = 0;
                 foreach ($array as $pimage) {

                     $objproductimage                 = new Productimages();  
                     $objproductimage->productId      = $lastId;
                     $objproductimage->image_url      = $pimage;
                     $objproductimage->save();
                     $i++; 
                 }
            }
           Session::flash('message', 'Products Successfully Updated  !');
           return redirect('manage/products');
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

         return redirect('manage/products');
    }
}
