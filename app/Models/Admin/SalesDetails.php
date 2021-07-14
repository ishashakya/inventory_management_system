<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetails extends Model
{
    use HasFactory;
    protected $fillable=['product_id','cp','quantity','price','transaction_id'];
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }
}
