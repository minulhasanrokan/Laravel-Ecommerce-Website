<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Customer extends Model
{
    use HasFactory;

    public function OrderrelatedCustomer(){
        return $this->hasOne("App\Order","customer_id","id");
    }
}
