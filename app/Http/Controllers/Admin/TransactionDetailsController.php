<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\Transaction;
use App\Models\Admin\TransactionsDetails;
use Illuminate\Http\Request;

class TransactionDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id){
        $transactions = Transaction::with('transactiondetails')->find($id);
        $products= Product::get();
        // dd($products[0]->id);
        return view('admin.transactionDetails.view_detail', compact('transactions','products'));
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
    public function edit(TransactionsDetails $transactionsdetails)
    {
        $products = Product::get();
        // dd($products);
        return view('admin.transactionDetails.edit',compact('transactionsdetails','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Reque   st  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionsDetails $transactionDetails)
    {
        $oldData=collect($transactionDetails);
        $validate = $request->validate([
            'product_id' => 'required',
            'quantity'=>'required',
            'price'=>'required',
        ]);
        $transactionDetails->product_id = $request->product_id;
        $transactionDetails->quantity = $request->quantity;
        $transactionDetails->price = $request->price;
        $transactionDetails->update();
        // dd($oldData,$request);

        $inventoryController= new InventoryController();
        $inventoryController->updateQuantity($oldData, $request,'Incoming');
        return redirect()->back()->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transactionsdetails = TransactionsDetails::where('id',$id)->first();
        $transactionsdetails->delete();
        // dd($transactionsdetails);
        return redirect()->back()->with('success','Detail deleted successfully');
    }
}
