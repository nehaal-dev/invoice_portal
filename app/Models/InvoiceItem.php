<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected  $fillable = [

        'invoice_id',
        'item_name',
        'quantity',
        'price',
        'total',
        'created_at',
        'updated_at'

    ];

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }


}
