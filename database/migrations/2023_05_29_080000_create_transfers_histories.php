<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('transfer_id')->references('id')->on('transfers');
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignUuid('account_id')->references('id')->on('accounts');
            $table->char('flag_transfer', 1);
            $table->decimal('value_transfer');
            $table->decimal('value_old');
            $table->decimal('value_new');
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
        Schema::dropIfExists('transfers_histories');
    }
}
