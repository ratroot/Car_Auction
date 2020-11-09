<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->string('Make')->default(null)->nullable();
            $table->string('Model')->default(null)->nullable();
            $table->string('Year', 100)->default(null)->nullable();
            $table->string('ExactModel')->default(null)->nullable();
            $table->string('Transmission', 150)->default(null)->nullable();
            $table->string('InteriorTrim')->default(null)->nullable();
            $table->string('Specifications')->default(null)->nullable();
            $table->string('EngineGlinders', 150)->default(null)->nullable();
            $table->string('OdoMeterReading', 150)->default(null)->nullable();
            $table->string('Paint', 150)->default(null)->nullable();
            $table->string('AccidentHistory', 50)->default(null)->nullable();
            $table->string('ServiceHistory, 50')->default(null)->nullable();
            $table->string('ServiceType')->default(null)->nullable();
            $table->string('Body')->default(null)->nullable();
            $table->string('Drive', 50)->default(null)->nullable();
            $table->string('SteeringWheelLocation', 50)->default(null)->nullable();
            $table->string('CarColor', 50)->default(null)->nullable();
            $table->string('FuelType', 50)->default(null)->nullable();
            $table->string('CarNumber')->default(null)->nullable();
            $table->string('EngineSize', 50)->default(null)->nullable();
            $table->string('Structural_Chassis_Damage', 50)->default(null)->nullable();
            $table->string('ChassisRepaired', 50)->default(null)->nullable();
            $table->string('ChassisExtention', 50)->default(null)->nullable();
            $table->string('NaviagtionSystem', 50)->default(null)->nullable();
            $table->string('VINPlate')->default(null)->nullable();
            $table->string('ManufactureYear')->default(null)->nullable();
            $table->string('ManufactureMonth', 50)->default(null)->nullable();
            $table->string('WarrantyMonth', 50)->default(null)->nullable();
            $table->string('WarrantyValidity', 50)->default(null)->nullable();
            $table->string('SMC_ValidTill')->default(null)->nullable();
            $table->string('NumberOfKeys', 50)->default(null)->nullable();
            $table->string('Roof', 50)->default(null)->nullable();
            $table->string('RimType', 50)->default(null)->nullable();
            $table->string('RimCondition', 50)->default(null)->nullable();
            $table->string('SealColor', 50)->default(null)->nullable();
            $table->string('NumberOfSeats', 50)->default(null)->nullable();
            $table->dateTime('StartDate')->nullable();
            $table->dateTime('EndDate')->nullable();
            $table->string('ReserveCost', 50)->nullable();
            $table->text('Note')->default(null)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auctions');
    }
}
