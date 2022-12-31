<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('username', 100);
            $table->string('nickname', 200)->default('admin');
            $table->string('password');
            $table->string('email');
            $table->string('avatar')->nullable();
            $table->string('loginip')->nullable();
            $table->timestamp('logintime')->nullable();
            $table->timestamp('createtime')->nullable();
            $table->timestamp('updatetime')->nullable();
            $table->boolean('status')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
