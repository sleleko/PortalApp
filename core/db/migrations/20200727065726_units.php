<?php

use Vesp\Services\Migration;
use Illuminate\Database\Schema\Blueprint;

class Units extends Migration
{
    public function up() {
        $this->schema->create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
        });
    }

    public function down()
    {
        $this->schema->drop('units');
    }
}