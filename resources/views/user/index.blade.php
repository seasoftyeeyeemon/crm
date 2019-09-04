@extends('user.layouts.app')

@section('content')
<div class="container margin-top-250px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>

        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">Welcome {{$user->name}}</div>

                <div class="card-body">
                   <h6>{{$user->name}}</h6>
                   <h6>{{$user->email}}</h6>
                   <h6>{{$user->user_role}}</h6>
                </div>
            </div>
        </div>

        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">Assign Leads</div>

                <div class="card-body">
                @foreach($assigned_leads as $lead)
                  <div class="row">
                    {{$lead->name}}
                  
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                        {{$lead->email}}
                    </div>
                    <div class="col-md-3">
                        {{$lead->phone1}}
                    </div>
                  </div>
                  
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
