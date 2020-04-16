<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
   // Table Name
   protected $table = 'prices';
   // Primary Key
   public $primaryKey = 'id';
   // Timestamps
   public $timestamps = true;

   public function product(){
    return $this->belongsTo('App\Product');
}
}
