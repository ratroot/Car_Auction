@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                   <div class="row">
                   <div class="col-lg-4">
                   <a href="{{url('/completed')}}">
                        <div class="card">
                            <div class="card-body">
                            Completed Auctions
                            </div>
                        </div>
                    </a>

                   </div>


                   <div class="col-lg-4">


                    <a href="{{url('/auction/create')}}">
                        <div class="card">
                            <div class="card-body">
                            Add Auction request
                            </div>
                        </div>
                    </a>

                   </div>


                   <div class="col-lg-4">

                    <a href="{{url('/users')}}">
                        <div class="card">
                            <div class="card-body">
                            Approve Users
                            </div>
                        </div>
                    </a>
                   </div>


                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });
    });
</script>
@endsection