<?php

namespace App\Imports;

use App\model\Products;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Flash; 
use App\model\Currency;
use App\model\Category;
use App\model\Colours;
use App\model\Size;
use App\model\Productcategory;
use App\model\Productimages;
use App\model\Productsize;
use App\model\Productcolor;
class NormaproductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
  public function model(array $row)
    {       
      $type = $row['typeid']; 
          
             

      if ($type == 'normal') {
             
                

                 // $productimage = $row['lproductresult'];

                 $pricestring = $row['productprice'];
                 $str_split = explode('$', $pricestring);
                    $objproducts                    = new Products();  
                 $objproducts->product_type      = $row['typeid']; 
                 $objproducts->product_name      = $row['productname']; 
                 $objproducts->product_price     = $row['productprice'];
                 $objproducts->product_tags      =  $row['producttags'];
                 $objproducts->stock_status      =  $row['stockstatus'];
                 $objproducts->product_quantity  =  $row['stockcount'];
                 $objproducts->summary           = $row['productsummary'];
                 $objproducts->description       =$row['pdescription'];
                
                 $objproducts->save();


                 $lastId = $objproducts->Id;
                  $data = Category::where('category', $row['categoryid'])->first();
                  $datasub = Category::where('category', $row['subcategoryid'])->first();
                  if($data !=''){
                 $objproductcat                    = new Productcategory();  
                 $objproductcat->productId         = $lastId;
                 $objproductcat->categoryId        = $data->Id;
                 $objproductcat->subcategoryId     =  $datasub->Id;
                 $objproductcat->save(); 
}
                

                $color= Colours::where('color_name', $row['color'])->first();
                if($color!=''){
                    $objprodcolor = new Productcolor();
                    $objprodcolor->productId = $lastId;
                    $objprodcolor->colorId = $color->id;
                    $objprodcolor->save();
                }
                 $size= Size::where('size', $row['sizes'])->first();
               if($size!=''){
                    $objprodcolor = new Productsize();
                    $objprodcolor->productId = $lastId;
                    $objprodcolor->sizeId = $size->id;
                    $objprodcolor->save();
}
                      $objproductimage                 = new Productimages();  
                     $objproductimage->productId      = $lastId;
                 
                     $objproductimage->save();
                     return $objproducts;
      

        
    }
    }

   
}

