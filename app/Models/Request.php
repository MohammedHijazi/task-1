<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'category', 'quantity_type', 'quantity', 'driver_id', 'status'
    ];

    public $appends = ['driver_name'];

    protected $casts = [
        'created_at' => 'date:d-m-y',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }



    public function getDriverNameAttribute(){
        return  $this->driver->name;
    }

    public function getQuantityTypeAttribute($value){
        if($value=='liter'){
            return 'لتر';
        }else{
            return 'شيكل';
        }
    }


}
