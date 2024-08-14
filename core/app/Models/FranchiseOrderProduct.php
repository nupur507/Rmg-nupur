<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FranchiseOrderProduct extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $table = "franchise_order_products";


}
