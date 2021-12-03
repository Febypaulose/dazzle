<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

use App\model\Notification;

use Session;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data['notification'] = Notification::all(); 
       return view('admin/notification/browse',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['edit'] = 0;
        return view('admin/notification/add-edit',$data);
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
                'notification'           => 'required',
            ]);
         if ($validator -> fails()) {
            return back()->withErrors($validator)->withInput();
         } else {
            $objnotification                    = new Notification();  
            $objnotification->notification_text = $request->notification;
            $objnotification->save();

            Session::flash('message', 'Notification  Created Successfully!');
           return redirect('manage/notification/');
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
         $data['notification'] = Notification::where('id','=',$id)->first(); 
         $data['edit'] = 1;
        return view('admin/notification/add-edit',$data);
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
                'notification'           => 'required',
            ]);
         if ($validator -> fails()) {
            return back()->withErrors($validator)->withInput();
         } else {
            $id     = Crypt::decrypt($id);

            $objnotification                    = Notification::find($id);  
            $objnotification->notification_text = $request->notification;
            $objnotification->save();

             Session::flash('message', 'Notification Successfully Updated!');
           return redirect('manage/notification/');
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
        Notification::where('id', '=', $id)->delete();
        Session::flash('message', 'Notification Deleted  Successfully!');

        return redirect('manage/notification/');
    }
}
