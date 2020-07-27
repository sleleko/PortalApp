<?php

use Vesp\Services\Migration;
use Illuminate\Database\Schema\Blueprint;

class HealthStatuses extends Migration
{
    public function up() {
        $this->schema->create('health_statues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
        });
    }

    public function down()
    {
        $this->schema->drop('health_statues');
    }
}