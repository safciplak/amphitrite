<?php

use App\Models\Device;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->string('client_token');
            $table->unsignedInteger('app_id');
            $table->unsignedInteger('operating_system_id');
            $table->string('language', 3);
            $table->unsignedTinyInteger('subscription_status')->default(Device::SUBSCRIPTION_STATUS);
            $table->text('receipt')->default(null)->nullable();
            $table->dateTime('expire_date')->default(null)->nullable();
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
        Schema::dropIfExists('devices');
    }
}
