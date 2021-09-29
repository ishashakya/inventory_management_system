<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\Sale;
use App\Models\Admin\SalesDetails;
use App\Models\Admin\Transaction;
use Illuminate\Http\Request;

class SalesDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        // $sales= Transaction::with('saledetails')->find($id);
        $sales=Transaction::where('transaction_type','Outgoing')->with('saledetails')->find($id);
        // dd($sales);
        $products=Product::get();
        return view('admin.saleDetails.sale_detail',compact('sales','products'));
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
    public function update(Request $request, SalesDetails $saleDetails)
    {
        // dd($saleDetails);
        $oldData=collect($saleDetails);
        $validate = $request->validate([
            'product_id' => 'required',
            'cp'=>'required',
            'quantity'=>'required',
            'price'=>'required',
        ]);
        $saleDetails->product_id = $request->product_id;
        $saleDetails->cp = $request->cp;
        $saleDetails->quantity = $request->quantity;
        $saleDetails->price = $request->price;
        $saleDetails->update();
        // dd($salesDetails);
        $inventoryController = new InventoryController();
        $inventoryController->updateQuantity($oldData, $request,'Outgoing');
        return redirect()->back()->with('success', 'Details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $saledetails = SalesDetails::where('id',$id)->first();
        $saledetails->delete();
        return redirect()->back()->with('success','Detail deleted successfully');
    }
}
