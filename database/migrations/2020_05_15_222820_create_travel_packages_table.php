<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('city_id'); 
            $table->string('name', 100); //` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
            $table->integer('price')->unsigned(); //` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
            $table->tinyInteger('days')->unsigned();
            $table->tinyInteger('nights')->unsigned();
            $table->string('image_url')->nullable();
            $table->tinyInteger('status')->default(0); //` tinyint(1) NOT NULL DEFAULT '0',
            $table->tinyInteger('availability')->default(1); //` tinyint(2) NOT NULL DEFAULT '1',
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('travel_packages');
    }
}
