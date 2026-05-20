<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 

class Invoice extends Model
{
    protected $fillable = [
        'user_id',
        'client_id',
        'invoice_number',  // ←  this is  missing 
        'invoice_date',
        'due_date',
        'status',
        'subtotal',
        'tax',
        'discount',
        'total',
        'notes',
    ];






    public function items(){
    return $this->hasMany(InvoiceItem::class);
    }  
    
    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
