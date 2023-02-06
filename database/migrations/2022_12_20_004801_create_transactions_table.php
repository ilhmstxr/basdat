<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('userkupon_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('userkupon_id')->references('id')->on('user_kupons')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            // $table->date('datetime');
            $table->integer('total');
            $table->integer('pay_total');
            $table->timestamps();
        });

        
        DB::unprepared('CREATE TRIGGER `get_cupon` AFTER INSERT ON `transactions`
        FOR EACH ROW UPDATE user_kupons 
        SET user_kupons.quantity_kupon = user_kupons.quantity_kupon +1
        
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
