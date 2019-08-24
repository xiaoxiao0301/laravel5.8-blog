<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('art_id');
            $table->string('art_title')->comment('文章标题');
            $table->string('art_tag')->comment('文章关键字');
            $table->string('art_description')->comment('文章简短描述');
            $table->string('art_author')->comment('文章编辑');
            $table->string('art_thumb')->comment('文章缩略图');
            $table->text('art_content')->comment('文章内容');
            $table->timestamp('art_timer')->comment('文章发布时间');
            $table->integer('art_view')->default(0)->comment('文章浏览次数');
            $table->integer('art_cate_id')->comment('文章分类');
            $table->softDeletes();
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
        Schema::dropIfExists('articles');
    }
}
