<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

use App\model\Pages;

use Session;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pages'] = Pages::all();
         return view('admin/pages/browse',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['edit'] = 0;
        return view('admin/pages/add-edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'           => 'required',
            'content'      => 'required',
        ]);
        if ($validator -> fails()) {
           return back()->withErrors($validator)->withInput();
        } else {
            $title = $request->title;
            $slug = $this->makeslug($title);

            $objproductcat              = new Pages();  
            $objproductcat->title       = $title;
            $objproductcat->slug        = $slug;
            $objproductcat->content     = $request->content;
            $objproductcat->save(); 

            Session::flash('message', 'Pages Created Successfully!');
           return redirect('manage/pages');
        }
    }


    function makeslug($string){
         $slug = trim($string); // trim the string
         $slug= preg_replace('/[^a-zA-Z0-9 -]/','',$slug ); // only take alphanumerical characters, but keep the spaces and dashes too...
         $slug= str_replace(' ','-', $slug); // replace spaces by dashes
         $slug= strtolower($slug);  // make it lowercase
         return $slug;
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
        $data['pages'] = Pages::where('id','=',$id)->first(); 
         $data['edit'] = 1;
         return view('admin/pages/add-edit',$data);
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
         $validator = Validator::make($request->all(), [
            'title'           => 'required',
            'content'      => 'required',
        ]);
        if ($validator -> fails()) {
           return back()->withErrors($validator)->withInput();
        } else {
            $id        = Crypt::decrypt($id); 
            $title = $request->title;

            $objproductcat              = Pages::find($id);  
            $objproductcat->title       = $title;
            $objproductcat->content     = $request->content;
            $objproductcat->save(); 

            Session::flash('message', 'Pages Successfully Updated  !');
           return redirect('manage/pages');
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
        Pages::where('id', '=', $id)->delete();
        Session::flash('message', 'Pages Deleted  Successfully!');
        return redirect('manage/pages');
    }
}
