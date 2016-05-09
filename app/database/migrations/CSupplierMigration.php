<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class CSupplierMigration
{
    function run()
    {
        Capsule::schema()->dropIfExists('suppliers');

        Capsule::schema()->create('suppliers', function($table) {
            $table->increments('id');
            $table->string('brand');
            $table->string('linkman');
            $table->string('phone');
            $table->timestamps();
        });
    }
}
