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
        Schema::create('carts', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items')
                ->onDelete('cascade')
                ->onDelete('cascade');
            $table->integer('qty');
            $table->timestamps();
        });

        DB::unprepared('CREATE TRIGGER `reduce_stc`
        AFTER INSERT ON `carts` FOR EACH ROW
        UPDATE items SET items.stock =
        items.stock - NEW.qty
        WHERE items.id = NEW.item_id;
        ');

        DB::unprepared('CREATE TRIGGER `restore_stc` 
        AFTER DELETE ON `carts` FOR EACH ROW
        UPDATE items SET items.stock = 
        items.stock + OLD.qty
        WHERE items.id = OLD.item_id;    
        ');

        DB::unprepared('CREATE TRIGGER `update_stc` 
        AFTER UPDATE ON `carts` FOR EACH ROW
        UPDATE items SET items.stock = 
        (items.stock + OLD.qty) - NEW.qty
        WHERE items.id = OLD.item_id;    
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
