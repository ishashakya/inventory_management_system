<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Inventory;
use App\Models\Admin\Product;
use App\Models\Admin\TransactionsDetails;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories=Inventory::with('product')->get();
        // dd($inventories);
        return view('admin.inventories.index',compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($transaction_detail)
    {
        $inventory['product_id'] = $transaction_detail->product_id;
        $inventory['quantity']= $transaction_detail->quantity;
        $inventory['price']= $transaction_detail->price;
        Inventory::create($inventory);
        // return view('admin.inventories.index',compact('$inventory'));
    }
    public function addQuantity($transaction_detail){
        $inventory=Inventory::where('product_id',$transaction_detail->product_id)->
        where('price',$transaction_detail->price)->get();
        if(!$inventory->isEmpty()){
            $inventory[0]->quantity+=$transaction_detail->quantity;
            $inventory[0]->update();
        }
        else{
            $this->create($transaction_detail);
        }
    }
    public function updateQuantity($oldData, $newData, $type){
        // dd($oldData['product_id'],$newData);
        if($type=='Incoming'){
            $inventory=Inventory::where('product_id',$oldData['product_id'])->
            where('price',$oldData['price'])->get();

            $inventory[0]->quantity+= $newData->quantity - $oldData['quantity'];
            $inventory[0]->update();
            // dd($inventory[0],$newData,$oldData);
        } else{
            $inventory=Inventory::where('product_id',$oldData['product_id'])->
            where('price',$oldData['cp'])->get();

            $inventory[0]->quantity-= $newData->quantity - $oldData['quantity'];
            $inventory[0]->update();
        }
    }

    public function reduceQuantity($sale_detail){
        $inventory=Inventory::where('product_id',$sale_detail->product_id)->
        where('price',$sale_detail->cp)->get();
        $inventory[0]->quantity-=$sale_detail->quantity;
        $inventory[0]->update();
    }

    public function get_data($product_id){
        return Inventory::where('product_id',$product_id)->get();
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
