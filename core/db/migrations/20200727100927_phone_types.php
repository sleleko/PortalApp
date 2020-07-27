<?php

use Vesp\Services\Migration;
use Illuminate\Database\Schema\Blueprint;

class PhoneTypes extends Migration
{
    public function up() {
        $this->schema->create('phone_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
        });
    }

    public function down()
    {
        $this->schema->drop('phone_types');
    }
}