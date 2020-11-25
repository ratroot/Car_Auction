<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsExtraFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions_extra_info', function (Blueprint $table) {
            $table->string('FuelPumpNoise', 100)->nullable();
            $table->string('TransmissionCondition', 100)->nullable();
            $table->string('StrutsAndShocks', 100)->nullable();
            $table->string('FrontCamera', 100)->nullable();
            $table->string('RightCamera', 100)->nullable();
            $table->string('RearSensors', 100)->nullable();
            $table->string('RearCamera', 100)->nullable();
            $table->string('FrontSensors', 100)->nullable();
            $table->string('LightCamera', 100)->nullable();
            $table->string('Hoses_Wiring', 100)->nullable();
            $table->string('Charger', 100)->nullable();
            $table->string('Water_Slidge_Oil', 100)->nullable();
            $table->string('Fluid', 100)->nullable();
            $table->string('ElectricFRD', 100)->nullable();
            $table->string('ElectricRRD', 100)->nullable();
            $table->string('BatteryExpirationDate', 100)->nullable();
            $table->string('ElectricFLD', 100)->nullable();
            $table->string('ElectricRLD', 100)->nullable();
            $table->string('RearLeftDoor', 100)->nullable();
            $table->string('AlternatorOutdoor', 100)->nullable();
            $table->string('AutomaticTransmissionCheck', 100)->nullable();
            $table->string('TransferCase', 100)->nullable();
            $table->string('DifferemtialDrive', 100)->nullable();
            $table->string('TiresMatch', 100)->nullable();
            $table->string('WheelsMatch', 100)->nullable();
            $table->string('WheelCovers_CenterCaps', 100)->nullable();
            $table->string('FronLeftTireCondition', 100)->nullable();
            $table->string('FronLeftTireProductionDate', 100)->nullable();
            $table->string('RearLeftTireCondition', 100)->nullable();
            $table->string('RearLeftTireProductionDate', 100)->nullable();
            $table->string('CorrectSize', 100)->nullable();
            $table->string('FrontRightTireCondition', 100)->nullable();
            $table->string('FrontRightTireProductionDate', 100)->nullable();
            $table->string('RearRightTireCondition', 100)->nullable();
            $table->string('RearRightTireProductionDate', 100)->nullable();
            $table->string('RotorsAndDrums', 100)->nullable();
            $table->string('BrakePads_Shoes', 100)->nullable();
            $table->string('MasterCylinderAndBooster', 100)->nullable();
            $table->string('ParkingBrake', 100)->nullable();
            $table->foreignId('auctionID')->constrained('auctions');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auctions_extra_info');

    }
}
