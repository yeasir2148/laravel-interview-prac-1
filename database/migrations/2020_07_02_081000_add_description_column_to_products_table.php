<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionColumnToProductsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::table('products', function (Blueprint $table) {
         $table->string('description', 250)->after('name')->comment('Description of the product')->nullable(false)->default('');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::table('products', function (Blueprint $table) {
         $table->dropColumn('description');
      });
   }
}
