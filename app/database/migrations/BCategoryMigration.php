<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class BCategoryMigration
{
    function run()
    {
        Capsule::schema()->dropIfExists('categories');

        Capsule::schema()->create('categories', function($table) {
            $table->increments('id');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->timestamps();
        });
    }
}
