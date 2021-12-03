<?php



namespace App\Http\Controllers\admin;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;



use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;







use DB;



use App\model\Invoice;

use App\model\Orders;

use App\User;



use Session;



class DashboardController extends Controller

{

    function __construct()

    {

        // $this->middleware('auth');

        // $this->middleware('guest:admin')->except('logout');

    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $data['revenue'] = Invoice::select(DB::raw("SUM(invoice.price) as revenue"))
        				   ->first();
                           //->orderBy("created_at")

                           //->groupBy(DB::raw("year(created_at)"))

                            



        $data['shipping'] = Invoice::select(DB::raw("SUM(shipping_amt) as shipping"))
                            ->first();
                          // ->orderBy("created_at")

                           //->groupBy(DB::raw("year(created_at)"))

                            

        $data['orders'] = Orders::count();

       return view('admin/dashboard',$data);

    }





    public function logout(Request $request)

    {

         //Auth::logout();

         Auth::guard('admin')->logout();

        return redirect('/manage');

    }

    

    public function changepassword()

    {

       $data['edit'] = 1;

        return view('admin/change-password',$data);

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

        try {

             $validator = Validator::make($request->all(), [

                'oldpass'     => 'required',

                'npass'      => 'required',

                'rpass'      => 'required',

            ]);

            if ($validator -> fails()) {

               return back()->withErrors($validator)->withInput();

            } else {

                $id     = Crypt::decrypt($id);



                $obj_user = User::find($id);

                $obj_user->password = Hash::make($request->npass);

                $obj_user->save();



                Session::flash('message', 'Password Successfully Updated  !');

                return redirect('manage/changepassword/');

            }

        } catch (Exception $e) {

            return back()->withError($e->getMessage())->withInput();

            Session::flash('error',$e->getMessage());

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

        //

    }

}

