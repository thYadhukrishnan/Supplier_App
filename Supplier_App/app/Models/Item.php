<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_no'); 
    }
}
