<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\SalesDetails;
use App\Models\Admin\Transaction;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Transaction::where('transaction_type','Outgoing')->get();
        return view('admin.sale.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        // dd($products);
        return view('admin.sale.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $sale= new Transaction();
        $sale->merchant_name= $request->customer_name;
        $sale->date=$request->date;
        $sale->total = $request->total;
        $sale->credit=$request->credit;
        $sale->transaction_type='Outgoing';
        $sale->save();

        foreach($request->item as $key=>$value){
            $sale_detail=new SalesDetails();
            $sale_detail->product_id=$value["product_id"];
            $sale_detail->cp=$value["cp"];
            $sale_detail->quantity=$value["quantity"];
            $sale_detail->price=$value["price"];
            $sale_detail->transaction_id=$sale->id;
            $sale_detail->save();

            $inventoryController = new InventoryController();
            $inventoryController->reduceQuantity($sale_detail);
        }
        return redirect()->route('admin.sale.index')->with('success', 'Transaction created successfully.');

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
        // $sale=Transaction::find($id);
        // return view('admin.sale.edit',compact('sale'));
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
