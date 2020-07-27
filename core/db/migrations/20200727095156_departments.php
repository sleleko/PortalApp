<?php

use Vesp\Services\Migration;
use Illuminate\Database\Schema\Blueprint;

class Departments extends Migration
{
    public function up() {
        $this->schema->create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
        });
    }

    public function down()
    {
        $this->schema->drop('departments');
    }
}