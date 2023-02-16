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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('nik');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // $table->rememberToken();
            $table->timestamps();
        });

        db::unprepared('CREATE TRIGGER `default_cupon`
         AFTER INSERT ON `users`
        FOR EACH ROW INSERT INTO `user_kupons` 
        (`id`, `user_id`, `kupon_id`, `quantity_kupon`,
         `created_at`, `updated_at`) 
         VALUES (NULL, NEW.id, 1, 1, NULL, NULL)
        ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
