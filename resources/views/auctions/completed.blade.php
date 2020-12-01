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

    <!--INVOICE MODAL START-->
    <div class="modal fade in" id="invoice-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">INVOICE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <p><b>INVOICE IMAGE:</b></p>
                <img id="img-invoice" src="" class="img-fluid" alt="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--INVOICE MODAL END-->


    <!--Approve/disapprove modal-->
    <div class="modal fade in" id="confirmation-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <p><b>Are you sure?</b></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary confirm-btn">Yes</button>
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
        <!--END -->

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
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Highest Bid</th>
                                <th scope="col">Notification token</th>
                                <th scope="col">View Invoice</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="width:340px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $completed)
                            <tr>
                                <th scope="row">{{$completed->Make}}</th>
                                <th >{{$completed->name}}</th>
                                <th >{{$completed->email}}</th>
                                <th >{{$completed->phone}}</th>
                                <td>{{$completed->latestBid}}</td>
                                <td>
                                @if($completed->fcm_token != null || $completed->fcm_token != "")
                                    <button data-device-id="{{$completed->fcm_token}}" class="btn btn-sm btn-primary" onclick="copyToken(this);">Copy</button>
                                @else
                                    <p class="text-danger">Not available</p>
                                @endif
                                </td>

                                @if($completed->invoice_image != null)
                                    <td ><button class="btn btn-sm btn-primary btn-show-invoice" data-image-url="{{$completed->invoice_image}}">View</button></td>
                                @else
                                    <td class="text-danger">Not available</td>
                                @endif

                                @if($completed->invoice_status == 1)
                                <td class="text-warning"><b>Pending</b></td>
                                @elseif($completed->invoice_status == 2)
                                <td class="text-secondary"><b>Pending Payment</b></td>
                                @elseif($completed->invoice_status == 3)
                                <td class="text-danger"><b>Disapproved</b></td>
                                @elseif($completed->invoice_status == 4)
                                <td class="text-success"><b>Approved</b></td>
                                @else
                                <td class="text-danger"></td>
                                @endif
                                <td><button data-user-id="{{$completed->id}}" data-auction-id="{{$completed->auctionID}}" class="btn btn-sm btn-success btn-purchased">Purchased</button>
                                <button data-auction-id="{{$completed->auctionID}}" class="btn btn-sm btn-primary btn-reauction">Negotiate</button>
                                <button data-auction-id="{{$completed->auctionID}}" data-action-name="approve" class="btn btn-sm btn-success btn-approve">Approve</button>
                                <button data-auction-id="{{$completed->auctionID}}" data-action-name="disapprove" class="btn btn-sm btn-danger btn-disapprove">Disapprove</button>

                                </td>
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

    function copyToken(element){
        const el = document.createElement('textarea');
        el.value = element.getAttribute('data-device-id');
        el.setAttribute('readonly', '');
        el.style.position = 'absolute';
        el.style.left = '-9999px';
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);

        alert("Copied");
    }

    $(document).ready(function() {
        $('.btn-purchased').click(function(){
            var userid = $(this).attr('data-user-id');
            var auctionID = $(this).attr('data-auction-id');

            $("#purchased-modal").modal('show');
            $("#purchased-modal .modal-footer .save-purchased-btn").attr('data-purchased-url',"{{url('/auction/purchased/')}}/"+userid+"/"+auctionID+"");

        });


        $('.save-purchased-btn').click(function(){
            var url = $(this).attr('data-purchased-url');
            var startLimit = $("#auctionPrice").val();
            var endLimit = $("#auctionPriceTax").val();

            if(startLimit == '' || endLimit == ''){
                alert('Please add start and end limit');
                return;
            }
            else{
                url = url+'/'+startLimit+'/'+endLimit+'';
            }
            $('<a href = "'+url+'"></a>')[0].click();
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


        $('.btn-show-invoice').click(function(){

            var image_url = $(this).attr('data-image-url');

            $("#invoice-modal").modal('show');
            $("#invoice-modal .modal-body #img-invoice").attr('src',"{{url('/image')}}/"+image_url+"");

        });


        $('.btn-approve, .btn-disapprove').click(function(){

            var action_type = $(this).attr('data-action-name');
            var auctionID = $(this).attr('data-auction-id');

            $("#confirmation-modal").modal('show');
            if(action_type == "approve"){
                $("#confirmation-modal .modal-footer .confirm-btn").attr('data-url',"{{url('/invoice/approve')}}/"+auctionID+"");
            }
            else{
                $("#confirmation-modal .modal-footer .confirm-btn").attr('data-url',"{{url('/invoice/disapprove')}}/"+auctionID+"");

            }

        });

        $('.confirm-btn').click(function(){

            var url = $(this).attr('data-url');
            $('<a href = "'+url+'"></a>')[0].click();

        });
    });
</script>
@endpush