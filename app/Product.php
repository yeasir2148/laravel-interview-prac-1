<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;

class Product extends Model
{

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'name',
      'description'
   ];

   /**
    * Setting up a mutator for the name column. It will always be saved in lowercase
    */
   public function setNameAttribute($value)
   {
      $this->attributes['name'] = strtolower($value);
   }

   /**
    * tags that are attached to this product
    */
   public function tags()
   {
      return $this->belongsToMany(Tag::class)->withTimestamps();
   }
}
