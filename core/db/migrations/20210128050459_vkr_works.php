<?php

use Vesp\Services\Migration;
use Illuminate\Database\Schema\Blueprint;

class VkrWorks extends Migration
{

    public function up(): void
    {
        $this->schema->create('vkr_works', static function (Blueprint $table) {
            $table->increments('id');
            $table->string('author', 191);
            $table->text('title_vkr');
            $table->integer('type_vkr')->index();
            $table->string('scientific_director')->nullable();
            $table->integer('year_pub')->index();
            $table->integer('count_pages');
            $table->text('keywords')->nullable();
            $table->text('annotation')->nullable();
            $table->integer('file_id')->unsigned();
            $table->timestamps();

            $table->foreign('file_id')
                ->references('id')->on('files')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });
    }


    public function down(): void
    {
        $this->schema->table('vkr_works', static function (Blueprint $table) {
            $table->dropForeign('vkr_works_file_id_foreign');
        });
        $this->schema->drop('vkr_works');
    }
}
