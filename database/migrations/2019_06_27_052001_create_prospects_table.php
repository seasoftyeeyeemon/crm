<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('address');
            $table->string('city');
            $table->text('note');
            $table->text('prospect_message');
            $table->boolean('isClient')->default(false);
            $table->boolean('isClaimable')->default(true);
            $table->integer('assigned')->default(1);
            $table->dateTime('date_assigned')->nullable();
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
        Schema::dropIfExists('prospects');
    }
}
