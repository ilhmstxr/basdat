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
            // $table->unsignedBigInteger('user_id')->nullable();
            // $table->foreign('user_id')->references('id')->on('users')
            //     ->onDelete('cascade')
            //     ->onUpdate('cascade');
            $table->unsignedBigInteger('userkupon_id')->nullable();
            $table->foreign('userkupon_id')->references('id')->on('user_kupons')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            // $table->date('datetime');
            $table->integer('total');
            $table->integer('pay_total');
            $table->timestamps();
        });


        // DB::unprepared('CREATE TRIGGER `get_cupon` AFTER INSERT ON `transactions`
        // FOR EACH ROW UPDATE user_kupons 
        // SET user_kupons.quantity_kupon = user_kupons.quantity_kupon +1
        // ');

        // db::unprepared('CREATE TRIGGER `default_cupon` BEFORE INSERT ON `transactions`
        // FOR EACH ROW INSERT INTO 
        // `user_kupons` (`user_id`, `kupon_id`, `quantity_kupon`, `created_at`, `updated_at`) 
        // VALUES (new.user_id, 1, NULL, NULL, NULL)');
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
