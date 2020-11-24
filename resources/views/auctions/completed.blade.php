@extends('layouts.app')

@section('content')
<div class="container">
    <div class="modal fade in" id="purchased-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Add details of purchasing</p>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="" class="control-label">Auction Price (AED)</label>
                                <input type="text" name="auctionPrice" id="auctionPrice" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="" class="control-label">Auction Price + Tax (AED)</label>
                                <input type="text" name="auctionPriceTax" id="auctionPriceTax" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary save-purchased-btn">Save changes</button>
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!--RE AUCTION MODAL START-->
    <div class="modal fade in" id="reauction-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Re-Acution</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Add new start and end date for re-auction</p>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="" class="control-label">Start Date</label>
                                <input type="datetime-local" name="StartDate" id="StartDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="" class="control-label">End Date</label>
                                <input type="datetime-local" name="EndDate" id="EndDate" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary save-reauction-btn">Save changes</button>
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--RE AUCTION MODAL END-->
    <div class="row justify-content-center">
        <div class="col-md-12">
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
            <div class="card">
                <div class="card-header">{{ __('Approve Requests') }}</div>

                <div class="card-body">
                <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Make</th>
                                <th scope="col">Name</th>
                                <th scope="col">Auction ID</th>
                                <th scope="col">Highest Bid</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $completed)
                            <tr>
                                <th scope="row">{{$completed->Make}}</th>
                                <th >{{$completed->name}}</th>
                                <th >{{$completed->auctionID}}</th>
                                <td>{{$completed->latestBid}}</td>
                                <td><button data-user-id="{{$completed->id}}" data-auction-id="{{$completed->auctionID}}" class="btn btn-sm btn-success btn-purchased">Purchased</button>
                                <button data-auction-id="{{$completed->auctionID}}" class="btn btn-sm btn-primary btn-reauction">Re-Auction</button></td>
                            </tr>
                        @endforeach
                            
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-purchased').click(function(){
            var userid = $(this).attr('data-user-id');
            var auctionID = $(this).attr('data-auction-id');

            $("#purchased-modal").modal('show');
            $("#purchased-modal .modal-footer .save-purchased-btn").attr('data-purchased-url',"{{url('/auction/purchased/')}}/"+userid+"/"+auctionID+"");

        });


        $('.btn-reauction').click(function(){
            //var userid = $(this).attr('data-user-id');
            var auctionID = $(this).attr('data-auction-id');

            $("#reauction-modal").modal('show');
            $("#reauction-modal .modal-footer .save-reauction-btn").attr('data-reauction-url',"{{url('/auction/reauction/')}}/"+auctionID+"");

        });

        $('.save-reauction-btn').click(function(){
            var url = $(this).attr('data-reauction-url');
            var StartDate = $("#StartDate").val();
            var EndDate = $("#EndDate").val();

            if(StartDate == '' || EndDate == ''){
                alert('Please add start and end date & time');
                return;
            }
            else{
                url = url+'/'+StartDate+'/'+EndDate+'';
            }
            $('<a href = "'+url+'"></a>')[0].click();
        });
    });
</script>
@endpush