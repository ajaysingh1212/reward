<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRowDataWinnerPivotTable extends Migration
{
    public function up()
    {
        Schema::create('row_data_winner', function (Blueprint $table) {
            $table->unsignedBigInteger('winner_id');
            $table->foreign('winner_id', 'winner_id_fk_10796333')->references('id')->on('winners')->onDelete('cascade');
            $table->unsignedBigInteger('row_data_id');
            $table->foreign('row_data_id', 'row_data_id_fk_10796333')->references('id')->on('row_datas')->onDelete('cascade');
        });
    }
}
