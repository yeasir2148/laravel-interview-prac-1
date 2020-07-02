<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'name',
   ];

   /**
    * Setting up a mutator for the name column. It will always be saved in lowercase
    */
   public function setNameAttribute($value) {
      $this->attributes['name'] = strtolower($value);
   }
}
