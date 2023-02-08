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
        Schema::create('user_kupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('kupon_id')->nullable();
            $table->foreign('kupon_id')->references('id')->on('kupons')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('quantity_kupon')->nullable();
            $table->timestamps();
        });

        // DB::unprepared('CREATE TRIGGER `min_cupon` AFTER UPDATE ON `user_kupons`
        // FOR EACH ROW UPDATE kupons SET kupons.stok = kupons.stok - 1
        // ');
        // CREATE TRIGGER `default_cupon` AFTER INSERT ON `users`
        // FOR EACH ROW INSERT INTO `user_kupons` (`user_id`, `kupon_id`, `quantity_kupon`, `created_at`, `updated_at`) VALUES (NEW.id, NULL, NULL, NULL, NULL)
    }




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_kupons');
    }
};
