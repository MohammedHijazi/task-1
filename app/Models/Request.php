<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable=[
      'category','quantity_type','quantity','driver_id','status'
    ];

    public function driver(){
        return $this->belongsTo(Driver::class);
    }

}
