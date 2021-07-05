<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','quantity'];
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    // public function transactionsdetails(){
    //     return $this->belongsTo(TransactionsDetails::class);
    // }
}
