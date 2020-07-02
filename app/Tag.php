<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Tag extends Model
{
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'tag_name',
   ];

   /**
    * products that have this tag attached to it
    */
   public function products() {
      return $this->belongsToMany(Product::class)->withTimestamps();
   }
}
