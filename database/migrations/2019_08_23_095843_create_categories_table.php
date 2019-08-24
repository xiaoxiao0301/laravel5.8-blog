<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('cate_id');
            $table->string('cate_name', 50)->comment('分类名称');
            $table->string('cate_title')->comment('分类标题说明');
            $table->string('cate_keywords')->nullable()->comment('分类关键字');
            $table->string('cate_describe')->nullable()->comment('分类简介');
            $table->integer('cate_view')->default(0)->comment('分类查看次数');
            $table->integer('cate_order')->default(0)->comment('分类排序规则');
            $table->integer('cate_pid')->default(0)->comment('分类的上级分类');
            $table->softDeletes();
//            $table->engine = 'InnoDB';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
