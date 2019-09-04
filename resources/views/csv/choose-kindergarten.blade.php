@extends('admin.layouts.app')
@section('content')
<form action="{{route('export')}}" method="post">
    {{ csrf_field() }}
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">
   
        
        <table class="table">
            <tbody>
                @foreach($kinders as $kinder)
                <tr>
                <td>{{$kinder->name}}</td>
                <td><input type="checkbox" name="kinder_ids[]" value="{{$kinder->id}}"></td>
                </tr>
               @endforeach
            </tbody>
        </table>
                
      <input type="submit" value="Submit">
   
    </div>
   
   

    </div>
    
</div>
</form>

@endsection
