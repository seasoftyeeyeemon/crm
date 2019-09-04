@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h4>Customer List</h4>
            <a href="{{route('export')}}"><button type="button" class="btn btn-primary">Export</button></a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                       <th>Name</th>
                       <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                       <td>{{$user->name}}</td>
                       <td>{{$user->email}}</td>
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