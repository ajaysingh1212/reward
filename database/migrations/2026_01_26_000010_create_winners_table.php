<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWinnersTable extends Migration
{
    public function up()
    {
        Schema::create('winners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->string('upi');
            $table->string('product_name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
