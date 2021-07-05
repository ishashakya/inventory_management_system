<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['merchant_name','date','total','credit'];
    public function transactiondetails(){
        return $this->hasMany(TransactionsDetails::class);
    }

}
