<?php

namespace App\Http\Controllers;
use Auth;
use Session;
use App\Manager;
use App\User;
use App\Shop;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $profile = Auth::user();
        return view('admin.profiles.profile')
                ->with('shops', Shop::all())
                ->with('profile', $profile);
    }
    public function profileUpdate(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'userName' => 'required',
            'email' => 'required|email',
            // 'password' => 'sometimes|required',
            'user_image' => 'image'
        ]);
        $profile = Auth::user();
        $manager = Manager::where('user_id', $profile->id)->first();
        if($request->hasFile('user_image')){
            $user_image = $request->user_image;
            $user_image_new_name = time().$user_image->getClientOriginalName();
            $user_image->move('vali/images/users/', $user_image_new_name);
            $profile->user_image = 'vali/images/users/'.$user_image_new_name;
        }
        if($request->password == NULL){
            $profile->password = Auth::user()->password;
            $profile->save();
        }else{

            $profile->password = bcrypt($request->password);
            $profile->save();
        }

        if($profile->admin){
            $profile->name = $request->name;
            $profile->userName = $request->userName;
            //$profile->shop_id = NULL;
            $profile->email = $request->email;
            $profile->save();
        }

        if($manager){
            $manager->name = $request->name;
            $manager->shop_id = $request->shop_id;
            $manager->save();
            $profile->name = $request->name;
            $profile->userName = $request->userName;
            $profile->shop_id =  $request->shop_id;
            $profile->email = $request->email;
            $profile->save();
        }

        Session::flash('success', 'Profile Updated Successfully');
        return redirect()->back();
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
        //
    }
}
