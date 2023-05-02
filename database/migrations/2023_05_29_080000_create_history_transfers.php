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
            $table->foreignUuid('type_transfer_id')->references('id')->on('type_transfers');
            $table->decimal('value_transfer');
            $table->char('flag_transfer', 1);
            $table->foreignUuid('user_payer_id')->references('id')->on('users');
            $table->char('flag_type_user_payer', 1);
            $table->foreignUuid('account_payer_id')->references('id')->on('accounts');
            $table->decimal('value_payer_old');
            $table->decimal('value_payer_new');
            $table->foreignUuid('user_payee_id')->references('id')->on('users');
            $table->char('flag_type_user_payee', 1);
            $table->foreignUuid('accounts_payee_id')->references('id')->on('accounts');
            $table->decimal('value_payee_old');
            $table->decimal('value_payee_new');
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
