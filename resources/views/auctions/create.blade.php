@extends('layouts.app')
@section('style')
<style>
 label{
     font-weight:bold;
 }
 .card-header{
    font-weight:bold;
 }
</style>
@endsection
@section('content')
<div class="container">
    
    <img src="{{ asset('public/image/user.png')}}" alt="">
    <div class="row justify-content-center">
       
    <form action="{{url('/auction/store')}}" method="post" class="col-lg-12" enctype="multipart/form-data">
         @csrf 
         <div class="col-lg-12">
         @if (count($errors) > 0)
        <div class="alert alert-danger">
          <strong>Sorry !</strong> There were some problems with your input.<br><br>
          <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
  
          @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div> 
          @endif

         <div class="card" style="margin-bottom:40px;">
            <div class="card-header">{{ __('Auction Details') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="control-label">Start Date and Time</label>
                                <input type="datetime-local" name="StartDate" id="StartDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="control-label">End Date and Time</label>
                                <input type="datetime-local" name="EndDate" id="EndDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="control-label">Reserve Cost</label>
                                <input name="ReserveCost" id="ReserveCost" class="form-control">
                            </div>
                        </div>
                    </div>
                
                </div>
          </div>
        


         <div class="card" style="margin-bottom:40px;">
         <div class="card-header">{{ __('Add Images') }}</div>
         <div class="card-body">
         <div class="input-group control-group increment upload-image" >
          <input type="file" name="filename[]" class="form-control">
          <div class="input-group-btn"> 
            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
          </div>
        </div>
        <div class="clone hide" style="display:none">
          <div class="control-group input-group upload-image" style="margin-top:10px">
            <input type="file" name="filename[]" class="form-control">
            <div class="input-group-btn"> 
              <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
            </div>
          </div>
        </div>
         </div>
         </div>


         <div class="card" style="margin-bottom:40px;">
            <div class="card-header">{{ __('Add Car Body Image') }}</div>
                <div class="card-body">
                    <div class="input-group control-group" >
                        <input type="file" name="carBodyImage" class="form-control">
                    </div>
                </div>
            </div>
         </div>


            <div class="card" style="margin-bottom:40px;">
            <div class="card-header">{{ __('Vehicle Information') }}</div>

            <div class="card-body">
                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                    <label for="" class="control-label">Make</label>
                        <input name="Make" id="Make" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Model</label>
                        <input name="Model" id="Model" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Year</label>
                        <input name="Year" id="Year" class="form-control">
                    </div>
                 </div>

                </div>


                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Exact Model</label>
                        <input name="ExactModel" id="ExactModel" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Transmission</label>
                        <input name="Transmission" id="Transmission" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">InteriorTrim</label>
                        <input name="InteriorTrim" id="InteriorTrim" class="form-control">
                    </div>
                 </div>

                </div>


                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Odo Meter Reading</label>
                        <input type="text" class="form-control" name="OdoMeterReading" id="OdoMeterReading">

                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Paint</label>
                        <input type="text" class="form-control" name="Paint" id="Paint">
                    </div>
                 </div>
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Engine Size</label>
                        <input type="text" class="form-control" name="EngineSize" id="EngineSize">
                    </div>
                 </div>
                 

                </div>

                <div class="row">
                
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Specifications</label>
                        <input type="text" class="form-control" name="Specifications" id="Specifications">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Engine Glinders</label>
                        <input type="text" class="form-control" name="EngineGlinders" id="EngineGlinders">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Accident History</label>
                        <input type="text" class="form-control" name="AccidentHistory" id="AccidentHistory">

                    </div>
                 </div>

                </div>


                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Service History</label>
                        <input type="text" class="form-control" name="ServiceHistory" id="ServiceHistory">

                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Service Type</label>
                        <input type="text" class="form-control" name="ServiceType" id="ServiceType">

                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Body</label>
                        <input type="text" class="form-control" name="Body" id="Body">

                    </div>
                 </div>

                </div>


                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Drive</label>
                        <input name="Drive" id="Drive" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Steering Wheel Location</label>
                        <input name="SteeringWheelLocation" id="SteeringWheelLocation" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">CarColor</label>
                        <input name="CarColor" id="CarColor" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Fuel Type</label>
                        <input name="FuelType" id="FuelType" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Car Number</label>
                        <input name="CarNumber" id="CarNumber" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Structural / Chassis Damage Size</label>
                        <input name="Structural_Chassis_Damage" id="Structural_Chassis_Damage" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Chassis Repaired</label>
                        <input name="ChassisRepaired" id="ChassisRepaired" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Chassis Extention</label>
                        <input type="text" class="form-control" name="ChassisExtention" id="ChassisExtention">

                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Naviagtion System</label>
                        <input name="NaviagtionSystem" id="NaviagtionSystem" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">VINPlate</label>
                        <input name="VINPlate" id="VINPlate" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Manufacture Year</label>
                        <input name="ManufactureYear" id="ManufactureYear" class="form-control">

                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Manufacture Month</label>
                        <input type="text" class="form-control" name="ManufactureMonth" id="ManufactureMonth">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Warranty Validity</label>
                        <input type="text" class="form-control" name="WarrantyValidity" id="WarrantyValidity">

                    </div>
                 </div>

                 <!-- <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">SMC Valid Till</label>
                        <input type="text" class="form-control" name="SMC_ValidTill" id="SMC_ValidTill">

                    </div>
                 </div> -->

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Number Of Keys</label>
                        <input type="text" class="form-control" name="NumberOfKeys" id="NumberOfKeys">

                    </div>
                 </div>
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Warranty Month</label>
                        <input type="text" class="form-control" name="WarrantyMonth" id="WarrantyMonth">

                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Roof</label>
                        <input type="text" class="form-control" name="Roof" id="Roof">

                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Rim Type</label>
                        <input type="text" class="form-control" name="RimType" id="RimType">

                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Rim Condition</label>
                        <input type="text" class="form-control" name="RimCondition" id="RimCondition">

                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Seal Color</label>
                        <input type="text" class="form-control" name="SealColor" id="SealColor">

                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Number Of Seats</label>
                        <input type="text" class="form-control" name="NumberOfSeats" id="NumberOfSeats">

                    </div>
                 </div>

                 <!-- <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Start Date</label>
                        <input type="date" class="form-control" name="StartDate" id="StartDate">

                    </div>
                 </div> -->

                </div>

                <div class="row">
                 <!-- <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">End Date</label>
                        <input type="date" class="form-control" name="EndDate" id="EndDate">

                    </div>
                 </div> -->
                 <!-- <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Warranty Month</label>
                        <input type="text" class="form-control" name="WarrantyMonth" id="WarrantyMonth">

                    </div>
                 </div> -->
                 

                </div>

                <div class="row">
                 <div class="col-lg-12">
                    <div class="form-group">
                        <label for="" class="control-label">Note</label>
                        <textarea rows="5" cols="3" class="form-control" name="Note" id="Note"></textarea>

                    </div>
                 </div>
                 

                </div>
                
                
            </div>
            <!-- <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Save</button>
            
            </div> -->
            </div>
            
            <div class="card">
                <div class="card-header">
                {{ __('Other Information') }}
                </div>
                <div class="card-body">
                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Door Front Left Replaced</label>
                        <input name="DoorFrontLeftReplaced" id="DoorFrontLeftReplaced" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Door Front Left</label>
                        <input name="DoorFrontLeft" id="DoorFrontLeft" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Door Rear Left Replaced</label>
                        <input name="DoorRearLeftReplaced" id="DoorRearLeftReplaced" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Door Rear Left</label>
                        <input name="DoorRearLeft" id="DoorRearLeft" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Wing Front Left Replaced</label>
                        <input name="WingFrontLeftReplaced" id="WingFrontLeftReplaced" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Wing Front Left</label>
                        <input name="WingFrontLeft" id="WingFrontLeft" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Wing Rear Left Replaced</label>
                        <input name="WingRearLeftReplaced" id="WingRearLeftReplaced" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Wing Rear Left</label>
                        <input name="WingRearLeft" id="WingRearLeft" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Bumper Front Replaced</label>
                        <input name="BumperFrontReplaced" id="BumperFrontReplaced" class="form-control">
                    </div>
                 </div>

                </div>
                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Bumper Front</label>
                        <input name="BumperFront" id="BumperFront" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Bumper Rear Replaced</label>
                        <input name="BumperRearReplaced" id="BumperRearReplaced" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Bumper Rear</label>
                        <input name="BumperRear" id="BumperRear" class="form-control">
                    </div>
                 </div>

                </div>
                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Roof Check</label>
                        <input name="RoofCheck" id="RoofCheck" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Roof Rack</label>
                        <input name="RoofRack" id="RoofRack" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Door Front Right Replaced</label>
                        <input name="DoorFrontRightReplaced" id="DoorFrontRightReplaced" class="form-control">
                    </div>
                 </div>

                </div>
                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Door Rear Right</label>
                        <input name="DoorRearRight" id="DoorRearRight" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Wing Front Right Replaced</label>
                        <input name="WingFrontRightReplaced" id="WingFrontRightReplaced" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Wing Rear Right</label>
                        <input name="WingRearRight" id="WingRearRight" class="form-control">
                    </div>
                 </div>

                </div>
                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Boot Replaced</label>
                        <input name="BootReplaced" id="BootReplaced" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Boot</label>
                        <input name="Boot" id="Boot" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Sign Crumping</label>
                        <input name="SignCrumping" id="SignCrumping" class="form-control">
                    </div>
                 </div>

                </div>
                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Rust</label>
                        <input name="Rust" id="Rust" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Underneath Chassis Rusty</label>
                        <input name="Underneath_Chassis_Rusty" id="Underneath_Chassis_Rusty" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Bonnet Replaced</label>
                        <input name="BonnetReplaced" id="BonnetReplaced" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Bonnet</label>
                        <input name="Bonnet" id="Bonnet" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Grille Inspection</label>
                        <input name="GrilleInspection" id="GrilleInspection" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Sunroof Moonroof</label>
                        <input name="Sunroof_Moonroof" id="Sunroof_Moonroof" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Convertible Top</label>
                        <input name="ConvertibleTop" id="ConvertibleTop" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Outside Mirror</label>
                        <input name="OutsideMirror" id="OutsideMirror" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Wind Sheild Glass</label>
                        <input name="WindSheildGlass" id="WindSheildGlass" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Sunroof Glass</label>
                        <input name="SunroofGlass" id="SunroofGlass" class="form-control">
                    </div>
                 </div>

                 <!-- <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Front Left Tire Condition</label>
                        <input name="FronLeftTireCondition" id="FronLeftTireCondition" class="form-control">
                    </div>
                 </div> -->

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">WiperGlass</label>
                        <input name="WiperGlass" id="WiperGlass" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Wiper Blade</label>
                        <input name="WIperBlade" id="WIperBlade" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Doors</label>
                        <input name="Doors" id="Doors" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Tail gate</label>
                        <input name="Tailgate" id="Tailgate" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Power Lift GateOp</label>
                        <input name="PowerLiftGateOp" id="PowerLiftGateOp" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Hood</label>
                        <input name="Hood" id="Hood" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Frontend Exterior Lights</label>
                        <input name="FrontendExteriorLights" id="FrontendExteriorLights" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Side Exterior Right</label>
                        <input name="SideExteriorRight" id="SideExteriorRight" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Side Exterior Left</label>
                        <input name="SideExteriorLeft" id="SideExteriorLeft" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Backend Exterior Lights</label>
                        <input name="BackendExteriorLights" id="BackendExteriorLights" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Hazard Lights</label>
                        <input name="HazardLights" id="HazardLights" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Radio CD</label>
                        <input name="Radio_CD" id="Radio_CD" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Board Computer</label>
                        <input name="BoardComputer" id="BoardComputer" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">AC System</label>
                        <input name="AC_System" id="AC_System" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Heating System</label>
                        <input name="HeatingSystem" id="HeatingSystem" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Warning Signals Active</label>
                        <input name="WarningSignalsActive" id="WarningSignalsActive" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Instrument Panel</label>
                        <input name="InstrumentPanel" id="InstrumentPanel" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Dome Map Lights</label>
                        <input name="DomeMapLights" id="DomeMapLights" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Window Controls</label>
                        <input name="WindowControls" id="WindowControls" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Horn</label>
                        <input name="Horn" id="Horn" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Center Armrest</label>
                        <input name="CenterArmrest" id="CenterArmrest" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Wind sheild Wiper Control</label>
                        <input name="WindsheildWiperControl" id="WindsheildWiperControl" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Steering Wheel Controls</label>
                        <input name="SteeringWheelControls" id="SteeringWheelControls" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Door Locks</label>
                        <input name="DoorLocks" id="DoorLocks" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Clock</label>
                        <input name="Clock" id="Clock" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Glove Box</label>
                        <input name="GloveBox" id="GloveBox" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Headliner</label>
                        <input name="Headliner" id="Headliner" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Door Trim And Panels</label>
                        <input name="DoorTrimAndPanels" id="DoorTrimAndPanels" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Safety Belts</label>
                        <input name="SafetyBelts" id="SafetyBelts" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Engine Starts Property</label>
                        <input name="EngineStartsProperty" id="EngineStartsProperty" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Engine</label>
                        <input name="Engine" id="Engine" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Engine Group</label>
                        <input name="EngineGroup" id="EngineGroup" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">EngineNoise</label>
                        <input name="EngineNoise" id="EngineNoise" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Engine Visual Inspection</label>
                        <input name="EngineVisualInspection" id="EngineVisualInspection" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Engine Exhaust</label>
                        <input name="EngineExhaust" id="EngineExhaust" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Suspension UnderneathNoise</label>
                        <input name="Suspension_UnderneathNoise" id="Suspension_UnderneathNoise" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Profile System/Memory Seats</label>
                        <input name="ProfileSystem_MemorySeats" id="ProfileSystem_MemorySeats" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Cruise Control</label>
                        <input name="CruiseControl" id="CruiseControl" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Fuel Pump Noise</label>
                        <input name="FuelPumpNoise" id="FuelPumpNoise" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Transmission Condition</label>
                        <input name="TransmissionCondition" id="TransmissionCondition" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Struts And Shocks</label>
                        <input name="StrutsAndShocks" id="StrutsAndShocks" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Front Camera</label>
                        <input name="FrontCamera" id="FrontCamera" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Right Camera</label>
                        <input name="RightCamera" id="RightCamera" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Rear Sensors</label>
                        <input name="RearSensors" id="RearSensors" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Rear Camera</label>
                        <input name="RearCamera" id="RearCamera" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Front Sensors</label>
                        <input name="FrontSensors" id="FrontSensors" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Light Camera</label>
                        <input name="LightCamera" id="LightCamera" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Hoses Wiring</label>
                        <input name="Hoses_Wiring" id="Hoses_Wiring" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Charger</label>
                        <input name="Charger" id="Charger" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Water Slidge Oil</label>
                        <input name="Water_Slidge_Oil" id="Water_Slidge_Oil" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Fluid</label>
                        <input name="Fluid" id="Fluid" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Electric FRD</label>
                        <input name="ElectricFRD" id="ElectricFRD" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Electric RRD</label>
                        <input name="ElectricRRD" id="ElectricRRD" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Battery Expiration Date</label>
                        <input name="BatteryExpirationDate" id="BatteryExpirationDate" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Electric FLD</label>
                        <input name="ElectricFLD" id="ElectricFLD" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Electric RLD</label>
                        <input name="ElectricRLD" id="ElectricRLD" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Rear Left Door</label>
                        <input name="RearLeftDoor" id="RearLeftDoor" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Alternator Outdoor</label>
                        <input name="AlternatorOutdoor" id="AlternatorOutdoor" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Automatic Transmission Check</label>
                        <input name="AutomaticTransmissionCheck" id="AutomaticTransmissionCheck" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Transfer Case</label>
                        <input name="TransferCase" id="TransferCase" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Tires Match</label>
                        <input name="TiresMatch" id="TiresMatch" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Wheels Match</label>
                        <input name="WheelsMatch" id="WheelsMatch" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">WheelCovers CenterCaps</label>
                        <input name="WheelCovers_CenterCaps" id="WheelCovers_CenterCaps" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Front Left Tire Condition</label>
                        <input name="FronLeftTireCondition" id="FronLeftTireCondition" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Front Left Tire Production Date</label>
                        <input name="FronLeftTireProductionDate" id="FronLeftTireProductionDate" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Rear Left Tire Condition</label>
                        <input name="RearLeftTireCondition" id="RearLeftTireCondition" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Rear Left Tire Production Date</label>
                        <input name="RearLeftTireProductionDate" id="RearLeftTireProductionDate" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Correct Size</label>
                        <input name="CorrectSize" id="CorrectSize" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Front Right Tire Condition</label>
                        <input name="FrontRightTireCondition" id="FrontRightTireCondition" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Front Right Tire Production Date</label>
                        <input name="FrontRightTireProductionDate" id="FrontRightTireProductionDate" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Rear Right Tire Condition</label>
                        <input name="RearRightTireCondition" id="RearRightTireCondition" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Rear Right Tire Production Date</label>
                        <input name="RearRightTireProductionDate" id="RearRightTireProductionDate" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Rotors And Drums</label>
                        <input name="RotorsAndDrums" id="RotorsAndDrums" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">BrakePads Shoes</label>
                        <input name="BrakePads_Shoes" id="BrakePads_Shoes" class="form-control">
                    </div>
                 </div>

                </div>

                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Master Cylinder And Booster</label>
                        <input name="MasterCylinderAndBooster" id="MasterCylinderAndBooster" class="form-control">
                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Parking Brake</label>
                        <input name="ParkingBrake" id="ParkingBrake" class="form-control">
                    </div>
                 </div>

                <input type="hidden" name="timezoneoffset" id="timezoneoffset">

                </div>

                
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">

    $("#timezoneoffset").val(new Date().getTimezoneOffset());
    $(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
          if($(".upload-image").length > 15){
            $(".btn-success").prop('disabled',true);
          }
      });
      $(document).on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
          if($(".upload-image").length <= 15){
            $(".btn-success").prop('disabled',false);
          }
      });
    });
</script>
@endpush