<?php

namespace App\Http\Controllers\Auth;

use Session;
Use Auth;
Use App\Manager;
Use App\User;
Use App\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware('admin');
    // }

    public function index()
    {
        return view('admin.managers.managers')->with('managers', Manager::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.managers.create')->with('shops', Shop::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'userName' => 'required|unique:users',
            'shop_id' => 'required',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'shop_id' => 'required'
        ]);


        $user = User::create([
            'name' => $request->name,
            'userName' => $request->userName,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_image' => 'vali/images/users/profile.png',
            'shop_id' => $request->shop_id
        ]);

        $manager = Manager::create([
            'name' => $user->name,
            'user_id' => $user->id,
            'shop_id' => $request->shop_id
        ]);


        //dd($user);

        Session::flash('success', 'New Manager Added Successfully');
        return redirect()->route('managers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manager = Manager::find($id);

        return view('admin.managers.show')->with('manager', $manager);
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
        $this->validate($request, [
            'name' => 'required',
            'userName' => 'required',
            'shop_id' => 'required',
            'email' => 'required|email',
            'user_image' => 'image'
        ]);
        $manager = Manager::find($id);
        $user = User::find(Auth::id());
        if($request->hasFile('user_image')){
            $user_image = $request->user_image;
            $user_image_new_name = time().$user_image->getClientOriginalName();
            $user_image->move('vali/images/users/', $user_image_new_name);
            $user->user_image = 'vali/images/users/'.$user_image_new_name;
        }
        if($request->has('password')){
            $user->password = bcrypt($request->password);
            $user->save();
        }

        if(Auth::user()->admin){
            $user->name = $request->name;
            $user->userName = $request->userName;
            $user->shop_id = NULL;
            $user->email = $request->email;
        }else{
            $user->name = $request->name;
            $user->userName = $request->userName;
            $user->shop_id =  $request->shop_id;
            $user->email = $request->email;
        }

        $manager->name = $request->name;
        $manager->shop_id = $request->shop_id;

        $manager->save();

        Session::flash('success', 'Manager Updated Successfully');
        return redirect()->route('managers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // public function destroy($id)
    // {
    //     $user = Manager::find($id);
    //     if(Auth::id() == $user->id){
    //         Session::flash('error', 'You cant delete yourself');
    //         return redirect()->back();
    //     }else{
    //         $user->delete();
    //         Session::flash('success', 'User Deleted Successfully');
    //         return redirect()->back();
    //     }
    // }

    // public function makeAdmin($id)
    // {
    //     $user = Manager::find($id);
    //     if(Auth::id() == $user->id){
    //         Session::flash('error', 'You cant Change Your Status');
    //         return redirect()->back();
    //     }else{
    //         $user->admin = 1;
    //         $user->save();
    //         Session::flash('success', 'User Status Changed Successfully');
    //         return redirect()->back();
    //     }

        
    // }
    // public function removeAdmin($id)
    // {
    //     $user = Manager::find($id);
    //     if(Auth::id() == $user->id){
    //         Session::flash('error', 'You cant Change Your Status');
    //         return redirect()->back();
    //     }else{
    //         $user->admin = 0;
    //         $user->save();
    //         Session::flash('success', 'User Status Changed Successfully');
    //         return redirect()->back();
    //     }
    // }
}
