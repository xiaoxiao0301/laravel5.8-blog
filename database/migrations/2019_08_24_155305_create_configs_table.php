<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->bigIncrements('configs_id');
            $table->string('configs_title')->comment('配置项标题');
            $table->string('configs_name')->comment('变量名');
            $table->text('configs_content')->comment('变量值');
            $table->string('field_type')->nullable()->comment('配置项类型 单选 多选 文本域');
            $table->string('field_value')->nullable()->comment('配置项类型值');
            $table->integer('configs_order')->default(0)->comment('排序');
            $table->string('configs_tips')->comment('配置项说明');
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
        Schema::dropIfExists('configs');
    }
}
