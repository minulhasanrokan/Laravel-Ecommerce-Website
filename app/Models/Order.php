<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Order extends Model
{
    use HasFactory;

    protected $fillable =[
        'customer_id',
        'shipping_id',
        'total_price',
        'payment_type',
        'order_status',
        'payment_status'
    ];

    public function OrderrelatedCustomer(){
        return $this->hasOne("App\Models\Customer","id","customer_id");
    }
}
