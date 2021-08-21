<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DealAddStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals_dict_status', function (Blueprint $table) {

            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('step_name')->nullable();
            $table->text('description')->nullable();

            $table->nullableMorphs('owned_by');


            $table->integer('company_id')->nullable();

            $table->timestamps();

        });

        Schema::table('deals', function (Blueprint $table) {

            $table->integer('deal_status_id')->unsigned()->nullable();
            $table->foreign('deal_status_id')->references('id')->on('deals_dict_status');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deals_dict_status');

        Schema::table('deals', function (Blueprint $table) {
            $table->dropColumn('deal_status_id');
        });
    }
}
