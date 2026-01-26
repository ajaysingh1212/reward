<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRowDatasTable extends Migration
{
    public function up()
    {
        Schema::create('row_datas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unique_code')->unique();
            $table->string('amount');
            $table->date('expiry_date')->nullable();
            $table->string('status')->nullable();
            $table->string('reward_status')->nullable();
            $table->string('used_by')->nullable();
            $table->string('used_by_phone')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
