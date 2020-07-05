<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ActionsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->string('type');

            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');;

            $table->string('client_name');
            $table->string('product_name');
            $table->integer('price');
            $table->string('quantity');

            $table->date('date');
            $table->string('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('actions', function (Blueprint $table) {

        });
    }
}
