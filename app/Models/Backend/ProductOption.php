<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory; 
    protected $table='products_options';
    protected $fillable = ['product_id','option_id','attribute_value'];

    function option(){
        return $this->belongsTo(Option::class,'option_id','id');
    }
}
