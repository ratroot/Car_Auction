<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsOtherFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions_other_info', function (Blueprint $table) {
            $table->string('DoorFrontLeftReplaced', 100)->nullable();
            $table->string('DoorFrontLeft', 100)->nullable();
            $table->string('DoorRearLeftReplaced', 100)->nullable();
            $table->string('DoorRearLeft', 100)->nullable();
            $table->string('WingFrontLeftReplaced', 100)->nullable();
            $table->string('WingFrontLeft', 100)->nullable();
            $table->string('WingRearLeftReplaced', 100)->nullable();
            $table->string('WingRearLeft', 100)->nullable();
            $table->string('BumperFrontReplaced')->nullable();
            $table->string('BumperFront', 100)->nullable();
            $table->string('BumperRearReplaced', 100)->nullable();
            $table->string('BumperRear', 100)->nullable();
            $table->string('RoofCheck', 100)->nullable();
            $table->string('RoofRack', 100)->nullable();
            $table->string('DoorFrontRightReplaced', 100)->nullable();
            $table->string('DoorRearRight', 100)->nullable();
            $table->string('WingFrontRightReplaced', 100)->nullable();
            $table->string('WingRearRight', 100)->nullable();
            $table->string('BootReplaced', 100)->nullable();
            $table->string('Boot', 100)->nullable();
            $table->string('SignCrumping', 100)->nullable();
            $table->string('Rust', 100)->nullable();
            $table->string('Underneath_Chassis_Rusty', 100)->nullable();
            $table->string('BonnetReplaced', 100)->nullable();
            $table->string('Bonnet', 100)->nullable();
            $table->string('GrilleInspection', 100)->nullable();
            $table->string('Sunroof_Moonroof', 100)->nullable();
            $table->string('ConvertibleTop', 100)->nullable();
            $table->string('OutsideMirror', 100)->nullable();
            $table->string('WindSheildGlass', 100)->nullable();
            $table->string('SunroofGlass', 100)->nullable();
            $table->string('WiperGlass', 100)->nullable();
            $table->string('WIperBlade')->nullable();
            $table->string('Doors', 100)->nullable();
            $table->string('Tailgate', 100)->nullable();
            $table->string('PowerLiftGateOp', 100)->nullable();
            $table->string('Hood', 100)->nullable();
            $table->string('FrontendExteriorLights', 100)->nullable();
            $table->string('SideExteriorRight', 100)->nullable();
            $table->string('SideExteriorLeft', 100)->nullable();
            $table->string('BackendExteriorLights', 100)->nullable();
            $table->string('HazardLights', 100)->nullable();
            $table->string('Radio_CD', 100)->nullable();
            $table->string('BoardComputer', 100)->nullable();
            $table->string('AC_System', 100)->nullable();
            $table->string('HeatingSystem', 100)->nullable();
            $table->string('WarningSignalsActive', 100)->nullable();
            $table->string('InstrumentPanel', 100)->nullable();
            $table->string('DomeMapLights', 100)->nullable();
            $table->string('WindowControls')->nullable();
            $table->string('Horn', 100)->nullable();
            $table->string('CenterArmrest', 100)->nullable();
            $table->string('WindsheildWiperControl', 100)->nullable();
            $table->string('SteeringWheelControls', 100)->nullable();
            $table->string('DoorLocks', 100)->nullable();
            $table->string('Clock', 100)->nullable();
            $table->string('GloveBox', 100)->nullable();
            $table->string('Headliner', 100)->nullable();
            $table->string('DoorTrimAndPanels', 100)->nullable();
            $table->string('SafetyBelts', 100)->nullable();
            $table->string('EngineStartsProperty', 100)->nullable();
            $table->string('Engine', 100)->nullable();
            $table->string('EngineGroup', 100)->nullable();
            $table->string('EngineNoise', 100)->nullable();
            $table->string('EngineVisualInspection', 100)->nullable();
            $table->string('EngineExhaust', 100)->nullable();
            $table->string('Suspension_UnderneathNoise', 100)->nullable();
            $table->string('ProfileSystem_MemorySeats', 100)->nullable();
            $table->string('CruiseControl', 70)->nullable();
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
        Schema::dropIfExists('auctions_other_info');

    }
}
