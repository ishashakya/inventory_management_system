<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\SalesDetails;
use App\Models\Admin\Transaction;
use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public function saleReport(){
        $sales_data = DB::select("SELECT SUM(s.quantity),products.title
        FROM sales_details AS s, products
        WHERE s.product_id = products.id
        GROUP BY products.title ORDER BY SUM(s.quantity) DESC");
        if(sizeof($sales_data)!=0){
            return $sales_data[0]->title;
        }
    }
    public function categoryReport(){
        $category_data = DB::select("SELECT c.id, c.name, SUM(sd.quantity) as sum
        FROM `sales_details` sd, products p, categories c
        WHERE sd.product_id = p.id AND p.category_id = c.id
        GROUP BY c.id, c.name ORDER BY SUM(sd.quantity) DESC");
        if(sizeof($category_data)!=0){
            return $category_data[0];
        }
        $data = (object)[
            "name"=>"",
            "sum"=>"",
        ];

        return $data;
    }
    public function dashboard()
    {
        $sales_data = $this->saleReport();
        $category_data = $this->categoryReport();
        // $data = DB::select("SELECT SUM(price-cp) as profit FROM `sales_details` WHERE created_at>='2021-07-12' AND date(created_at)<='2021-07-14'");
        // dd($data[0]->profit);
        return view('admin.includes.dashboard', compact('sales_data','category_data'));
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

    public function creditReport($start_date, $end_date){
        // dd($start_date,$end_date);
        $credit_report = DB::select("SELECT SUM(credit) as sum, transaction_type
        FROM `transactions`
        -- WHERE date>='".$start_date."' AND date<='".$end_date."'
        WHERE date>='".$start_date."' AND date<='".$end_date."'
        GROUP by transaction_type");

        return ($credit_report);
    }
    public function profitReport($start_date, $end_date)
    {
        $profit_report = DB::select("SELECT SUM(price-cp) as sum
        FROM `sales_details`
        WHERE created_at>='".$start_date."' AND date(created_at)<='".$end_date."'");
        return ($profit_report);
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
