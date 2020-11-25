<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction_Extra_Info extends Model
{
    protected $table = 'auctions_extra_info';
    
    protected $fillable = ['FuelPumpNoise','TransmissionCondition','StrutsAndShocks',
    'FrontCamera','RightCamera','RearSensors','RearCamera','FrontSensors','LightCamera',
    'Hoses_Wiring','Charger','Water_Slidge_Oil','Fluid','ElectricFRD','ElectricRRD',
    'BatteryExpirationDate','ElectricFLD','ElectricRLD','RearLeftDoor','AlternatorOutdoor',
    'AutomaticTransmissionCheck','TransferCase','DifferemtialDrive','TiresMatch','WheelsMatch',
    'WheelCovers_CenterCaps','FronLeftTireCondition','FronLeftTireProductionDate',
    'RearLeftTireCondition','RearLeftTireProductionDate','CorrectSize','FrontRightTireCondition',
    'FrontRightTireProductionDate','RearRightTireCondition','RearRightTireProductionDate',
    'RotorsAndDrums','BrakePads_Shoes','MasterCylinderAndBooster','ParkingBrake',  'auctionID'];

    public $timestamps = false;
}
