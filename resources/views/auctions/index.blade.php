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
                                <th scope="col">Model</th>
                                <th scope="col">Year</th>
                                <th scope="col">Transmission</th>
                                <th scope="col">Specifications</th>
                                <th scope="col">Paint</th>
                                <th scope="col">Accident History</th>
                                <th scope="col">Drive</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $auction)
                            <tr>
                                <th scope="row">{{$auction->Make}}</th>
                                <td>{{$auction->Model}}</td>
                                <td>{{$auction->Year}}</td>
                                <td>{{$auction->Transmission}}</td>
                                <td>{{$auction->Specifications}}</td>
                                <td>{{$auction->Paint}}</td>
                                <td>{{$auction->AccidentHistory}}</td>
                                <td>{{$auction->Drive}}</td>
                                <td><button class="btn btn-sm btn-primary">Approve</button>
                                <button class="btn btn-sm btn-danger">Reject</button></td>
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
