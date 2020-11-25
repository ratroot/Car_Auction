<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction_Other_Info extends Model
{
    protected $table = 'auctions_other_info';
    
    protected $fillable = ['DoorFrontLeftReplaced','DoorFrontLeft','DoorRearLeftReplaced',
    'DoorRearLeft','WingFrontLeftReplaced','WingFrontLeft','WingRearLeftReplaced',
    'WingRearLeft','BumperFrontReplaced','BumperFront','BumperRearReplaced','BumperRear',
    'RoofCheck','RoofRack','DoorFrontRightReplaced','DoorRearRight','WingFrontRightReplaced',
    'WingRearRight','BootReplaced','Boot','SignCrumping','Rust','Underneath_Chassis_Rusty',
    'BonnetReplaced','Bonnet','GrilleInspection','Sunroof_Moonroof','ConvertibleTop','OutsideMirror',
    'WindSheildGlass','SunroofGlass','WiperGlass','WIperBlade','Doors','Tailgate','PowerLiftGateOp',
    'Hood','FrontendExteriorLights','SideExteriorRight','SideExteriorLeft','BackendExteriorLights',
    'HazardLights','Radio_CD','BoardComputer','AC_System','HeatingSystem','WarningSignalsActive',
    'InstrumentPanel','DomeMapLights','WindowControls','Horn','CenterArmrest','WindsheildWiperControl',
    'SteeringWheelControls','DoorLocks','Clock','GloveBox','Headliner','DoorTrimAndPanels','SafetyBelts',
    'EngineStartsProperty','Engine','EngineGroup','EngineNoise','EngineVisualInspection','EngineExhaust',
    'Suspension_UnderneathNoise','ProfileSystem_MemorySeats','CruiseControl','auctionID'];


    public $timestamps = false;
}
