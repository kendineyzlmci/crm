<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image')->default('default.png');
            $table->string('agentName');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->integer('representative');
            $table->integer('created_user');
            $table->integer('customer_type')->default(3);
            $table->integer('status')->default(0);
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('customers');
    }
}
