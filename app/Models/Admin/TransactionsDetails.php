<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionsDetails extends Model
{
    use HasFactory;
    protected $fillable=['product_id','quantity','price','transaction_id'];
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function Transaction()
    {
    	return $this->belongsTo(Transaction::class);
    }
}
