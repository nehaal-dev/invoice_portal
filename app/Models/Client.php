<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'user_id',
        'client_name',
        'email',
        'phone',
        'address',
        'city',
        'country',

    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
