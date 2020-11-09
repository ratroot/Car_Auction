@extends('layouts.app')

@section('content')
<div class="container">
    
    <img src="{{ asset('public/image/user.png')}}" alt="">
    <div class="row justify-content-center">
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
    <form action="{{url('/auction/store')}}" method="post" class="col-lg-12" enctype="multipart/form-data">
         @csrf 
         <div class="col-lg-12">


         <div class="card" style="margin-bottom:40px;">
            <div class="card-header">{{ __('Auction Details') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="control-label">Start Date and Time</label>
                                <input type="date" name="StartDate" id="StartDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="control-label">End Date and Time</label>
                                <input type="date" name="EndDate" id="EndDate" class="form-control">
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
            <div class="card-header">{{ __('Vehicle Information') }}</div>

            <div class="card-body">
                <div class="row">
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Make</label>
                        <select name="Make" id="Make" class="form-control">
                            <option value="Nissan">Nissan</option>
                            <option value="Honda">Honda</option>
                            <option value="Honda">Honda</option>
                        </select>
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

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">SMC Valid Till</label>
                        <input type="text" class="form-control" name="SMC_ValidTill" id="SMC_ValidTill">

                    </div>
                 </div>

                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Number Of Keys</label>
                        <input type="text" class="form-control" name="NumberOfKeys" id="NumberOfKeys">

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
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="control-label">Warranty Month</label>
                        <input type="text" class="form-control" name="WarrantyMonth" id="WarrantyMonth">

                    </div>
                 </div>
                 

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
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Save</button>
            
            </div>
            </div>
            
            <!-- <div class="card">
                <div class="card-header">
                {{ __('Body Information') }}
                </div>
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

                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                
                </div>
            </div> -->
        </div>
    </form>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
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