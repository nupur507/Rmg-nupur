<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FranchiseOrder extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $table = "franchise_orders";


    public function franchise()
    {
        return $this->belongsTo(Franchise::class, 'franchise_id', 'franchise_id');
    }


}
