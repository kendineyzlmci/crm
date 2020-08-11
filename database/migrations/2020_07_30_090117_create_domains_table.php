<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('user_id');
            $table->integer('customer_id')->default(0);
            $table->integer('agency');
            $table->string('phone');
            $table->string('email');
            $table->string('agentName');
            $table->integer('registrar');
            $table->dateTime('registered_on');
            $table->dateTime('updated_on');
            $table->dateTime('expires_on');
            $table->integer('renewal_status');
            $table->integer('hosting');
            $table->integer('ssl')->default(0);
            $table->integer('status')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('domains');
    }
}
