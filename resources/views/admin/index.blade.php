@extends('admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-header">Active Employee</div>
                        <div class="card-body">
                            <h4 class="text-center">4</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-header">Current Sale Leader</div>
                        <div class="card-body text-center">John Smith</div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-header">Sale For Month</div>
                        <div class="card-body text-center">5</div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-header">Total Sale value</div>
                        <div class="card-body text-center">40000000</div>
                    </div>
                </div>    
            </div> 
            <!-- End of Leadboard      -->
            <div class="row">
                <div class="col-md-6 mt-4">
                    <div class="card">
                    <div class="card-header">Unassigned Prospects</div>
                    <ul class="list-group list-group-flush">
                        @foreach($unassigned_prospects as $unassigned_prospect)
                            <li class="list-group-item">
                                {{$unassigned_prospect->name}} <span class="float-right btn btn-sm btn-success">Assign</span>
                            </li>
                        @endforeach
                        <li class="list-group-item">
                           <a href="" class="btn btn-block btn-md btn-primary">View all unassigned prospects</a>
                        </li>
                    </ul>
            </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="card">
                        <div class="card-header">Recent Estimates</div>
                        <ul class="list-group list-group-flush">
                            @for($i=0;$i<=6;$i++)
                                <li class="list-group-item">
                                   <div class="row">
                                        <div class="col-md-4">Mr Prospects</div>
                                        <div class="col-md-4">27 June 2019</div>
                                        <div class="col-md-4">
                                            value: 400000
                                            <span class="float-right btn btn-sm btn-success">Details</span>
                                        </div>
                                    
                                   </div>
                                </li>
                            @endfor
                                <li class="list-group-item">
                                    <a href="" class="btn btn-block btn-md btn-primary">View all estimated lead</a>
                                </li>
                            
                        </ul>
                    </div>
            </div>
        </div>
       
    </div>

@endsection