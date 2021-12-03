<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;



use App\model\Banner;
use Session;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['banners'] = Banner::all();
        return view('admin/banner/browse',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['edit'] = 0;
        return view('admin/banner/add-edit',$data);
    }

    public function upload_bannerimages(Request $request)
    {
        //$latestid = DB::table('products')->latest('product_name')->first();
        if ($request->file) {
           foreach ($request->file as $file) {
               $filenameWithExt =$file->getClientOriginalName();
               //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $file->getClientOriginalExtension();
                // Filename to store

                //$fileNameToStore = $filename.'_'.time().'.'.$extension;
                $fileNameToStore = $filename.'.'.$extension;
                $path = $file->storeAs('public/banner',$fileNameToStore);
               // $data[] = 'products/'.$fileNameToStore;
                $data[] =  $fileNameToStore;
           }
           return response()->json(['success'=>$data]);
           }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bannerimage = $request->bannerresult; 


        $objbanner                 = new Banner();  
        $objbanner->title       = $request->title;
        $objbanner->description = $request->descr;
        $objbanner->image       = $bannerimage;
        $objbanner->position    = $request->position;
        $objbanner->url         = $request->url;
        $objbanner->save(); 

        Session::flash('message', 'Banner  Created Successfully!');
        return redirect('manage/banner/');

  

        
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
        $data['banner'] = Banner::where('id','=',$id)->first(); 
        $data['edit'] = 1;
        return view('admin/banner/add-edit',$data);
    }

    public function removebannerimages($id)
    {
        $banner = Banner::select('image')->where('id','=',$id)->first();
        

        $image = $banner->image;
         $fullpath ='/banner'.$image; 

         Storage::disk('banner')->delete($fullpath);


         $objbanner               = Banner::find($id); 
         $objbanner->image        = '';
         $objbanner->save(); 


         $crypt = Crypt::encrypt($id);
         return redirect('manage/banner/'.$crypt.'/edit');
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
        $bannerimage = $request->bannerresult; 


        $objbanner              = Banner::find($id);  
        $objbanner->title       = $request->title;
        $objbanner->description = $request->descr;
        $objbanner->image       = $bannerimage;
        $objbanner->position    = $request->position;
        $objbanner->url         = $request->url;
        $objbanner->save(); 

        Session::flash('message', 'Banner Successfully Updated  !');
        return redirect('manage/banner');
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
         $bimage = Banner::where('id', '=', $id)->first();
         $img = $bimage->image;
         $imgfullpath ='/banner/'.$img; 
         Storage::disk('banner')->delete($imgfullpath);
         Banner::where('id', '=', $id)->delete();
         Session::flash('message', 'Banner Deleted  Successfully!');
         return redirect('manage/banner');
    }
}
