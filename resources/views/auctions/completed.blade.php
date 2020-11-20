@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Approve Requests') }}</div>

                <div class="card-body">
                <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Make</th>
                                <th scope="col">Name</th>
                                <th scope="col">Highest Bid</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $completed)
                            <tr>
                                <th scope="row">{{$completed->Make}}</th>
                                <th >{{$completed->name}}</th>
                                <td>{{$completed->latestBid}}</td>
                                <td><button class="btn btn-sm btn-success">Purchase</button>
                                <button class="btn btn-sm btn-primary">Re-Auction</button></td>
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
