<?php



namespace App\Http\Controllers\admin;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\Validator;







use App\model\Category;

use Session;





class CategoryController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

       $data['categories'] = Category::all();

       return view('admin/categories/browse',$data);

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $data['categories'] = Category::all();

        $data['edit'] = 0;

        return view('admin/categories/add-edit',$data);

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

                'category'           => 'required',

            ]);



        if ($validator -> fails()) {

            return back()->withErrors($validator)->withInput();

        } else {

            $objcategory                 = new Category();  
            $objcategory->parentId       = $request->parentId;
            $objcategory->category       = $request->category;
            $objcategory->category_type  = $request->category_type;
            $objcategory->menu_order     = $request->menu_order;
            $objcategory->save(); 



            Session::flash('message', 'Category  Created Successfully!');

           return redirect('manage/categories/');

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

        $data['cate'] = Category::where('Id','=',$id)->first();

        $data['categories'] = Category::all();

        $data['edit'] = 1;

        return view('admin/categories/add-edit',$data);

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

                'category'           => 'required',

            ]);



        if ($validator -> fails()) {

            return back()->withErrors($validator)->withInput();

        } else {

            $id     = Crypt::decrypt($id);

            $objcategory                 = Category::find($id);  
            $objcategory->parentId       = $request->parentId;
            $objcategory->category       = $request->category;
            $objcategory->category_type  = $request->category_type;
            $objcategory->menu_order     = $request->menu_order;
            $objcategory->save(); 



            Session::flash('message', 'Category Successfully Updated!');

           return redirect('manage/categories/');

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

        $id     = Crypt::decrypt($id);

        Category::where('Id', '=', $id)->delete();

        Session::flash('message', 'Category Deleted  Successfully!');



        return redirect('manage/categories/');

    }

}

