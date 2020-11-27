<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $table = 'auctions';
    protected $guarded = ['filename'];
    protected $fillable = ['Make','Model','Year', 'ExactModel','Transmission', 'InteriorTrim','Specifications',
    'EngineGlinders', 'OdoMeterReading', 'Paint', 'AccidentHistory', 'ServiceHistory', 'ServiceType','Body',
    'Drive', 'SteeringWheelLocation', 'CarColor', 'FuelType', 'CarNumber','EngineSize',
    'Structural_Chassis_Damage', 'ChassisRepaired', 'ChassisExtention', 'NaviagtionSystem',
    'VINPlate','ManufactureYear','ManufactureMonth', 'WarrantyMonth', 'WarrantyValidity',
    'SMC_ValidTill','NumberOfKeys', 'Roof', 'RimType', 'RimCondition', 'SealColor', 'NumberOfSeats','StartDate',
    'EndDate','ReserveCost','Note','CarBodyImage'];

    public $timestamps = false;
    
}
