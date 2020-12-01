@extends('layouts.app')

@section('content')
<div class="container">
        <div class="modal fade in" id="user-limit-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add limit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Enter start and end limit</p>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="" class="control-label">Start Limit</label>
                                <input type="text" name="startLimit" id="startLimit" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="" class="control-label">End Limit</label>
                                <input type="text" name="endLimit" id="endLimit" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary save-limit-btn">Save changes</button>
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>


        <div class="modal fade in" id="user-eid-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>Name:</b> <span id="username"></span> </p>
                    <p><b>Email:</b> <span id="email"></span> </p>
                    <p><b>Phone:</b> <span id="phone"></span></p>
                    <p><b>Start Limit:</b> <span id="show_startlimit"></span></p>
                    <p><b>End Limit:</b> <span id="show_endlimit"></span></p>

                    <p><b>Front EID</b></p>
                    <img id="img-eid-front" src="" class="img-fluid" alt="">
                    <p><b>Back EID</b></p>
                    <img id="img-eid-back" src="" class="img-fluid" alt="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade in" id="user-delete-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <p><b>Are you sure?</b></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary confirm-delete-btn">Yes</button>
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>


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
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Created Date</th>
                                <th scope="col">View Details</th>
                                <th scope="col" style="width:340px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td class="tbl_username" >{{$user->name}}</td>
                                <td class="tbl_email">{{$user->email}}</td>
                                <td class="tbl_phone">{{$user->phone}}</td>
                                <td>{{$user->created_at}}</td>
                                <td><button data-start-limit="{{$user->startLimit}}" data-end-limit="{{$user->endLimit}}" data-eid-front="{{$user->EID_front_pic}}" data-eid-back="{{$user->EID_back_pic}}" class="btn btn-sm btn-primary show-eid-image">View</button></td>
                                @if($user->approved == 1)
                                <td><button disabled class="btn btn-sm btn-primary">Approve</button>
                                <a href="{{url('/disapprove').'/'.$user->id}}"><button class="btn btn-sm btn-danger btn-reject">Reject</button>
                                </a><button data-user-id="{{$user->id}}" class="btn btn-sm btn-warning btn-delete">Delete</button>
                                <button data-user-id="{{$user->id}}" class="btn btn-sm btn-primary btn-approve">Change Limit</button></td>
                                @else
                                <td><button data-user-id="{{$user->id}}" class="btn btn-sm btn-primary btn-approve">Approve</button>
                                <button disabled class="btn btn-sm btn-danger btn-reject">Reject</button>
                                <button data-user-id="{{$user->id}}" class="btn btn-sm btn-warning btn-delete">Delete</button>
                                <button disabled data-user-id="{{$user->id}}" class="btn btn-sm btn-primary btn-approve">Change Limit</button></td>
                                @endif
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
        $('.btn-approve').click(function(){
            var userid = $(this).attr('data-user-id');
            $("#user-limit-modal").modal('show');
            $("#user-limit-modal .modal-footer .save-limit-btn").attr('data-user-approve-url',"{{url('/approve')}}/"+userid+"");
        });

        
        $('.show-eid-image').click(function(){
            var front = $(this).attr('data-eid-front');
            var back = $(this).attr('data-eid-back');
            var username = $(this).parent().parent().find('.tbl_username').text();
            var email = $(this).parent().parent().find('.tbl_email').text();
            var phone = $(this).parent().parent().find('.tbl_phone').text();
            var startlimit = $(this).attr('data-start-limit');
            var endlimit = $(this).attr('data-end-limit');

            
            $("#user-eid-modal .modal-body #img-eid-front").attr('src',"{{url('/image')}}/"+front+"");
            $("#user-eid-modal .modal-body #img-eid-back").attr('src',"{{url('/image')}}/"+back+"");
            $("#user-eid-modal .modal-body #username").text(username);
            $("#user-eid-modal .modal-body #email").text(email);
            $("#user-eid-modal .modal-body #phone").text(phone);
            $("#user-eid-modal .modal-body #show_startlimit").text(startlimit);
            $("#user-eid-modal .modal-body #show_endlimit").text(endlimit);

            $("#user-eid-modal").modal('show');
        
        });

        $('.btn-delete').click(function(){
            var userid = $(this).attr('data-user-id');
            $("#user-delete-modal").modal('show');
            $("#user-delete-modal .modal-footer .confirm-delete-btn").attr('data-del-url',"{{url('/user/delete')}}/"+userid+"");
        });

        $('.save-limit-btn').click(function(){
            var url = $(this).attr('data-user-approve-url');
            var startLimit = $("#startLimit").val();
            var endLimit = $("#endLimit").val();

            if(startLimit == '' || endLimit == ''){
                alert('Please fill start and end limit');
                return;
            }
            else{
                url = url+'/'+startLimit+'/'+endLimit+'';
            }
            $('<a href = "'+url+'"></a>')[0].click();
        });

        $('.confirm-delete-btn').click(function(){
            var delurl = $(this).attr('data-del-url');
            $('<a href = "'+delurl+'"></a>')[0].click();
        });
     
    });
</script>
@endpush