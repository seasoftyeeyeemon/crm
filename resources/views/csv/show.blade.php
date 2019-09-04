@extends('admin.layouts.app')
@section('content')
<form action="{{route('postdate')}}" method="post">
{{ csrf_field() }}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
            <div class="col-md-4 form-group">
                        
                <label for="fromdate">From Date</label>
                <input id="FromDate" type="text"  name="FromDate" class="form-control">
            </div>
            <div class="col-md-4 form-group">
                <label for="todate">To Date</label>
                <input id="ToDate"  type="text" name="ToDate" class="form-control">
            </div>
        </div>
        <button type="submit">Select the Kindergarten Name</button>
    </div> 
</div>   
</form>

@endsection
