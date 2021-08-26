<?php

use Vesp\Services\Migration;
use Illuminate\Database\Schema\Blueprint;

class Users extends Migration
{

    public function up(): void
    {
        $this->schema->create('user_roles', static function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 191)->unique();
            $table->text('scope')->nullable();
            $table->timestamps();
        });

        $this->schema->create('users', static function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 191)->unique();
            $table->string('password')->nullable();
            $table->string('fullname')->nullable();
            $table->string('email')->nullable();
            $table->char('phone', 12)->nullable();
            $table->integer('role_id')->unsigned()->nullable();
            $table->boolean('active')->default(true)->index();
            $table->timestamps();

            $table->foreign('role_id')
                ->references('id')->on('user_roles')
                ->onUpdate('restrict')
                ->onDelete('set null');
        });

        $this->schema->create('user_tokens', static function (Blueprint $table) {
            $table->string('token', 191)->primary();
            $table->integer('user_id')->unsigned();
            $table->boolean('active')->default(1);
            $table->string('ip')->nullable();
            $table->timestamp('valid_till')->nullable()->index();
            $table->timestamps();

            $table->index(['token', 'user_id', 'active']);

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });
    }


    public function down(): void
    {
        $this->schema->drop('user_tokens');
        $this->schema->drop('users');
        $this->schema->drop('user_roles');
    }
}
