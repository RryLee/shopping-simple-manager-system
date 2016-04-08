<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class DGoodsMigration
{
    function run()
    {
        Capsule::schema()->dropIfExists('goods');

        Capsule::schema()->create('goods', function($table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('supplier_id')->unsigned()->index();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->string('name');
            $table->integer('amount');
            $table->float('price');
            $table->timestamps();
        });
    }
}
