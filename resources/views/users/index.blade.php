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
                                <th scope="col">Created Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at}}</td>
                                @if($user->approved == 1)
                                <td><button disabled class="btn btn-sm btn-primary btn-approve">Approve</button>
                                <a href="{{url('/disapprove').'/'.$user->id}}"><button class="btn btn-sm btn-danger btn-reject">Reject</button></a></td>
                                @else
                                <td><button class="btn btn-sm btn-primary btn-approve">Approve</button>
                                <button disabled class="btn btn-sm btn-danger btn-reject">Reject</button></td>
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
            $("#user-limit-modal").modal('show');
            $("#user-limit-modal .modal-footer .save-limit-btn").attr('data-user-approve-url',"{{url('/approve').'/'.$user->id}}");
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

     
    });
</script>
@endpush