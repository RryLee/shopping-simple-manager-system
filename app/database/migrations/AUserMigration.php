<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class AUserMigration
{
    function run()
    {
        Capsule::schema()->dropIfExists('users');

        Capsule::schema()->create('users', function($table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('username');
            $table->string('password');
            $table->boolean('issuper')->default(0);
            $table->string('remember_identifier')->nullable();
            $table->string('remember_token')->nullable();
            $table->timestamps();
        });
    }
}
