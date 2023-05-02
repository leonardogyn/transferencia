<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTransfers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_transfers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_payer_id')->references('id')->on('users');
            $table->foreignUuid('account_payer_id')->references('id')->on('accounts');
            $table->foreignUuid('user_payee_id')->references('id')->on('users');
            $table->foreignUuid('accounts_payee_id')->references('id')->on('accounts');
            $table->decimal('value_old');
            $table->decimal('value');
            $table->decimal('value_new');
            $table->decimal('flag');

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
        Schema::dropIfExists('history_transfers');
    }
}
