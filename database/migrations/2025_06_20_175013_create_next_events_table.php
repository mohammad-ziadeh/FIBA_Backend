<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('next_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location');
            $table->date('start_date');
            $table->date('end_date');
            $table->softDeletes();
            $table->string('image_url')->nullable();
            $table->string('event_code');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};
