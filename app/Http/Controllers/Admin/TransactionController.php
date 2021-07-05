<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use App\Models\Admin\Transaction;
use App\Models\Admin\TransactionsDetails;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::get();
        return view('admin.transaction.index',compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        return view('admin.transaction.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $product_sum
        // dd($request);
        $validate = $request->validate([
            'merchant_name' => 'required',
            'date'=>'required',
            'total'=>'required|greater_than_field:credit',
            // 'credit'=>'greater_than_field:total',
            "item.*.product_id"=>'required',
            "item.*.quantity"=>'required',
            "item.*.price"=>'required',
        ]);
        $transaction = new Transaction();
        $transaction->merchant_name = $request->merchant_name;
        $transaction->date = $request->date;
        $transaction->total = $request->total;
        $transaction->credit = $request->credit;
        $transaction->save();

        foreach ($request->item as $key => $value) {
            // dd($value["product_id"]);
            $transaction_detail= new TransactionsDetails();
            $transaction_detail->product_id=$value["product_id"];
            $transaction_detail->quantity=$value["quantity"];
            $transaction_detail->price=$value["price"];
            $transaction_detail->transaction_id=$transaction->id;
            $transaction_detail->save();

            $inventoryController= new InventoryController();
            $inventoryController->addQuantity($transaction_detail->product_id, $transaction_detail->quantity);
        }
        // dd($transaction);
        return redirect()->route('admin.transaction.index')->with('success', 'Transaction created successfully.');
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
        $transaction = Transaction::find($id);
        return view('admin.transaction.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
            $validate = $request->validate([
                'merchant_name' => 'required',
                'date'=>'required',
                'total'=>'required|greater_than_field:credit',
            ]);
            // $transaction = new Transaction();
            $transaction->merchant_name = $request->merchant_name;
            $transaction->date = $request->date;
            $transaction->total = $request->total;
            $transaction->credit = $request->credit;
            $transaction->update();
            // dd($transaction);
        return redirect()->route('admin.transaction.index')->with('success', 'Transaction created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->back()->with('success', 'Transaction deleted successful');
    }
}
