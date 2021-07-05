<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('admin.includes.dashboard');

    }
    public function logout()
    {
        Auth::logout();
        Session ::flush();
        return redirect()->route('admin.login.view');
    }
    public function profile()
    {
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }
    public function editProfile(Request $request){
        $datas =$request->all();
        // dd($datas);
        $validated = $request->validate([
            'name'=>'required|min:3|max:50',
            'email'=>'required|email|unique:users,email,'.$request->id, //same email can not be used by different persons
            'username'=>'nullable|min:5|max:50|unique:users,username,'.$request->id,
            'bio'=>'nullable|max:300',
        ]);
        $user = User::find($request->id);
        if($request->image){
            $request->validate([
                'image'=>'required|mimes: jpg,jpeg,png,svg,gif|max:1024',
            ]);
            $extension = $request->image->getClientOriginalExtension();
            $image_name = Str::slug($request->name).time().'.'.$extension;
            // dd($image_name);
            $uploaded= $request->image->move(public_path('/uploads/admin_profile'),$image_name);
            if($user->image && file_exists("uploads/admin_profile/".$user->image)){
                unlink("uploads/admin_profile/".$user->image);
            }
            $user->image=$image_name;
        }

        $user->name=$datas['name'];
        $user->email=$datas['email'];
        $user->username=$datas['username'];
        $user->bio=$datas['bio'];
        $user->update();
        return redirect()->back()->with('success','Profile updated successfully.');
    }
    public function changePassword(Request $request){
        // dd($request->all());
        $check = Hash::check($request->current_password, Auth::user()->password);
        if ($check) {
            $request->validate([
                'password'=>'required|min:6|max:100',
                'confirm-password'=>'required|same:password',
            ]);
            $user=User::find(Auth::user()->id);
            $user->password=Hash::make($request->password);
            $user->update();
            return redirect()->back()->with('success',"Password Changed");
        } else {
            return redirect()->back()->with('error','Old Password do not match');
        }
    }
    public function index()
    {
        //
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
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
